@extends('layouts.backend.main')

@section('konten')
<div class="container-fluid py-4">
    <!-- Search Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mb-sm-0">
                            <div class="icon-shape bg-warning bg-opacity-10 text-dark rounded-circle me-3">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h1 class="h4 mb-0">Cek Ketersediaan Lapangan</h1>
                                <p class="mb-0 text-muted">Pilih tanggal dan lapangan untuk melihat jadwal tersedia</p>
                            </div>
                        </div>
                        <form method="GET" class="row g-2 flex-grow-1 ms-sm-4">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold">Tanggal Booking</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="far fa-calendar"></i></span>
                                    <input type="date" class="form-control flatpickr" name="tanggal" 
                                           value="{{ $tanggal }}" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-bold">Pilih Lapangan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt"></i></span>
                                    <select class="form-select" name="lapangan_id">
                                        <option value="">Semua Lapangan</option>
                                        @foreach($lapangans as $lap)
                                        <option value="{{ $lap->id }}" {{ request('lapangan_id') == $lap->id ? 'selected' : '' }}>
                                            {{ $lap->nama_lapangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-dark w-100">
                                    <i class="fas fa-search me-1"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($lapangans as $lapangan)
    <div class="card mb-4 border-0 shadow-sm hover-lift">
        <div class="card-header bg-white border-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
            <div class="d-flex align-items-center mb-2 mb-md-0">
                <div class="icon-shape bg-warning bg-opacity-10 text-dark rounded-circle me-3">
                    <i class="fas fa-futbol"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">{{ $lapangan->nama_lapangan }}</h5>
                    <p class="mb-0 small text-muted">{{ $lapangan->keterangan }}</p>
                    <h6 class="mb-0  text-muted">Harga :</h6>
                    <h6 class="mb-0 small text-danger">Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</h6>
                </div>
                
            </div>
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-2">
             
                <a href="{{ route('pemesanan.create', ['lapangan_id' => $lapangan->id, 'tanggal' => $tanggal]) }}" 
                   class="btn btn-sm btn-dark">
                    <i class="fas fa-plus me-1"></i> Booking Sekarang
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Date Indicator -->
            <div class="alert alert-light border mb-4 d-flex align-items-center">
                <i class="far fa-calendar-check text-primary me-3 fs-4"></i>
                <div>
                    <h6 class="mb-0 fw-bold">{{ date('l, d F Y', strtotime($tanggal)) }}</h6>
                    <small class="text-muted">Slot waktu yang tersedia ditandai dengan warna hijau</small>
                </div>
            </div>

            <!-- Time Slot Grid -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-uppercase small">Slot Waktu Tersedia</h6>
                    <div class="legend d-flex gap-2">
                        <span class="badge bg-success bg-opacity-10 text-light">
                            <i class="fas fa-circle me-1 small"></i> Tersedia
                        </span>
                        <span class="badge bg-danger bg-opacity-10 text-light">
                            <i class="fas fa-circle me-1 small"></i> Terbooking
                        </span>
                    </div>
                </div>
                
                @php
                    $bookings = $allBookings->where('lapangan_id', $lapangan->id);
                    $bookedSlots = [];
                    
                    foreach ($bookings as $booking) {
                        $start = \Carbon\Carbon::parse($booking->jam_mulai);
                        $end = $start->copy()->addHours($booking->lama);
                        $current = $start->copy();
                        
                        while ($current < $end) {
                            $bookedSlots[] = $current->format('H:i');
                            $current->addHour();
                        }
                    }
                @endphp
                
                <div class="availability-grid mb-3">
                    @foreach($allSlots as $slot)
                    @if(in_array($slot, $bookedSlots))
                    <!-- Booked Slot -->
                    <div class="slot booked" data-bs-toggle="tooltip" title="Sudah dibooking">
                        <div class="slot-inner">
                            {{ $slot }}
                            <span class="slot-status"><i class="fas fa-lock"></i></span>
                        </div>
                    </div>
                    @else
                    <!-- Available Slot -->
                    <a href="{{ route('pemesanan.create', [
                        'lapangan_id' => $lapangan->id,
                        'tanggal' => $tanggal,
                        'jam_mulai' => $slot
                    ]) }}" class="slot available" data-bs-toggle="tooltip" title="Klik untuk booking">
                        <div class="slot-inner">
                            {{ $slot }}
                            <span class="slot-status"><i class="fas fa-check"></i></span>
                        </div>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Booking List -->
            <div class="border-top pt-4">
                <h6 class="fw-bold mb-3 text-uppercase small">Daftar Booking Hari Ini</h6>
                
                @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-borderless table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase small fw-bold">Waktu</th>
                                <th class="text-uppercase small fw-bold">Durasi</th>
                                <th class="text-uppercase small fw-bold">Pemesan</th>
                                <th class="text-uppercase small fw-bold text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam_mulai)->format('H.i') }}</span>
                                    - 
                                    <span class="fw-bold">{{ \Carbon\Carbon::parse($booking->jam_mulai)->addHours($booking->lama)->format('H:i') }}</span>
                                </td>
                                <td>{{ $booking->lama }} jam</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-warning bg-opacity-10 text-light rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            {{ substr($booking->user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $booking->user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-light border text-center py-4">
                    <i class="far fa-calendar-times fa-2x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada booking untuk hari ini</h5>
                    <p class="mb-0">Jadilah yang pertama booking lapangan ini!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .icon-shape {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .availability-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
    }
    
    .slot {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s;
        height: 60px;
        display: flex;
        text-decoration: none !important;
    }
    
    .slot-inner {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        padding: 0 12px;
    }
    
    .slot-status {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 12px;
    }
    
    .slot.available {
        background-color: rgba(25, 135, 84, 0.08);
        color: #198754;
        border: 1px solid rgba(25, 135, 84, 0.2);
    }
    
    .slot.available:hover {
        background-color: rgba(25, 135, 84, 0.15);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(25, 135, 84, 0.1);
    }
    
    .slot.booked {
        background-color: rgba(220, 53, 69, 0.08);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
        cursor: not-allowed;
    }
    
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08) !important;
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
    
    .flatpickr {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    
    @media (max-width: 768px) {
        .availability-grid {
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        }
        
        .slot-inner {
            font-size: 14px;
            padding: 0 4px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltips.map(function (el) {
        return new bootstrap.Tooltip(el)
    });
});
</script>
@endsection