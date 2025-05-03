<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengingatPengembalianMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataPeminjaman;

    public function __construct($dataPeminjaman)
    {
        $this->dataPeminjaman = $dataPeminjaman;
    }

    public function build()
    {
        return $this->subject('Pengingat Pengembalian Buku')
                    ->view('emails.pengingat-pengembalian');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengingat Pengembalian Buku',
        );
    }

}
