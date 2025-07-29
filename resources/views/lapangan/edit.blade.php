@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <h1>Edit Lapangan</h1>
    
    <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama_lapangan">Nama Lapangan</label>
            <input type="text" class="form-control" id="nama_lapangan" name="nama_lapangan" value="{{ $lapangan->nama_lapangan }}" required>
        </div>
        
        <div class="form-group">
            <label for="gambar">Gambar</label>
            @if($lapangan->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $lapangan->gambar) }}" alt="{{ $lapangan->nama_lapangan }}" width="150">
                </div>
            @endif
            <input type="file" class="form-control-file" id="gambar" name="gambar">
            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
        </div>
        
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $lapangan->keterangan }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('lapangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection