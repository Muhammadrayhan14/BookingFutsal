@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Sporty Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #e67300); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-futbol mr-2"></i> Laporan Data Lapangan
            </h4>
            <a href="{{ route('laporan.lapangan.pdf') }}" class="btn btn-light" style="color: #e67300; font-weight: bold; border: 1px solid #fff;">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
        
        <!-- Card Body with Sporty Feel -->
        <div class="card-body" style="background-color: #fff5e6;">
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <!-- Table Header with Grass-like Accent -->
                    <thead style="background: linear-gradient(to right, #ff9800, #ff8c00); color: white;">
                        <tr>
                            <th style="border-top-left-radius: 10px;">No</th>
                            <th>Nama Lapangan</th>
                            <th>Keterangan</th>
                            <th style="border-top-right-radius: 10px;">Jumlah Pemesanan</th>
                        </tr>
                    </thead>
                    
                    <!-- Table Body with Alternating Rows -->
                    <tbody>
                        @forelse($lapangans as $index => $lapangan)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffeedb' }};">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $lapangan->nama_lapangan }}</strong>
                            </td>
                            <td>{{ $lapangan->keterangan ?? '-' }}</td>
                            <td>
                                <span class="badge" style="background-color: #ff7043; color: white; padding: 5px 10px; border-radius: 10px;">
                                    {{ $lapangan->pemesanan->count() }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4" style="background-color: #ffeedb;">
                                <i class="fas fa-info-circle mr-2"></i> Tidak ada data lapangan
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