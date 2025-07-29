<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran - Anak Rawa Futsal</title>
    <style>
        /* GLOBAL STYLES */
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        /* HEADER STYLES */
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        .logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #333;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            overflow: hidden;
            float: left;
        }
        .header-text {
            flex-grow: 1;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        
        /* REPORT TITLE */
        .report-title {
            text-align: center;
            margin: 0 0 20px 0;
            font-size: 16px;
            color: #333;
            text-transform: uppercase;
        }
        
        /* REPORT INFO */
        .report-info {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        .report-info p {
            margin: 5px 0;
        }
        
        /* TABLE STYLES */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
            margin-bottom: 20px;
        }
        th, td { 
            border: 1px solid #333; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #ffffff; 
            color: rgb(0, 0, 0); 
            font-weight: bold;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        /* UTILITY CLASSES */
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        
        /* FOOTER STYLES */
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
            float: right;
            text-align: center;
        }
        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- HEADER SECTION -->
    <div class="header">
        <div class="logo">
            <img src="frontend/img/logo.png" style="width:100%; height:100%; object-fit:cover; background-color: #000000;">
        </div>
        <div class="header-text">
            <h1>ANAK RAWA FUTSAL KAMPUNG PENYENGAT</h1>
            <p>Jl. Prof. Dr. Hamka No.156D, Air Tawar Bar., Kec. Koto Tangah, Kota Padang</p>
            <p>Telp 081261879415</p>
        </div>
    </div>
    
    <!-- REPORT TITLE -->
    <h3 class="text-center" style="margin: 0 0 20px 0; font-size: 16px; color: #333; text-transform: uppercase;">
        LAPORAN PEMBAYARAN
    </h3>
    
    <!-- REPORT INFO -->
    <div class="report-info">
        <p><strong>Periode:</strong> {{ $startDate }} s/d {{ $endDate }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>
    
    <!-- MAIN TABLE -->
    <table>
        <thead>
            <tr>
                <th width="15%">ID Pembayaran</th>
                <th width="30%">Nama Pelanggan</th>
                <th width="20%">Harga</th>
                <th width="15%">DP</th>
                <th width="20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayarans as $pembayaran)
            <tr>
                <td class="text-center">{{ $pembayaran->id }}</td>
                <td>{{ $pembayaran->pemesanan->user->name }}</td>
                <td class="text-right">Rp {{ number_format($pembayaran->pemesanan->harga, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data pembayaran untuk periode ini</td>
            </tr>
            @endforelse
        </tbody>
        @if($pembayarans->count() > 0)
        <tfoot>
            <tr>
                <th colspan="2" class="text-right">Total:</th>
                <th class="text-right">Rp {{ number_format($pembayarans->sum(function($p) { return $p->pemesanan->harga; }), 0, ',', '.') }}</th>
                <th class="text-right">Rp {{ number_format($totalDP, 0, ',', '.') }}</th>
                <th class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
        @endif
    </table>
    
    <!-- FOOTER SECTION -->
    <div class="footer">
        <div class="signature">
            <p>Padang, {{ $tanggalCetak }}</p>
            <p>Hormat kami,</p>
            <div style="margin-top: 40px;">
                <p>(_______________________)</p>
                <p>Pemilik</p>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</body>
</html>