<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class HomeRecommended extends Component
{
    public function render()
    {
        $books = Book::inRandomOrder()->limit(7)->get();
        $heights = ['h-45','h-50', 'h-55', 'h-60', 'h-55', 'h-50','h-45'];
        return view('livewire.home-recommended', compact('books', 'heights'));
    }
}
