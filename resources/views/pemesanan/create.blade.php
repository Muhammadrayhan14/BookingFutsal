@extends('layouts.backend.main')

@section('konten')
<div class="container py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-warning text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold"><i class="fas fa-calendar-alt me-2"></i>Booking Lapangan</h2>
            </div>
        </div>

        <div class="card-body p-4">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Error Booking</h5>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Lapangan Info Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="rounded-3 overflow-hidden" style="height: 200px;">
                        <img src="{{ asset('storage/' . $lapangan->gambar) }}" alt="{{ $lapangan->nama_lapangan }}" class="img-fluid h-100 w-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-md-8">
                    <h3 class="fw-bold text-dark">{{ $lapangan->nama_lapangan }}</h3>
                    <p class="text-muted mb-2"><i class="fas fa-info-circle me-2"></i>Deskripsi:</p>
                    <p>{{ $lapangan->keterangan ?? 'Tidak ada deskripsi tersedia' }}</p>
                
                </div>
            </div>

            <form action="{{ route('pemesanan.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                <div class="row g-3">
                    <!-- Tanggal Booking -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="tanggal" class="form-control" id="tanggal" required min="{{ date('Y-m-d') }}">
                            <label for="tanggal"><i class="fas fa-calendar-day me-2"></i>Tanggal Booking</label>
                            <div class="invalid-feedback">Silakan pilih tanggal booking</div>
                        </div>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="jam_mulai" class="form-select" id="jam_mulai" required>
                                @for($i = 8; $i <= 22; $i++)
                                    <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }} - {{ sprintf('%02d:00', $i+1) }}</option>
                                @endfor
                            </select>
                            <label for="jam_mulai"><i class="fas fa-clock me-2"></i>Jam Mulai</label>
                        </div>
                    </div>

                    <!-- Durasi -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="lama" class="form-select" id="lama" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Jam</option>
                                @endfor
                            </select>
                            <label for="lama"><i class="fas fa-hourglass me-2"></i>Durasi</label>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="harga" class="form-control" id="harga" min="0" required value="{{ old('harga', $lapangan->harga ?? '') }}">
                            <label for="harga"><i class="fas fa-tag me-2"></i>Harga per Jam (Rp)</label>
                        </div>
                    </div>

                    <!-- Preview Booking -->
                    <div class="col-12">
                        <div class="card bg-light mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-receipt me-2"></i>Ringkasan Booking</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Lapangan:</strong> {{ $lapangan->nama_lapangan }}</p>
                                        <p class="mb-1"><strong>Tanggal:</strong> <span id="preview-tanggal">-</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Waktu:</strong> <span id="preview-jam">-</span></p>
                                        <p class="mb-1"><strong>Durasi:</strong> <span id="preview-durasi">-</span></p>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="text-end"><strong>Total:</strong> Rp<span id="preview-total">0</span></h5>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-light btn-lg px-4 py-2">
                            <i class="fas fa-check-circle me-2"></i>Konfirmasi Booking
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .form-floating>label {
        padding-left: 2.5rem;
    }
    .form-floating>.form-control, .form-floating>.form-select {
        height: calc(3.5rem + 2px);
        padding-left: 2.5rem;
    }
    .form-control, .form-select {
        border-radius: 10px;
    }
    .btn-light {
        background-color: #ff9500;
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        transition: all 0.3s;
    }
    .btn-light:hover {
        background-color: #ffbf00;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>

<script>
    // Live preview calculation
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalInput = document.getElementById('tanggal');
        const jamSelect = document.getElementById('jam_mulai');
        const durasiSelect = document.getElementById('lama');
        const hargaInput = document.getElementById('harga');
        
        const previewTanggal = document.getElementById('preview-tanggal');
        const previewJam = document.getElementById('preview-jam');
        const previewDurasi = document.getElementById('preview-durasi');
        const previewTotal = document.getElementById('preview-total');

        function updatePreview() {
            // Format date
            if (tanggalInput.value) {
                const date = new Date(tanggalInput.value);
                previewTanggal.textContent = date.toLocaleDateString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
            }
            
            // Calculate end time
            if (jamSelect.value && durasiSelect.value) {
                const startTime = jamSelect.value;
                const duration = parseInt(durasiSelect.value);
                const [hours, minutes] = startTime.split(':').map(Number);
                const endTime = new Date(0, 0, 0, hours + duration, minutes);
                previewJam.textContent = `${startTime} - ${endTime.getHours()}:${endTime.getMinutes().toString().padStart(2, '0')}`;
                previewDurasi.textContent = `${duration} Jam`;
            }
            
            // Calculate total
            if (hargaInput.value && durasiSelect.value) {
                const price = parseInt(hargaInput.value);
                const duration = parseInt(durasiSelect.value);
                previewTotal.textContent = (price * duration).toLocaleString('id-ID');
            }
        }

        // Add event listeners
        [tanggalInput, jamSelect, durasiSelect, hargaInput].forEach(element => {
            element.addEventListener('change', updatePreview);
            element.addEventListener('input', updatePreview);
        });

        // Initial update
        updatePreview();
    });

    // Form validation
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