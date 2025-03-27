<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookExplorerComp extends Component
{
    public $search;
    public function render()
    {
        $books = Book::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                // ->orWhere('author', 'like', '%' . $this->search . '%')
                ->orWhere('publisher', 'like', '%' . $this->search . '%');
        })->orderby('created_at', 'desc')->paginate(30);

        return view('livewire.book-explorer-comp', compact('books'))->extends('layouts.master');
    }
}
