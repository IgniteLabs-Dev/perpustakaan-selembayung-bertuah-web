<?php

namespace App\Livewire;

use Livewire\Component;

class UsersAdminComp extends Component
{
    public function render()
    {
        return view('livewire.users-admin-comp')->extends('layouts.master-admin');
    }
}
