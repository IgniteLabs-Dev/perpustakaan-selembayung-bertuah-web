<?php

namespace App\Livewire;

use App\Models\LoanTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class AdminLoanTransactionComp extends Component
{
    use WithPagination;
    public $user_id, $book_id, $status;
    public $search;
    public $confirmDelete;
    public $editId;
    

    
    public function render()
    {
        $data = LoanTransaction::when($this->search, function ($query) {
            $query->where('loan_id', 'like', '%' . $this->search . '%');
        })->whereHas('user', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->whereHas('book', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderby('created_at', 'desc')
            ->paginate('10');
        return view('livewire.admin-loan-transaction-comp', compact('data'))->extends('layouts.master-admin');
    }
}
