@extends('layouts.backend.main')

@section('konten')
<div class="container-fluid">
    <div class="card shadow mb-4" style="border: none; border-radius: 15px; background: #f8f9fa;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #ff7b25, #ff5200); border-radius: 15px 15px 0 0;">
            <h2 class="m-0 font-weight-bold text-white">
                <i class="fas fa-users mr-2"></i> Daftar Pengguna
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
            
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-orange text-white">
                        <tr>
                            <th width="5%">ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Role</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr style="border-left: 4px solid #ff5200;">
                            <td>{{ $user->id }}</td>
                            <td class="font-weight-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nohp }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if($user->role === 'pelanggan')
                                        <a href="{{ route('users.cetak-kartu', $user->id) }}" class="btn btn-sm btn-dark">
                                            <i class="fas fa-id-card mr-1"></i> Cetak Kartu
                                        </a>
                                    @endif
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
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