<?php

namespace App\Livewire;

use App\Models\ViewPeminjamanHampirJatuhTempo;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatPengembalianMail;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Sidebar extends Component
{
   
    public function render()
    {



        return view('livewire.sidebar');
    }
    public function sendEmail()
    {
        $peminjam = ViewPeminjamanHampirJatuhTempo::all();
     
        foreach ($peminjam as $data) {
            Mail::to($data->email)->send(new PengingatPengembalianMail($data));
        }

        LivewireAlert::title('Email Berhasil Dikirim')
            ->position('top-end')
            ->toast()
            ->success()
            ->show();
      
    }
}
