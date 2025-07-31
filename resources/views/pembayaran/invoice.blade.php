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
        .vertical-details {
            width: 60%;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .detail-label {
            font-weight: bold;
            min-width: 120px;
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
            <div class="company-info">Kampung Penyengat</div>
            <div class="divider"></div>
            <div class="invoice-title">FAKTUR PEMBAYARAN</div>
        </div>
        
        <div class="vertical-details">
            <div class="detail-row">
                <span class="detail-label">No Faktur</span>
                <span>{{ $nofaktur }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal</span>
                <span>{{ $tanggal }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Nama</span>
                <span>{{ $pembayaran->pemesanan->user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Jam Mulai</span>
                <span>{{ \Carbon\Carbon::createFromFormat('H:i:s', $pembayaran->pemesanan->jam_mulai)->format('H.i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Harga</span>
                <span>Rp {{ number_format($pembayaran->pemesanan->harga, 0, ',', '.') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Lama</span>
                <span>{{ $pembayaran->pemesanan->lama }} jam</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">DP</span>
                <span>Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total</span>
                <span>Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="divider"></div>
        
      
        
        <div class="footer">
            TERIMA KASIH
        </div>
    </div>
</body>
</html>