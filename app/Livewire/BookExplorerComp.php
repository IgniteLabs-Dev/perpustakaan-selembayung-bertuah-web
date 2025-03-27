<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Bookmark;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookExplorerComp extends Component
{
    public $search;
    public $user;

    public function mount()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }


    public function render()
    {

        $myBookmark = Bookmark::where('user_id', $this->user->id)->pluck('book_id')->toArray();
        $books = Book::select('books.*')
            ->addSelect(DB::raw('(
            SELECT GROUP_CONCAT(authors.name SEPARATOR ", ") 
            FROM book_authors 
            JOIN authors ON authors.id = book_authors.author_id 
            WHERE book_authors.book_id = books.id
        ) as authors'))
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', $search)
                        ->orWhere('publisher', 'like', $search)
                        ->orWhereRaw('(SELECT GROUP_CONCAT(authors.name SEPARATOR ", ") 
                                    FROM book_authors 
                                    JOIN authors ON authors.id = book_authors.author_id 
                                    WHERE book_authors.book_id = books.id) like ?', [$search]);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('livewire.book-explorer-comp', compact('books', 'myBookmark'))->extends('layouts.master');
    }
    public function addBookmark($id)
    {
        Bookmark::create([
            'user_id' => $this->user->id,
            'book_id' => $id
        ]);
    }
    public function removeBookmark($id)
    {
        Bookmark::where('user_id', $this->user->id)->where('book_id', $id)->delete();
    }
}
