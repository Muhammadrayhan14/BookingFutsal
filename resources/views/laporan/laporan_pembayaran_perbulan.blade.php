@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Monthly Payment Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #e67300); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-calendar-check mr-2"></i> Laporan Pembayaran Bulanan
            </h4>
            <div>
                @if(request()->filled('bulan') && request()->filled('tahun'))
                <a href="{{ route('laporan.pembayaran.perbulan.pdf', request()->query()) }}" class="btn btn-light" style="color: #e67300; font-weight: bold;">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
                @else
                <button class="btn btn-light" disabled style="opacity: 0.7;" title="Silakan pilih bulan dan tahun terlebih dahulu">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </button>
                @endif
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <!-- Month/Year Filter Form -->
            <form method="GET" action="{{ route('laporan.pembayaran.perbulan') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-5">
                        <label for="bulan" style="color: #e67300; font-weight: 500;">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="form-control" required style="border-color: #ffb74d; border-radius: 8px;">
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{ (int)$bulan === $month ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($month)->locale('id')->monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="tahun" style="color: #e67300; font-weight: 500;">Pilih Tahun</label>
                        <select name="tahun" id="tahun" class="form-control" required style="border-color: #ffb74d; border-radius: 8px;">
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ (int)$tahun === $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn w-100" style="background-color: #ff9800; color: white; border-radius: 8px;">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
            
            @if(!request()->filled('bulan') || !request()->filled('tahun'))
            <div class="alert" style="background-color: #ffe0b2; border-left: 4px solid #ff9800; color: #e65100;">
                <i class="fas fa-info-circle mr-2"></i> Silakan pilih bulan dan tahun untuk melihat data pembayaran.
            </div>
            @else
            <div class="alert" style="background-color: #d4edda; border-left: 4px solid #28a745; color: #155724;">
                <i class="fas fa-calendar-alt mr-2"></i> Menampilkan data pembayaran bulan 
                <strong>{{ \Carbon\Carbon::create()->month((int)$bulan)->locale('id')->monthName }} {{ $tahun }}</strong>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="width:10%; border-top-left-radius: 10px;">ID Pembayaran</th>
                            <th style="width:25%">Nama </th>
                            <th style="width:20%">Tanggal </th>
                            <th style="width:20%">Harga </th>
                      
                            <th style="width:15%">Total</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPendapatan = 0;
                        @endphp
                        
                        @forelse($pembayarans as $pembayaran)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ $pembayaran->id }}</td>
                            <td>{{ $pembayaran->pemesanan->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="text-right">Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</td>
                            <td class="text-right" style="font-weight: bold; color: #e65100;">
                                Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @php
                            $totalPendapatan += $pembayaran->pemesanan->total_harga;
                        @endphp
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4" style="background-color: #ffeedb;">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada data pembayaran untuk periode ini
                            </td>
                        </tr>
                        @endforelse
                        
                        @if($pembayarans->count() > 0)
                        <tr style="background-color: #fff2e6; font-weight: bold;">
                            <td colspan="4" style="border-bottom-left-radius: 10px;">Total Seluruhnya</td>
                            <td class="text-right" style="border-bottom-right-radius: 10px; color: #e65100;">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                 
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection