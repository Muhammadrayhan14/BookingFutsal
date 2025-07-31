@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <h1>Tambah Lapangan Baru</h1>
    
    <form action="{{ route('lapangan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="nama_lapangan">Nama Lapangan</label>
            <input type="text" class="form-control" id="nama_lapangan" name="nama_lapangan" required>
        </div>
        
        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control-file" id="gambar" name="gambar">
        </div>
        <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" required min="0">
        </div>
        
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('lapangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection