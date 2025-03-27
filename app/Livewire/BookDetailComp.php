<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookDetailComp extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $data = Book::find($this->id);
        return view('livewire.book-detail-comp', compact('data'))->extends('layouts.master-admin');
    }
}
