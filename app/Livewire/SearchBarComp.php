<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SearchBarComp extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.search-bar-comp', compact('categories'));
    }
}
