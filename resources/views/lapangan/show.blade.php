@extends('layouts.backend.main')

@section('konten')
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('storage/' . $lapangan->gambar) }}" class="img-fluid rounded" alt="{{ $lapangan->nama_lapangan }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $lapangan->nama_lapangan }}</h1>
        <p><strong>Harga:</strong> Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</p>
        <p>{{ $lapangan->keterangan }}</p>
       
        
       
    </div>
</div>
@endsection