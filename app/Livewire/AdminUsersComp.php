<?php

namespace App\Livewire;

use Livewire\Component;

class AdminUsersComp extends Component
{
    public bool $isOpen = false;
    public function render()
    {
        return view('livewire.admin-users-comp')->extends('layouts.master-admin');
    }


    public function openModal()
    {
        $this->isOpen = true;
    }
    
    public function closeModal()
    {
        $this->isOpen = false;
    }
}
