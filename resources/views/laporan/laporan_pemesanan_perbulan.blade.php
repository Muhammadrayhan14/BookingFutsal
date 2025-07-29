@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #e67300); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-calendar-month mr-2"></i> Laporan Pemesanan Perbulan
            </h4>
            <div>
                @if(request()->filled('bulan'))
                <a href="{{ route('laporan.pemesanan.perbulan.pdf', ['bulan' => $bulan]) }}" class="btn btn-light" style="color: #e67300; font-weight: bold;">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
                @else
                <button class="btn btn-light" disabled style="opacity: 0.7;" title="Silakan pilih bulan terlebih dahulu">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
                @endif
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('laporan.pemesanan.perbulan') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="bulan" style="color: #e67300; font-weight: 500;">Pilih Bulan</label>
                        <input type="month" name="bulan" id="bulan" 
                               class="form-control" value="{{ $bulan }}" required
                               style="border-color: #ffb74d; border-radius: 8px;">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn" style="background-color: #ff9800; color: white; border-radius: 8px;">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            
            @if(!request()->filled('bulan'))
            <div class="alert" style="background-color: #ffe0b2; border-left: 4px solid #ff9800; color: #e65100;">
                <i class="fas fa-info-circle mr-2"></i> Silakan pilih bulan untuk melihat data pemesanan.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="border-top-left-radius: 10px;">ID Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Harga/jam</th>
                            <th>DP</th>
                            <th>Lama (jam)</th>
                            <th style="border-top-right-radius: 10px;">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemesanans as $pemesanan)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ $pemesanan->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $pemesanan->user->name }}</td>
                            <td>Rp {{ number_format($pemesanan->harga, 0, ',', '.') }}</td>
                            <td>
                                @if($pemesanan->pembayaran)
                                    Rp {{ number_format($pemesanan->pembayaran->dp, 0, ',', '.') }}
                                @else
                                    Rp 0
                                @endif
                            </td>
                            <td>{{ $pemesanan->lama }}</td>
                            <td style="font-weight: bold; color: #e65100;">
                                Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4" style="background-color: #ffeedb;">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada data pemesanan untuk bulan yang dipilih
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection