<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran Tahunan - Anak Rawa Futsal</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        .header-text {
            flex-grow: 1;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .report-title {
            text-align: center;
            margin: 0 0 20px 0;
            font-size: 16px;
            text-transform: uppercase;
        }
        .report-info {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
        }
        th, td { 
            border: 1px solid #333; 
            padding: 8px; 
        }
        th { 
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-text">
            <h1>ANAK RAWA FUTSAL KAMPUNG PENYENGAT</h1>
            <p>Jl. Prof. Dr. Hamka No.156D, Air Tawar Bar., Kec. Koto Tangah, Kota Padang</p>
        </div>
    </div>
    
    <h3 class="report-title">LAPORAN PEMBAYARAN TAHUNAN</h3>
    
    <div class="report-info">
        <p><strong>Tahun:</strong> {{ $tahun }}</p>
      
    </div>
    
    <table>
        <thead>
            <tr>
                <th width="20%">ID Pembayaran</th>
                <th width="40%">Bulan</th>
                <th width="40%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayarans as $pembayaran)
            <tr>
                <td>{{ $pembayaran->id }}</td>
                <td>{{ \Carbon\Carbon::create()->month($pembayaran->bulan)->locale('id')->monthName }}</td>
                <td class="text-right">Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Tidak ada data pembayaran untuk tahun ini</td>
            </tr>
            @endforelse
        </tbody>
        @if($pembayarans->count() > 0)
        <tfoot>
            <tr>
                <th colspan="2" class="text-right">Total:</th>
                <th class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
        @endif
    </table>
    
    <div class="footer">
        <div class="signature">
            <p>Padang, {{ $tanggalCetak }}</p>
            <p>Hormat kami,</p>
            <div style="margin-top: 40px;">
                <p>(_______________________)</p>
                <p>Pemilik</p>
            </div>
        </div>
    </div>
</body>
</html>