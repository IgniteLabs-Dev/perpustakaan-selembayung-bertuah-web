<?php

namespace App\Livewire;

use App\Models\LoanTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;
use Livewire\Attributes\On;

class NavbarComp extends Component
{
    public function render()
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $name = null;
        }

        $point = LoanTransaction::where('user_id', $user->id)
            ->selectRaw('SUM(point) - SUM(fine) as total_point')
            ->value('total_point');

        return view('livewire.navbar-comp', compact('user', 'point'));
    }
    #[On('refreshNavbar')]
    public function refreshNavbar()
    {
        $this->render();
    }
}
