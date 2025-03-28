<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Bookmark;
use App\Models\LoanTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeHot extends Component
{
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
            ->leftJoinSub(
                LoanTransaction::where('status', 'borrowed')
                    ->selectRaw('book_id, COUNT(*) as total')
                    ->groupBy('book_id'),
                'loaned',
                'books.id',
                '=',
                'loaned.book_id'
            )
            ->selectRaw('COALESCE(books.stock - loaned.total, books.stock) as available_stock') 
            ->paginate(6);




        return view('livewire.home-hot', compact('books', 'myBookmark'));
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
