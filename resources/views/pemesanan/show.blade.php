@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Detail Pemesanan</h2>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Informasi Pemesanan</h5>
        <table class="table">
            <tr>
                <th>Lapangan</th>
                <td>{{ $pemesanan->lapangan->nama_lapangan }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $pemesanan->tanggal }}</td>
            </tr>
            <tr>
                <th>Jam Mulai</th>
                <td>{{ $pemesanan->jam_mulai }}</td>
            </tr>
            <tr>
                <th>Lama</th>
                <td>{{ $pemesanan->lama }} jam</td>
            </tr>
            <tr>
                <th>Harga per Jam</th>
                <td>Rp {{ number_format($pemesanan->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($pemesanan->status == 'belum selesai')
                        <span class="badge bg-warning">{{ $pemesanan->status }}</span>
                    @else
                        <span class="badge bg-success">{{ $pemesanan->status }}</span>
                    @endif
                </td>
            </tr>
        </table>

        @if($pemesanan->pembayaran)
            <h5 class="mt-4">Informasi Pembayaran</h5>
            <table class="table">
                <tr>
                    <th>DP</th>
                    <td>Rp {{ number_format($pemesanan->pembayaran->dp, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Sisa Bayar</th>
                    <td>Rp {{ number_format($pemesanan->pembayaran->sisa_bayar, 0, ',', '.') }}</td>
                </tr>
            </table>
        @elseif($pemesanan->status == 'belum selesai')
            <a href="{{ route('pembayaran.create', $pemesanan->id) }}" class="btn btn-primary mt-3">Bayar DP</a>
        @endif
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
    @if(auth()->user()->role == 'admin' && $pemesanan->status == 'belum selesai')
        <form action="{{ route('pemesanan.complete', $pemesanan->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">Selesai</button>
        </form>
    @endif
</div>
@endsection