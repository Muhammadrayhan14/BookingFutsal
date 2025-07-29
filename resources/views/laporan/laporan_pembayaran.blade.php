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
                @if(request()->filled('start_date') && request()->filled('end_date'))
                <a href="{{ route('laporan.pembayaran.pdf', request()->query()) }}" class="btn btn-light" style="color: #e67300; font-weight: bold;">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
                @else
                <button class="btn btn-light" disabled style="opacity: 0.7;" title="Silakan filter tanggal terlebih dahulu">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
                @endif
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <!-- Date Range Filter Form -->
            <form method="GET" action="{{ route('laporan.pembayaran') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date" style="color: #e67300; font-weight: 500;">Dari Tanggal</label>
                        <input type="date" name="start_date" id="start_date" 
                               class="form-control" value="{{ $startDate }}" required
                               style="border-color: #ffb74d; border-radius: 8px;">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" style="color: #e67300; font-weight: 500;">Sampai Tanggal</label>
                        <input type="date" name="end_date" id="end_date" 
                               class="form-control" value="{{ $endDate }}" required
                               style="border-color: #ffb74d; border-radius: 8px;">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn" style="background-color: #ff9800; color: white; border-radius: 8px;">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            
            @if(!request()->filled('start_date') || !request()->filled('end_date'))
            <div class="alert" style="background-color: #ffe0b2; border-left: 4px solid #ff9800; color: #e65100;">
                <i class="fas fa-info-circle mr-2"></i> Silakan pilih rentang tanggal untuk melihat data pembayaran.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="border-top-left-radius: 10px;">ID Pembayaran</th>
                            <th>Nama Pelanggan</th>
                            <th>Harga</th>
                            <th>DP</th>
                            <th style="border-top-right-radius: 10px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayarans as $pembayaran)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ $pembayaran->id }}</td>
                            <td>{{ $pembayaran->pemesanan->user->name }}</td>
                            <td class="text-right">Rp {{ number_format($pembayaran->pemesanan->harga, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</td>
                            <td class="text-right" style="font-weight: bold; color: #e65100;">
                                Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4" style="background-color: #ffeedb;">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada data pembayaran untuk periode yang dipilih
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($pembayarans->count() > 0)
                    <tfoot>
                        <tr style="background-color: #ffcc80;">
                            <th colspan="2" class="text-right">Total:</th>
                            <th class="text-right">Rp {{ number_format($pembayarans->sum(function($p) { return $p->pemesanan->harga; }), 0, ',', '.') }}</th>
                            <th class="text-right">Rp {{ number_format($pembayarans->sum('dp'), 0, ',', '.') }}</th>
                            <th class="text-right" style="color: #e65100;">Rp {{ number_format($pembayarans->sum(function($p) { return $p->pemesanan->total_harga; }), 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection