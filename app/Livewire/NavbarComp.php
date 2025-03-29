<?php

namespace App\Livewire;

use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;

class NavbarComp extends Component
{
    public function render()
    {
    
        try {
            $user = JWTAuth::parseToken()->authenticate();
         
        } catch (\Exception $e) {
            $name = null;
        }
  
        return view('livewire.navbar-comp',compact('user'));
    }
}
