<?php

namespace App\Mail;

use App\Models\Pembayaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pembayaran;
    public $isLunas;

    public function __construct(Pembayaran $pembayaran, $isLunas = false)
    {
        $this->pembayaran = $pembayaran;
        $this->isLunas = $isLunas;
    }

    public function build()
    {
        $subject = $this->isLunas 
            ? 'Pembayaran Lunas Berhasil - ' . config('app.name')
            : 'Pembayaran DP Berhasil - ' . config('app.name');

        return $this->subject($subject)
                    ->view('emails.payment_notification')
                    ->with([
                        'pembayaran' => $this->pembayaran,
                        'isLunas' => $this->isLunas,
                    ]);
    }
}