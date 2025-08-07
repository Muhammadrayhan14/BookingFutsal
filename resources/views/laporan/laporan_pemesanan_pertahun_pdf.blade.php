<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan Tahunan - Anak Rawa Futsal</title>
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
        <div class="header-text">
            <h1>ANAK RAWA FUTSAL </h1>
            <p>KAMPUNG PENYENGAT</p>
          
        </div>
    </div>
    
    <!-- REPORT TITLE -->
    <h3 class="text-center" style="margin: 0 0 20px 0; font-size: 16px; color: #333; text-transform: uppercase;">
        LAPORAN PEMESANAN TAHUNAN
    </h3>
    
    <!-- REPORT INFO -->
    <div class="report-info">
        <p><strong>Tahun:</strong> {{ $tahun }}</p>
     
    </div>
    
    <!-- MAIN TABLE -->
    <table>
        <thead>
            <tr>
                <th width="50%">Bulan</th>
              
                <th width="30%">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allMonthsData as $pemesanan)
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($pemesanan->bulan)->locale('id')->monthName }}</td>
               
                <td class="text-right">Rp {{ number_format($pemesanan->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-left">Total Seluruhnya:</th>
               
                <th class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
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