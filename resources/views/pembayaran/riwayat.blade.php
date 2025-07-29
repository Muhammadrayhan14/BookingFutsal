@extends('layouts.backend.main')

@section('konten')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg overflow-hidden">
        <!-- Card Header with Gradient Background -->
        <div class="card-header bg-gradient-primary text-white position-relative">
            <div class="position-absolute top-0 end-0 bg-white opacity-10" style="width: 150px; height: 150px; border-radius: 50%; transform: translate(50px, -50px);"></div>
            <div class="d-flex justify-content-between align-items-center position-relative">
                <div>
                    <h2 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i>Riwayat Transaksi</h2>
                    <p class="mb-0 opacity-75 text-dark">Daftar lengkap transaksi Anda</p>
                </div>
                <div class="bg-white text-dark p-2 rounded-circle">
                    <i class="fas fa-receipt fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($pembayarans->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-calendar-times fa-4x text-muted opacity-25"></i>
                    </div>
                    <h5 class="text-muted">Anda belum memiliki riwayat transaksi</h5>
                    <p class="text-muted">Semua transaksi Anda akan muncul di sini</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Tanggal</th>
                                <th>Lapangan</th>
                                <th>Waktu Booking</th>
                                <th class="text-end">Total</th>
                                <th class="text-end">DP</th>
                                <th class="text-end">Sisa</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayarans as $index => $pembayaran)
                            <tr class="border-bottom">
                                <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $pembayaran->created_at->format('d M') }}</span>
                                        <small class="text-muted">{{ $pembayaran->created_at->format('Y') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-map-marker-alt text-dark"></i>
                                        </div>
                                        <span class="fw-bold">{{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ date('d M', strtotime($pembayaran->pemesanan->tanggal)) }}</span>
                                        <small class="text-muted">
                                            {{ $pembayaran->pemesanan->jam_mulai }} - {{ date('H:i', strtotime($pembayaran->pemesanan->jam_mulai) + ($pembayaran->pemesanan->lama * 3600)) }}
                                        </small>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">Rp{{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</td>
                                <td class="text-end text-primary fw-bold">Rp{{ number_format($pembayaran->dp, 0, ',', '.') }}</td>
                                <td class="text-end text-danger fw-bold">Rp{{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</td>
                                <td>
                                    @if($pembayaran->pemesanan->status == 'lunas')
                                        <span class="badge bg-success bg-opacity-10 text-light">lunas</span>
                                    @elseif($pembayaran->pemesanan->status == 'batal')
                                        <span class="badge bg-danger bg-opacity-10 text-light">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-10 text-light">Dp</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('pembayaran.invoice', $pembayaran->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-circle"
                                       title="Cetak Invoice"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if(!$pembayarans->isEmpty())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan {{ $pembayarans->count() }} transaksi</small>
                <small class="text-muted">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</small>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        padding: 1.5rem;
        border-bottom: none;
    }
    .table {
        margin-bottom: 0;
    }
    .table th {
        border-top: none;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }
    .table tr:last-child td {
        border-bottom: none;
    }
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        border-radius: 6px;
    }
    .btn-outline-primary {
        border-width: 2px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
</style>

<script>
    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection