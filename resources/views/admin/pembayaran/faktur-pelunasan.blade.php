<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Pembayaran</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            padding: 25px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #FF8C00;
        }
        .header h1 {
            color: #FF8C00;
            margin: 5px 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 3px 0;
            color: #666;
            font-size: 14px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-number {
            font-weight: bold;
            color: #555;
        }
        .invoice-date {
            color: #555;
        }
        .booking-details {
            margin-bottom: 25px;
        }
        .booking-details h3 {
            color: #FF8C00;
            margin: 0 0 15px 0;
            font-size: 18px;
            padding-bottom: 5px;
            border-bottom: 1px solid #FFE4B5;
        }
        .detail-row {
            display: flex;
            margin-bottom: 8px;
        }
        .detail-label {
            font-weight: bold;
            width: 120px;
            color: #555;
        }
        .detail-value {
            flex: 1;
        }
        .payment-summary {
            background-color: #FFF8F0;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .payment-summary h3 {
            color: #FF8C00;
            margin: 0 0 15px 0;
            font-size: 18px;
            padding-bottom: 5px;
            border-bottom: 1px solid #FFE4B5;
        }
        .payment-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .payment-label {
            font-weight: bold;
            color: #555;
        }
        .payment-amount {
            font-weight: bold;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #FF8C00;
            font-size: 16px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #FF8C00;
            color: white;
            border-radius: 3px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
        }
        .stamp-area {
            text-align: right;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #FF8C00;
        }
        .stamp {
            display: inline-block;
            text-align: center;
        }
        .stamp-title {
            color: #FF8C00;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stamp-sign {
            margin-top: 20px;
            padding: 10px 20px;
            border: 1px solid #ffffff;
            display: inline-block;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .highlight {
            color: #FF8C00;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Faktur Pembayaran</h1>
            <p>{{ config('app.name') }}</p>
        </div>
        
        <div class="invoice-info">
            <div class="invoice-number">No: <span class="highlight">{{ $nofaktur }}</span></div>
            <div class="invoice-date">Tanggal: <span class="highlight">{{ $pembayaran->created_at->format('d F Y') }}</span></div>
        </div>
        
        <div class="booking-details">
            <h3>Detail Booking</h3>
            <div class="detail-row">
                <div class="detail-label">Nama Pelanggan:</div>
                <div class="detail-value">{{ $pembayaran->pemesanan->user->name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Lapangan:</div>
                <div class="detail-value">{{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal:</div>
                <div class="detail-value">{{ date('d F Y', strtotime($pembayaran->pemesanan->tanggal)) }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Waktu:</div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $pembayaran->pemesanan->jam_mulai)->format('H.i') }} - 
                    {{ date('H:i', strtotime($pembayaran->pemesanan->jam_mulai) + ($pembayaran->pemesanan->lama * 3600)) }}
                    ({{ $pembayaran->pemesanan->lama }} jam)
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Harga/Jam:</div>
                <div class="detail-value">Rp{{ number_format($pembayaran->pemesanan->lapangan->harga, 0, ',', '.') }}</div>
            </div>
        </div>
        
        <div class="payment-summary">
            <h3>Rincian Pembayaran</h3>
            <div class="payment-item">
                <span class="payment-label">Total Tagihan:</span>
                <span class="payment-amount">Rp{{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="payment-item">
                <span class="payment-label">Dibayar:</span>
                <span class="payment-amount">Rp{{ number_format($pembayaran->dp, 0, ',', '.') }}</span>
            </div>
            <div class="payment-item">
                <span class="payment-label">Sisa Pembayaran:</span>
                <span class="payment-amount">Rp{{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span class="payment-label">Status:</span>
                <span class="status-badge">{{ strtoupper($pembayaran->pemesanan->status) }}</span>
            </div>
        </div>
        
        <div class="stamp-area">
            <div class="stamp">
                <div class="stamp-title">Hormat Kami</div>
                <div class="stamp-sign">
                    <p style="margin: 0; font-weight: bold;">{{ config('app.name') }}</p>
                    <p style="margin: 0;">Admin</p>
                </div>
            </div>
        </div>
        
       
    </div>
</body>
</html>