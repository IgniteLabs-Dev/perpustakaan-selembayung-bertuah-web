<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengingatPengembalianMail;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use App\Models\ViewPeminjamanHampirJatuhTempo;
class SendEmail extends Component
{
    public function render()
    {
        return view('livewire.send-email');
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
