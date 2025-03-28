<?php

namespace App\Livewire;

use App\Models\LoanTransaction;
use Livewire\Component;
use Livewire\WithPagination;
use Tymon\JWTAuth\Facades\JWTAuth;

class HistoryLoanComp extends Component
{
    use WithPagination;
    public $confirmDelete;
    public $search;
    public $type;
    public function render()
    {

        $user = JWTAuth::parseToken()->authenticate();
        $data = LoanTransaction::where('user_id', $user->id)
            ->when($this->search, function ($query) {
                $query->whereHas('book', function ($bookQuery) {
                    $bookQuery->where('title', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->type, function ($query) {
                $query->whereHas('book', function ($bookTypeQuery) {
                    $bookTypeQuery->where('type', 'like', '%' . $this->type . '%');
                });
            })
            ->orderby('created_at', 'desc')
            ->paginate('10');;

        return view('livewire.history-loan-comp', compact('data'))->extends('layouts.master');
    }
}
