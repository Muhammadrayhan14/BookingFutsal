@extends('layouts.backend.main')

@section('konten')
<div class="container">
    <div class="card shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
        <!-- Card Header with Orange Gradient -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #ff8c00, #ff6b00); color: white;">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-users mr-2"></i> Laporan Data User
            </h4>
            <a href="{{ route('laporan.user.pdf') }}" class="btn btn-light" style="color: #ff6b00; font-weight: bold;">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
        
        <!-- Card Body -->
        <div class="card-body" style="background-color: #fff8f0;">
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0" style="border-radius: 10px; overflow: hidden;">
                    <!-- Table Header with Dark Orange -->
                    <thead style="background-color: #e65100; color: white;">
                        <tr>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    
                    <!-- Table Body with Alternating Rows -->
                    <tbody>
                        @forelse($users as $user)
                        <tr style="background-color: {{ $loop->odd ? '#fff' : '#ffefe0' }};">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nohp ?? '-' }}</td>
                            <td>
                                <span class="badge" style="background-color: {{ $user->role === 'admin' ? '#ff5722' : '#ff9800' }}; color: white;">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center" style="background-color: #ffefe0;">Tidak ada data user</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection