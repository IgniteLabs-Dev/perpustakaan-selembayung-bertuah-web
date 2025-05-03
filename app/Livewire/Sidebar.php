<?php

namespace App\Livewire;

use App\Models\ViewPeminjamanHampirJatuhTempo;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $data = ViewPeminjamanHampirJatuhTempo::all();

        
        return view('livewire.sidebar');
    }
}
