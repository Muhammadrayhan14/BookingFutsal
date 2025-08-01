<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Lapangan - Anak Rawa Futsal</title>
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
        }
        .report-info p {
            margin: 5px 0;
            text-align: left;
            font-size: 12px;
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
            background-color: #f2f2f2; 
            color: #333; 
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
        
        /* IMAGE STYLES */
        .lapangan-image {
            max-width: 80px;
            max-height: 60px;
            display: block;
            margin: 0 auto;
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
        
        /* EMPTY STATE */
        .no-data {
            text-align: center;
            padding: 15px;
            font-style: italic;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <!-- HEADER SECTION -->
    <div class="header">
        <div class="header-text">
            <h1>ANAK RAWA FUTSAL</h1>
            <p>KAMPUNG PENYENGAT</p>
        </div>
    </div>
    
    <!-- REPORT TITLE -->
    <h3 class="report-title">LAPORAN DATA LAPANGAN</h3>
    
    <!-- REPORT INFO -->
    <div class="report-info">
    
    </div>
    
    <!-- MAIN TABLE -->
    <table>
        <thead>
            <tr>
               
                <th width="15%">ID Lapangan</th>
                <th width="25%">Nama Lapangan</th>
                <th width="25%">Harga</th>
                <th width="30%">Gambar</th>
                <th width="20%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lapangans as $index => $lapangan)
            <tr>
               
                <td class="text-center">{{ $lapangan->id }}</td>
                <td>{{ $lapangan->nama_lapangan }}</td>
                <td>{{ $lapangan->harga }}</td>
                <td class="text-center">
                    @if($lapangan->gambar)
                        @php
                            $imagePath = public_path('storage/' . $lapangan->gambar);
                            if(file_exists($imagePath)) {
                                $imageData = base64_encode(file_get_contents($imagePath));
                                $src = 'data:image/'.pathinfo($imagePath, PATHINFO_EXTENSION).';base64,'.$imageData;
                                echo '<img src="'.$src.'" class="lapangan-image">';
                            } else {
                                echo '<span>Gambar tidak ditemukan</span>';
                            }
                        @endphp
                    @else
                        -
                    @endif
                </td>
                <td>{{ $lapangan->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="no-data">Tidak ada data lapangan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- FOOTER SECTION -->
    <div class="footer">
        <div class="signature">
            <p>Padang, {{ $tanggal }}</p>
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