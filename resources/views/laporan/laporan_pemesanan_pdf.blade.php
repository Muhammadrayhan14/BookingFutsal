<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan - Anak Rawa Futsal</title>
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
        
        /* BADGE STYLES */
        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-text">
            <h1>ANAK RAWA FUTSAL</h1>
            <p>KAMPUNG PENYENGAT</p>
        </div>
    </div>
    
    <h3 class="text-center" style="margin: 0 0 20px 0; font-size: 16px; color: #333; text-transform: uppercase;">
        LAPORAN DATA PEMESANAN PERTANGGAL
    </h3>
    
    <div class="report-info">
        <p><strong>Tanggal:</strong> {{ $selectedDate }}</p>
       
    </div>
    
    <table>
        <thead>
            <tr>
                <th width="5%">Id Pemesanan</th>
               
                <th width="20%">Nama</th>
           
                <th width="15%">Harga</th>
                <th width="10%">DP</th>
                <th width="5%">Lama</th>
                <th width="15%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pemesanans as $pemesanan)
            <tr>
                <td class="text-center">{{ $pemesanan->id }}</td>
             
                <td>{{ $pemesanan->user->name }}</td>
     
                <td class="text-right">Rp {{ number_format($pemesanan->harga, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($pemesanan->pembayaran->dp ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $pemesanan->lama }} jam</td>
                <td class="text-right">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data pemesanan</td>
            </tr>
            @endforelse
        </tbody>
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