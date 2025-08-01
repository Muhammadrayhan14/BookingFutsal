@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #e67300); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-calendar-alt mr-2"></i> Laporan Pemesanan
            </h4>
            <div>
                @if(request()->filled('selected_date'))
                <a href="{{ route('laporan.pemesanan.pdf', ['selected_date' => request('selected_date')]) }}" class="btn btn-light" style="color: #e67300; font-weight: bold;">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
                @else
                <button class="btn btn-light" disabled style="opacity: 0.7;" title="Silakan pilih tanggal terlebih dahulu">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
                @endif
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('laporan.pemesanan') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="selected_date" style="color: #e67300; font-weight: 500;">Tanggal Pemesanan</label>
                        <input type="date" name="selected_date" id="selected_date" 
                               class="form-control" value="{{ $selectedDate }}" required
                               style="border-color: #ffb74d; border-radius: 8px;">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn" style="background-color: #ff9800; color: white; border-radius: 8px;">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            
            @if(!request()->filled('selected_date'))
            <div class="alert" style="background-color: #ffe0b2; border-left: 4px solid #ff9800; color: #e65100;">
                <i class="fas fa-info-circle mr-2"></i> Silakan pilih tanggal untuk melihat data pemesanan.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="border-top-left-radius: 10px;">ID Pemesanan</th>
                            <th>Nama </th>
                            <th>Harga</th>
                            <th>DP</th>
                            <th>Lama</th>
                         
                            
                        
                           
                           
                         
                            <th style="border-top-right-radius: 10px;">Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemesanans as $pemesanan)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ $pemesanan->id }}</td>
                            <td>{{ $pemesanan->user->name }}</td>
                           
                            <td>Rp {{ number_format($pemesanan->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pemesanan->pembayaran->dp ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $pemesanan->lama }}</td>
                            <td style="font-weight: bold; color: #e65100;">
                                Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4" style="background-color: #ffeedb;">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada data pemesanan untuk tanggal yang dipilih
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