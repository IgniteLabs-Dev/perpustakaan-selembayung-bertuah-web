<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookDetailComp extends Component
{
    public $id;
    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = Book::find($this->id);
    }
    public function render()
    {
        return view('livewire.book-detail-comp')->extends('layouts.master');
    }
}
