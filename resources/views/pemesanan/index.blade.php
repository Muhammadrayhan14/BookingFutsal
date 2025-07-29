@extends('layouts.backend.main')

@section('title', 'Daftar Pemesanan')

@section('konten')
<div class="row">
    <div class="col-md-6">
        <h2>Daftar Pemesanan</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('pemesanan.create') }}" class="btn btn-primary">Buat Pemesanan</a>
    </div>
</div>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Lapangan</th>
            <th>Tanggal</th>
            <th>Jam Mulai</th>
            <th>Lama (jam)</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pemesanans as $index => $pemesanan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pemesanan->lapangan->nama_lapangan }}</td>
            <td>{{ $pemesanan->tanggal }}</td>
            <td>{{ $pemesanan->jam_mulai }}</td>
            <td>{{ $pemesanan->lama }}</td>
            <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
            <td>
                @if($pemesanan->status == 'belum selesai')
                    <span class="badge bg-warning">{{ $pemesanan->status }}</span>
                @else
                    <span class="badge bg-success">{{ $pemesanan->status }}</span>
                @endif
            </td>
            <td>
                <a href="{{ route('pemesanan.show', $pemesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
                @if(auth()->user()->role == 'admin' && $pemesanan->status == 'belum selesai')
                    <form action="{{ route('pemesanan.complete', $pemesanan->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection