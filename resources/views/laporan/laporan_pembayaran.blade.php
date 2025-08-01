@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Payment Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #e67300); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-money-bill-wave mr-2"></i> Laporan Pembayaran
            </h4>
            <div>
                <a href="{{ route('laporan.pembayaran.pdf', ['selected_date' => $selectedDate]) }}" 
                   class="btn btn-light" style="color: #e67300; font-weight: bold;">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <!-- Date Filter Form -->
            <form method="GET" action="{{ route('laporan.pembayaran') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="selected_date" style="color: #e67300; font-weight: 500;">Tanggal Pembayaran</label>
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
            
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="border-top-left-radius: 10px;">ID Pembayaran</th>
                            <th>Nama </th>
                            <th>Harga</th>
                        
                            <th style="border-top-right-radius: 10px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayarans as $pembayaran)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ $pembayaran->id }}</td>
                            <td>{{ $pembayaran->pemesanan->user->name }}</td>
                            <td>{{ $pembayaran->pemesanan->harga }}</td>
                           
                           
                            <td class="text-right" style="font-weight: bold; color: #e65100;">
                                Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4" style="background-color: #ffeedb;">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada data pembayaran untuk tanggal yang dipilih
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                  
                </table>
            </div>
        </div>
    </div>
</div>
@endsection