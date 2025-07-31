<!DOCTYPE html>
<html>
<head>
    <title>{{ $isLunas ? 'Pembayaran Lunas Berhasil' : 'Pembayaran DP Berhasil' }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; padding: 20px; background-color: #f8f9fa; text-align: center; font-size: 12px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        
        <div class="content">
            <h2>{{ $isLunas ? 'Pembayaran Lunas Berhasil' : 'Pembayaran DP Berhasil' }}</h2>
            
            <p>Halo {{ $pembayaran->pemesanan->user->name }},</p>
            
            @if($isLunas)
                <p>Terima kasih telah melakukan pembayaran lunas untuk booking lapangan Anda. Berikut detail pembayaran:</p>
            @else
                <p>Terima kasih telah melakukan pembayaran DP untuk booking lapangan Anda. Berikut detail pembayaran:</p>
                <p>Silakan lakukan pelunasan sebelum waktu booking dimulai.</p>
            @endif
            
            <h3>Detail Booking</h3>
            <ul>
                <li>Lapangan: {{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</li>
                <li>Tanggal: {{ date('d F Y', strtotime($pembayaran->pemesanan->tanggal)) }}</li>
                <li>Waktu: {{ $pembayaran->pemesanan->jam_mulai }} - {{ date('H:i', strtotime($pembayaran->pemesanan->jam_mulai) + ($pembayaran->pemesanan->lama * 3600)) }}</li>
                <li>Durasi: {{ $pembayaran->pemesanan->lama }} jam</li>
            </ul>
            
            <h3>Detail Pembayaran</h3>
            <ul>
                <li>Total Harga: Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</li>
                <li>DP: Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</li>
                @if(!$isLunas)
                <li>Sisa Pembayaran: Rp {{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</li>
                @endif
                <li>Status: {{ $isLunas ? 'Lunas' : 'DP' }}</li>
            </ul>
            
            <p>Anda dapat melihat detail booking di dashboard akun Anda.</p>
            
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>