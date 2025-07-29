<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaketHampirHabisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
        
    }

    public function build()
    {
        return $this->subject('Pemberitahuan: Paket Gym Anda Hampir Habis')
                    ->view('emails.paket-hampir-habis');
    }
}
