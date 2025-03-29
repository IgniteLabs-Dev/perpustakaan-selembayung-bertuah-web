<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\BookAuthors;
use App\Models\BookCategories;
use App\Models\Bookmark;
use App\Models\LoanTransaction;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookDetailComp extends Component
{
    public $id;
    public $data;
    public $user;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = Book::find($this->id);
    }
    public function render()
    {
        $categories = BookCategories::where('book_id', $this->id)->get();
        $categories = $categories->map(function ($item) {
            return $item->category->name;
        })->implode(', ');

        $authors = BookAuthors::where('book_id', $this->id)->get();
        $authors = $authors->map(function ($item) {
            return $item->author->name;
        })->implode(', ');

        $this->user = JWTAuth::parseToken()->authenticate();
        $myBookmark = Bookmark::where('user_id', $this->user->id)->pluck('book_id')->toArray();

        $loaned = LoanTransaction::where('status', 'borrowed')
            ->where('book_id', $this->id)
            ->selectRaw('book_id, COUNT(*) as total')
            ->groupBy('book_id')
            ->pluck('total')
            ->first();

             $loaned = $loaned ? $loaned : 0;
            // dd($loaned);
          

        return view('livewire.book-detail-comp', compact('categories', 'authors', 'myBookmark','loaned'))->extends('layouts.master');
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
