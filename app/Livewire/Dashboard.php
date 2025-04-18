<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\LoanTransaction;
use App\Models\Visitor;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {

        // Hari ini
        $visitorDay = Visitor::whereDate('created_at', Carbon::today())->count();

        // Minggu ini (mulai dari Senin sampai hari ini)
        $visitorWeek = Visitor::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        // Bulan ini
        $visitorMonth = Visitor::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();


        $bookOriginalStock = Book::sum('stock');
        $loan = LoanTransaction::where('status', 'borrowed')->count();
        $bookStock = $bookOriginalStock - $loan;
        $book = Book::count();
        $author = Author::count();
        $category = Category::count();

        return view('livewire.dashboard', compact('book', 'bookStock', 'author', 'category', 'loan', 'visitorDay', 'visitorWeek', 'visitorMonth'))->extends('layouts.master-admin');
    }
}
