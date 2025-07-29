@extends('layouts.backend.main')

@section('konten')
<div class="container py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold text-light"><i class="fas fa-check-circle me-2 text-light"></i>Booking Berhasil</h2>
                <span class="badge bg-light text-success fs-6">ID: {{ $pembayaran->pemesanan->id }}</span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="alert alert-{{ $pembayaran->sisa_bayar <= 0 ? 'success' : 'warning' }}">
                <h4 class="alert-heading"><i class="fas fa-check me-2"></i>
                    {{ $pembayaran->sisa_bayar <= 0 ? 'Pembayaran Lunas Berhasil!' : 'Pembayaran DP Berhasil!' }}
                </h4>
                <p>
                    {{ $pembayaran->sisa_bayar <= 0 
                        ? 'Terima kasih telah melakukan pembayaran lunas. Booking Anda telah dikonfirmasi.' 
                        : 'Terima kasih telah melakukan booking. Silakan lakukan pelunasan sebelum waktu booking dimulai.' }}
                </p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Detail Booking</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-map-marker-alt me-2"></i>Lapangan</span>
                                    <span class="fw-bold">{{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-calendar-day me-2"></i>Tanggal</span>
                                    <span class="fw-bold">{{ date('d F Y', strtotime($pembayaran->pemesanan->tanggal)) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-clock me-2"></i>Waktu</span>
                                    <span class="fw-bold">
                                        {{ $pembayaran->pemesanan->jam_mulai }} - 
                                        {{ date('H:i', strtotime($pembayaran->pemesanan->jam_mulai) + ($pembayaran->pemesanan->lama * 3600)) }}
                                        ({{ $pembayaran->pemesanan->lama }} jam)
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-info-circle me-2"></i>Status</span>
                                    <span class="badge bg-{{ $pembayaran->pemesanan->status == 'lunas' ? 'success' : 'warning' }}">
                                        {{ $pembayaran->pemesanan->status == 'lunas' ? 'Lunas' : 'DP' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-tag me-2"></i>Total Harga</span>
                                    <span class="fw-bold text-success">Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-money-bill-wave me-2"></i>Pembayaran</span>
                                    <span class="fw-bold text-primary">Rp {{ number_format($pembayaran->dp, 0, ',', '.') }}</span>
                                </li>
                                @if($pembayaran->sisa_bayar > 0)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-money-bill me-2"></i>Sisa Pembayaran</span>
                                    <span class="fw-bold text-danger">Rp {{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('member.dashboard') }}" class="btn btn-dark btn-lg">
                    <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                </a>
                <a href="{{ route('pembayaran.invoice', $pembayaran->id) }}" class="btn btn-success btn-lg px-4 py-3 rounded-pill shadow-sm">
                    <i class="fas fa-print me-2"></i>Cetak Invoice
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .list-group-item {
        padding: 1rem 1.25rem;
    }
    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
    }
    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }
</style>
@endsection