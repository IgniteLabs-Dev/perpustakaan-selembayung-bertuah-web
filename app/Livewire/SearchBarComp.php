<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SearchBarComp extends Component
{
    public $search;
    public $category;
    public function render()
    {
        $categories = Category::all();
        return view('livewire.search-bar-comp', compact('categories')); 
    }
    public function searchBook(){
        return redirect()->route('jelajahi-buku', ['search' => $this->search]);
    }
}
