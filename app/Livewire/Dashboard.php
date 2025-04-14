<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Visitor;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $visitor = Visitor::count();
        $book = Book::count();
        $bookStock = 0;
        $author = Author::count();
        $category = Category::count();
        $loan = 2;

        return view('livewire.dashboard', compact('visitor', 'book','bookStock','author','category','loan'))->extends('layouts.master-admin');
    }
}
