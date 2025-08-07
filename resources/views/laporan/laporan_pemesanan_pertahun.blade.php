@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Yearly Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #e67300); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-calendar-star mr-2"></i> Laporan Pemesanan Pertahun
            </h4>
            <div>
                @if(request()->filled('tahun'))
                <a href="{{ route('laporan.pemesanan.pertahun.pdf', ['tahun' => $tahun]) }}" class="btn btn-light" style="color: #e67300; font-weight: bold;">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
                @else
                <button class="btn btn-light" disabled style="opacity: 0.7;" title="Silakan pilih tahun terlebih dahulu">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
                @endif
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <!-- Year Filter Form -->
            <form method="GET" action="{{ route('laporan.pemesanan.pertahun') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tahun" style="color: #e67300; font-weight: 500;">Pilih Tahun</label>
                        <select name="tahun" id="tahun" class="form-control" required style="border-color: #ffb74d; border-radius: 8px;">
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn" style="background-color: #ff9800; color: white; border-radius: 8px;">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            
            @if(!request()->filled('tahun'))
            <div class="alert" style="background-color: #ffe0b2; border-left: 4px solid #ff9800; color: #e65100;">
                <i class="fas fa-info-circle mr-2"></i> Silakan pilih tahun untuk melihat data pemesanan.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="border-top-left-radius: 10px;">Bulan</th>
                            <th>Jumlah Pemesanan</th>
                            <th style="border-top-right-radius: 10px;">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allMonthsData as $pemesanan)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ \Carbon\Carbon::create()->month($pemesanan->bulan)->locale('id')->monthName }}</td>
                            <td class="text-center" style="font-weight: 500;">{{ $pemesanan->jumlah_pemesanan }}</td>
                            <td class="text-right" style="font-weight: bold; color: #e65100;">
                                Rp {{ number_format($pemesanan->total_pendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #ffcc80;">
                            <th class="text-right">Total Seluruhnya:</th>
                            <th class="text-center">{{ $allMonthsData->sum('jumlah_pemesanan') }}</th>
                            <th class="text-right" style="color: #e65100;">Rp {{ number_format($allMonthsData->sum('total_pendapatan'), 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection