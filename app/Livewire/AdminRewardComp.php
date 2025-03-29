<?php

namespace App\Livewire;

use App\Models\LoanTransaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminRewardComp extends Component
{
    use WithPagination;
    public $confirmDelete;
    public $search;
    public $username;
    public $showId;
    public $currentPageHistory = 1;


    public $sort = 'desc';

    public function render()
    {
        $data = LoanTransaction::where('status', 'returned')
            ->select(
                'user_id',
                DB::raw('SUM(point) as total_point'),
                DB::raw('SUM(fine) as total_fine'),
                DB::raw('SUM(point) - SUM(fine) as final_point')
            )
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->groupBy('user_id')
            ->orderByRaw('SUM(point) - SUM(fine) ' . $this->sort)
            ->paginate(10);

        $history = LoanTransaction::where('user_id', $this->showId)
            ->where('status', 'returned')
            ->orderby('created_at', 'desc')
            ->paginate(2, ['*'], 'page', $this->currentPageHistory);

        $totalPagesHistory = $history->lastPage();

        return view('livewire.admin-reward-comp', compact('data', 'history', 'totalPagesHistory'))->extends('layouts.master-admin');
    }
    public function showHistory($id)
    {
        $this->showId = $id;
        $this->username = User::find($id)->name;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function resetInput()
    {
        $this->confirmDelete = '';
        $this->search = '';
    }
}
