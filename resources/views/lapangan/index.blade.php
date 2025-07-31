@extends('layouts.backend.main')

@section('konten')
<div class="container-fluid">
    <div class="card shadow mb-4" style="border: none; border-radius: 15px; background: #f8f9fa;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #ff7b25, #ff5200); border-radius: 15px 15px 0 0;">
            <h2 class="m-0 font-weight-bold text-white">
                <i class="fas fa-futbol mr-2"></i> Daftar Lapangan Futsal
            </h2>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" style="border-left: 5px solid #28a745;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <a href="{{ route('lapangan.create') }}" class="btn btn-orange mb-4">
                <i class="fas fa-plus mr-2"></i> Tambah Lapangan
            </a>
            
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-orange text-white">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Lapangan</th>
                            <th width="15%">Gambar</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lapangan as $key => $item)
                        <tr style="border-left: 4px solid #ff5200;">
                            <td>{{ $key + 1 }}</td>
                            <td class="font-weight-bold">{{ $item->nama_lapangan }}</td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_lapangan }}" 
                                         class="img-thumbnail" style="width: 100px; height: 60px; object-fit: cover; border: 2px solid #ff7b25;">
                                @else
                                    <span class="badge badge-secondary">No Image</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('lapangan.show', $item->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lapangan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lapangan.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-orange {
        background: linear-gradient(135deg, #ff7b25, #ff5200);
        color: white;
        border: none;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .btn-orange:hover {
        background: linear-gradient(135deg, #ff5200, #ff7b25);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 82, 0, 0.3);
    }
    
    .bg-orange {
        background: linear-gradient(135deg, #ff7b25, #ff5200);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(255, 123, 37, 0.1);
    }
    
    .badge-secondary {
        background-color: #6c757d;
    }
</style>
@endsection