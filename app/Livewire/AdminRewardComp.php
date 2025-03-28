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

        return view('livewire.admin-reward-comp', compact('data'))->extends('layouts.master-admin');
    }
}
