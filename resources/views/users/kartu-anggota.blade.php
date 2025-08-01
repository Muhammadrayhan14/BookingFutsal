<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Anggota - Anak Rawa Futsal Kampung Penyengat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kartu-container {
            width: 90mm;
            height: 54mm;
            border: 2px solid #333;
            margin: 0 auto;
            display: flex;
            position: relative;
        }
        .foto-section {
            width: 30%;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }
        .foto-section img {
            max-width: 100%;
            max-height: 100%;
        }
        .info-section {
            width: 70%;
            padding: 56px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 14px;
            margin: 0;
            color: #0066cc;
        }
        .header h2 {
            font-size: 12px;
            margin: 0;
            color: #333;
        }
        .info-item {
            margin-bottom: 5px;
            font-size: 10px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 50px;
        }
        .footer {
            position: absolute;
            bottom: 5px;
            right: 10px;
            font-size: 8px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="kartu-container">
       
        <div class="info-section">
            <div class="header">
                <h1>ANAK RAWA FUTSAL</h1>
                <h2>KAMPUNG PENYENGAT</h2>
                <hr>
                <h2>KARTU ANGGOTA</h2>
            </div>
            
            <div class="info-item">
                <span class="info-label">ID:</span> {{ $user->id }}
            </div>
            <div class="info-item">
                <span class="info-label">Nama:</span> {{ $user->name }}
            </div>
            <div class="info-item">
                <span class="info-label">No HP:</span> {{ $user->nohp }}
            </div>
            
          
        </div>
    </div>
</body>
</html>