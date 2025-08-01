<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan User - Anak Rawa Futsal</title>
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
        
        /* EMPTY STATE */
        .no-data {
            text-align: center;
            padding: 15px;
            font-style: italic;
            color: #7f8c8d;
        }
        
        /* ROLE BADGES */
        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-admin {
            background-color: #28a745;
            color: white;
        }
        .badge-member {
            background-color: #17a2b8;
            color: white;
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
    <h3 class="report-title">LAPORAN DATA USER</h3>
    
    <!-- REPORT INFO -->
    <div class="report-info">
       
    </div>
    
    <!-- MAIN TABLE -->
    <table>
        <thead>
            <tr>
              
                <th width="15%">ID User</th>
                <th width="25%">Nama</th>
                <th width="25%">Email</th>
                <th width="15%">No HP</th>
                <th width="15%">Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $user)
            <tr>
              
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->nohp ?? '-' }}</td>
                <td class="text-center">
                    <span class="badge badge-{{ $user->role }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="no-data">Tidak ada data user</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- FOOTER SECTION -->
    <div class="footer">
        <div class="signature">
            <p>Padang, {{ date('d F Y') }}</p>
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