<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class HomeHot extends Component
{
    public function render()
    {
        $books = Book::paginate(6);
        return view('livewire.home-hot' , compact('books'));
    }
}
