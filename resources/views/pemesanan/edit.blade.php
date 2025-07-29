@extends('layouts.backend.main')

@section('title', 'Edit Pemesanan')

@section('konten')
<div class="row">
    <div class="col-md-6">
        <h2>Edit Pemesanan</h2>
    </div>
</div>

<form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="lapangan_id" class="form-label">Lapangan</label>
        <select class="form-select" id="lapangan_id" name="lapangan_id" required>
            @foreach($lapangans as $lapangan)
                <option value="{{ $lapangan->id }}" @if($pemesanan->lapangan_id == $lapangan->id) selected @endif>
                    {{ $lapangan->nama_lapangan }} (Rp {{ number_format($lapangan->harga, 0, ',', '.') }}/jam)
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pemesanan->tanggal }}" required>
    </div>
    <div class="mb-3">
        <label for="jam_mulai" class="form-label">Jam Mulai</label>
        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $pemesanan->jam_mulai }}" required>
    </div>
    <div class="mb-3">
        <label for="lama" class="form-label">Lama (jam)</label>
        <input type="number" class="form-control" id="lama" name="lama" value="{{ $pemesanan->lama }}" min="1" max="4" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection