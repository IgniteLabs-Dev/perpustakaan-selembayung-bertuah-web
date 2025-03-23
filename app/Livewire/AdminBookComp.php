<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class AdminBookComp extends Component
{
    public $search;
    public $cover, $title, $deskripsi, $author, $publisher, $category_id, $realese_date, $stock, $status, $type;
    public $editId;
    public $confirmDelete;
    public function render()
    {
        $data = Book::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%')
                ->orWhere('publisher', 'like', '%' . $this->search . '%');
        })
            ->orderby('created_at', 'desc')
            ->paginate('10');
        return view('livewire.admin-book-comp', compact('data'))->extends('layouts.master-admin');
    }
}
