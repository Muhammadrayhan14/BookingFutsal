@extends('layouts.backend.main')

@section('konten')
<div class="container py-5">
    <div class="card border-0 shadow-lg overflow-hidden">
        <!-- Card Header with Gradient Background -->
        <div class="card-header bg-gradient-warning py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold text-white">
                    <i class="fas fa-calendar-alt me-3"></i>Booking Lapangan
                </h2>
              
            </div>
        </div>

        <div class="card-body p-0">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show m-4">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <h5 class="alert-heading d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>Error Booking
                </h5>
                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Lapangan Info Section -->
            <div class="p-4 pb-0">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="rounded-4 overflow-hidden shadow-sm" style="height: 200px;">
                            <img src="{{ asset('storage/' . $lapangan->gambar) }}" alt="{{ $lapangan->nama_lapangan }}" 
                                 class="img-fluid h-100 w-100 object-fit-cover">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex flex-column h-100 justify-content-between">
                            <div>
                                <h3 class="fw-bold text-dark mb-3">{{ $lapangan->nama_lapangan }}</h3>
                                <div class="d-flex align-items-center mb-2">
                                   
                                   
                                </div>
                                <p class="text-muted mb-2"><i class="fas fa-info-circle me-2"></i>Deskripsi:</p>
                                <p class="mb-0">{{ $lapangan->keterangan ?? 'Tidak ada deskripsi tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('pemesanan.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                <div class="p-4 pt-0 mt-4">
                    <div class="row g-4">
                        <!-- Booking Details Section -->
                        <div class="col-lg-8">
                            <div class="bg-light rounded-4 p-4">
                                <h4 class="fw-bold mb-4 d-flex align-items-center">
                                    <i class="fas fa-calendar-check me-3 text-warning"></i>Detail Booking
                                </h4>
                                
                                <div class="row g-3">
                                    <!-- Tanggal Booking -->
                                    <div class="col-md-6">
                                        <label for="tanggal" class="form-label fw-bold text-dark">
                                            <i class="fas fa-calendar-day me-2 text-warning"></i>Tanggal Booking
                                        </label>
                                        <input type="date" name="tanggal" class="form-control form-control-lg" 
                                               id="tanggal" required min="{{ date('Y-m-d') }}">
                                        <div class="invalid-feedback">Silakan pilih tanggal booking</div>
                                    </div>

                                    <!-- Jam Mulai -->
                                    <div class="col-md-6">
                                        <label for="jam_mulai" class="form-label fw-bold text-dark">
                                            <i class="fas fa-clock me-2 text-warning"></i>Jam Mulai
                                        </label>
                                        <select name="jam_mulai" class="form-select form-select-lg" id="jam_mulai" required>
                                            @for($i = 8; $i <= 22; $i++)
                                                <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }} - {{ sprintf('%02d:00', $i+1) }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Durasi -->
                                    <div class="col-md-6">
                                        <label for="lama" class="form-label fw-bold text-dark">
                                            <i class="fas fa-hourglass me-2 text-warning"></i>Durasi
                                        </label>
                                        <select name="lama" class="form-select form-select-lg" id="lama" required>
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }} Jam</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Harga -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="fas fa-tag me-2 text-warning"></i>Harga per Jam
                                        </label>
                                        <input type="hidden" name="harga" id="harga" value="{{ $lapangan->harga }}">
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning bg-opacity-10 border-warning text-dark fw-bold">Rp</span>
                                            <input type="text" class="form-control form-control-lg bg-warning bg-opacity-10 border-warning fw-bold" 
                                                   id="display-harga" value="{{ number_format($lapangan->harga, 0, ',', '.') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Summary Section -->
                        <div class="col-lg-4">
                            <div class="bg-light rounded-4 p-4 h-100">
                                <h4 class="fw-bold mb-4 d-flex align-items-center">
                                    <i class="fas fa-receipt me-3 text-warning"></i>Ringkasan
                                </h4>
                                
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Lapangan:</span>
                                        <span class="fw-bold">{{ $lapangan->nama_lapangan }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Tanggal:</span>
                                        <span class="fw-bold" id="preview-tanggal">-</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Waktu:</span>
                                        <span class="fw-bold" id="preview-jam">-</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">Durasi:</span>
                                        <span class="fw-bold" id="preview-durasi">-</span>
                                    </div>
                                    <hr class="my-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Total:</span>
                                        <h4 class="mb-0 fw-bold text-warning">Rp<span id="preview-total">0</span></h4>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-warning btn-lg w-100 py-3 fw-bold rounded-pill shadow-sm">
                                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Booking
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ff9500 0%, #ff5e00 100%);
    }
    
    .card {
        border-radius: 20px;
        overflow: hidden;
    }
    
    .form-control, .form-select {
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #ff9500;
        box-shadow: 0 0 0 0.25rem rgba(255, 149, 0, 0.25);
    }
    
    .form-control-lg, .form-select-lg {
        font-size: 1.05rem;
    }
    
    .btn-warning {
        background-color: #ff9500;
        border: none;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-warning:hover {
        background-color: #e68600;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 149, 0, 0.3);
    }
    
    .badge {
        border-radius: 10px;
    }
    
    .object-fit-cover {
        object-fit: cover;
    }
    
    .rounded-4 {
        border-radius: 20px !important;
    }
    
    .input-group-text {
        border-radius: 12px 0 0 12px !important;
    }
    
    .bg-warning-opacity-10 {
        background-color: rgba(255, 149, 0, 0.1);
    }
</style>

<script>
    // Live preview calculation (unchanged from original)
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalInput = document.getElementById('tanggal');
        const jamSelect = document.getElementById('jam_mulai');
        const durasiSelect = document.getElementById('lama');
        const hargaLapangan = parseInt(document.getElementById('harga').value);
        const displayHarga = document.getElementById('display-harga');
        
        const previewTanggal = document.getElementById('preview-tanggal');
        const previewJam = document.getElementById('preview-jam');
        const previewDurasi = document.getElementById('preview-durasi');
        const previewTotal = document.getElementById('preview-total');

        displayHarga.value = hargaLapangan.toLocaleString('id-ID');

        function updatePreview() {
            if (tanggalInput.value) {
                const date = new Date(tanggalInput.value);
                previewTanggal.textContent = date.toLocaleDateString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
            }
            
            if (jamSelect.value && durasiSelect.value) {
                const startTime = jamSelect.value;
                const duration = parseInt(durasiSelect.value);
                const [hours, minutes] = startTime.split(':').map(Number);
                const endTime = new Date(0, 0, 0, hours + duration, minutes);
                previewJam.textContent = `${startTime} - ${endTime.getHours()}:${endTime.getMinutes().toString().padStart(2, '0')}`;
                previewDurasi.textContent = `${duration} Jam`;
            }
            
            if (durasiSelect.value) {
                const duration = parseInt(durasiSelect.value);
                previewTotal.textContent = (hargaLapangan * duration).toLocaleString('id-ID');
            }
        }

        [tanggalInput, jamSelect, durasiSelect].forEach(element => {
            element.addEventListener('change', updatePreview);
            element.addEventListener('input', updatePreview);
        });

        updatePreview();
    });

    // Form validation (unchanged from original)
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection