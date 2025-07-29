<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $nofaktur }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 14px;
            margin: 0;
            padding: 10px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #ff6600;
            margin-bottom: 5px;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .divider {
            border-top: 1px solid #eee;
            margin: 15px 0;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #ff6600;
            margin-bottom: 10px;
            padding-bottom: 3px;
            border-bottom: 1px solid #ff6600;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
        }
        .info-label {
            font-weight: bold;
            min-width: 120px;
        }
        .detail-item {
            margin-bottom: 8px;
        }
        .detail-title {
            font-weight: bold;
            margin-bottom: 3px;
        }
        .total-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .total-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .grand-total {
            font-size: 16px;
            font-weight: bold;
            border-top: 1px solid #333;
            margin-top: 10px;
            padding-top: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
        .text-success { color: #28a745; }
        .text-primary { color: #4361ee; }
        .text-danger { color: #dc3545; }
        .company-info {
            font-size: 12px;
            margin-bottom: 5px;
        }
        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div class="logo">ANAK RAWA FUTSAL</div>
            <div class="invoice-title">FAKTUR PEMBAYARAN</div>
            <div class="company-info">Kampung Penyengat</div>
            <div class="company-info">Telp: (021) 12345678</div>
        </div>
        
        <div class="divider"></div>
        
        <div class="section">
            <div class="section-title">Informasi Faktur</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nomor Faktur</span>
                    <span>{{ $nofaktur }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal</span>
                    <span>{{ $tanggal }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nama Pelanggan</span>
                    <span>{{ $pembayaran->pemesanan->user->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Booking ID</span>
                    <span>{{ $pembayaran->pemesanan->id }}</span>
                </div>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="section">
            <div class="section-title">Detail Booking</div>
            <div class="detail-item">
                <div class="detail-title">Lapangan</div>
                <div>{{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-title">Tanggal Booking</div>
                <div>{{ date('d F Y', strtotime($pembayaran->pemesanan->tanggal)) }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-title">Waktu</div>
                <div>
                    {{ $pembayaran->pemesanan->jam_mulai }} - 
                    {{ date('H:i', strtotime($pembayaran->pemesanan->jam_mulai) + ($pembayaran->pemesanan->lama * 3600)) }}
                    ({{ $pembayaran->pemesanan->lama }} jam)
                </div>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="section">
            <div class="section-title">Rincian Harga</div>
            <div class="detail-item">
                <div class="detail-title">Harga per Jam</div>
                <div>Rp {{ number_format($pembayaran->pemesanan->harga, 0, ',', '.') }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-title">Durasi</div>
                <div>{{ $pembayaran->pemesanan->lama }} jam</div>
            </div>
        </div>
        
        <div class="total-section">
            <div class="total-item">
                <span>Total:</span>
                <span class="text-success">Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="total-item">
                <span>DP Dibayar:</span>
                <span class="text-primary">Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</span>
            </div>
            <div class="total-item grand-total">
                <span>Sisa Pembayaran:</span>
                <span class="text-danger">Rp {{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="footer">
            <p>Terima kasih telah memilih ANAK RAWA FUTSAL</p>
            <p>Silahkan Bawa Faktur Pembayaran ini untuk penulasan sisa pembayaran</p>
          
        </div>
    </div>
</body>
</html>