@extends('layouts.backend,main')

@section('title', 'Edit Pembayaran')

@section('konten')
<div class="row">
    <div class="col-md-6">
        <h2>Edit Pembayaran</h2>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Informasi Pemesanan</h5>
        <table class="table">
            <tr>
                <th>Lapangan</th>
                <td>{{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $pembayaran->pemesanan->tanggal }}</td>
            </tr>
            <tr>
                <th>Jam Mulai</th>
                <td>{{ $pembayaran->pemesanan->jam_mulai }}</td>
            </tr>
            <tr>
                <th>Lama</th>
                <td>{{ $pembayaran->pemesanan->lama }} jam</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp {{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>

        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="dp" class="form-label">DP (Uang Muka)</label>
                <input type="number" class="form-control" id="dp" name="dp" value="{{ $pembayaran->dp }}" min="0" max="{{ $pembayaran->pemesanan->total_harga }}" required>
                <small class="text-muted">Sisa bayar akan dihitung otomatis</small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pemesanan.show', $pembayaran->pemesanan_id) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection