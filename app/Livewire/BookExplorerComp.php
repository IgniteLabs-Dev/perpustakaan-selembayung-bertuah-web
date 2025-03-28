<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\LoanTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookExplorerComp extends Component
{
    public $search = null;
    public $category = null;
    public $author = null;
    public $user;
    public $sort = 'asc';
    public $sortType = 'new';
    public $sortTable = 'created_at';

    public function mount($search = null, $category = null)
    {

        $this->search = $search;
        $this->category = $category;
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function resetFilter()
    {
        $this->search = null;
        $this->category = null;
        $this->author = null;
        $this->sortType = 'new';
        $this->sort = 'asc';
        $this->dispatch('resetSelect');
    }


    public function updatedSortType()
    {
        if ($this->sortType == 'new') {
            $this->sort = 'asc';
            $this->sortTable = 'created_at';
        } else if ($this->sortType == 'az') {
            $this->sort = 'asc';
            $this->sortTable = 'title';
        } else if ($this->sortType == 'za') {
            $this->sort = 'desc';
            $this->sortTable = 'title';
        }
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
            ->leftJoinSub(
                LoanTransaction::where('status', 'borrowed')
                    ->selectRaw('book_id, COUNT(*) as total')
                    ->groupBy('book_id'),
                'loaned',
                'books.id',
                '=',
                'loaned.book_id'
            )
            ->selectRaw('COALESCE(books.stock - loaned.total, books.stock) as available_stock') // Kurangi stok
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                        ->orWhere('publisher', 'like', "%$search%")
                        ->orWhereExists(function ($subquery) use ($search) {
                            $subquery->select(DB::raw(1))
                                ->from('book_authors')
                                ->join('authors', 'authors.id', '=', 'book_authors.author_id')
                                ->whereColumn('book_authors.book_id', 'books.id')
                                ->where('authors.name', 'like', "%$search%");
                        })
                        ->orWhereExists(function ($subquery) use ($search) {
                            $subquery->select(DB::raw(1))
                                ->from('book_categories')
                                ->join('categories', 'categories.id', '=', 'book_categories.category_id')
                                ->whereColumn('book_categories.book_id', 'books.id')
                                ->where('categories.name', 'like', "%$search%");
                        });
                });
            })
            ->when($this->author, function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('book_authors')
                        ->whereColumn('book_authors.book_id', 'books.id')
                        ->where('book_authors.author_id', $this->author);
                });
            })
            ->when($this->category, function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('book_categories')
                        ->whereColumn('book_categories.book_id', 'books.id')
                        ->where('book_categories.category_id', $this->category);
                });
            })
            ->orderBy($this->sortTable, $this->sort)
            ->paginate(30);

        $categories = Category::all() ?? collect();
        $authors = Author::all() ?? collect();
        return view('livewire.book-explorer-comp', compact('books', 'myBookmark', 'categories', 'authors'))->extends('layouts.master');
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
