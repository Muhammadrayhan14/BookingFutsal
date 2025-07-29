public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Pembayaran Anda Telah Diverifikasi')
        ->line('Pembayaran untuk pemesanan lapangan futsal telah diverifikasi.')
        ->line('Detail Pemesanan:')
        ->line('Lapangan: ' . $this->pembayaran->pemesanan->lapangan->namapelangan)
        ->line('Tanggal: ' . $this->pembayaran->pemesanan->tanggal)
        ->line('Jam: ' . $this->pembayaran->pemesanan->jam_mulai)
        ->action('Lihat Pemesanan', url('/pemesanan/'.$this->pembayaran->pemesanan->id));
}