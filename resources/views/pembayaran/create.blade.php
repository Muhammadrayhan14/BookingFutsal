@extends('layouts.backend.main')

@section('konten')
<div class="container py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-warning text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold"><i class="fas fa-credit-card me-2"></i>Pembayaran Booking</h2>
                <span class="badge bg-light text-dark fs-6">ID: {{ $pemesanan->id }}</span>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Booking Summary -->
            <div class="booking-summary mb-4 p-4 border rounded-3 bg-light">
                <h4 class="mb-3 text-dark"><i class="fas fa-calendar-check me-2"></i>Detail Booking</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex mb-3">
                            <div class="me-3 text-warning">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Lapangan</h6>
                                <p class="mb-0 fw-bold">{{ $pemesanan->lapangan->nama_lapangan }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3">
                            <div class="me-3 text-warning">
                                <i class="fas fa-calendar-day fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Tanggal</h6>
                                <p class="mb-0 fw-bold">{{ date('d F Y', strtotime($pemesanan->tanggal)) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="d-flex mb-3">
                            <div class="me-3 text-warning">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Waktu</h6>
                                <p class="mb-0 fw-bold">
                                    {{ $pemesanan->jam_mulai }} - {{ date('H:i', strtotime($pemesanan->jam_mulai) + ($pemesanan->lama * 3600)) }}
                                    ({{ $pemesanan->lama }} jam)
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="me-3 text-warning">
                                <i class="fas fa-tag fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Total Harga</h6>
                                <p class="mb-0 fw-bold text-success">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('pembayaran.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
                
                <div class="payment-form p-4 border rounded-3">
                    <h4 class="mb-3 text-dark"><i class="fas fa-money-bill-wave me-2"></i>Form Pembayaran</h4>
                    
                    <div class="mb-4">
                        <label for="dp" class="form-label fw-bold">Uang Muka (DP)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-dark">Rp</span>
                            <input type="number" class="form-control py-3" id="dp" name="dp" 
                                   min="{{ $pemesanan->total_harga * 0.3 }}" 
                                   max="{{ $pemesanan->total_harga }}" 
                                   value="{{ $pemesanan->total_harga * 0.3 }}" 
                                   required>
                        </div>
                        <div class="form-text">
                            <span class="text-muted">Minimal DP: Rp {{ number_format($pemesanan->total_harga * 0.3, 0, ',', '.') }} (30%)</span>
                            <span class="float-end" id="remaining-amount">Sisa: Rp {{ number_format($pemesanan->total_harga * 0.7, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-light btn-lg py-3">
                            <i class="fas fa-check-circle me-2"></i>Konfirmasi Pembayaran
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
    .booking-summary {
        background-color: #f8f9fa;
        border-left: 4px solid #4e73df;
    }
    .payment-form {
        background-color: #fff;
        border-left: 4px solid #1cc88a;
    }
    .form-control, .form-select {
        border-radius: 10px;
    }
    .btn-light {
        background-color: #fbab00;
        border: none;
        border-radius: 10px;
        transition: all 0.3s;
    }
    .btn-light:hover {
        background-color: #ff4800;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
    }
</style>

<script>
    // Calculate remaining amount
    document.addEventListener('DOMContentLoaded', function() {
        const dpInput = document.getElementById('dp');
        const totalAmount = {{ $pemesanan->total_harga }};
        const remainingAmountElement = document.getElementById('remaining-amount');
        
        dpInput.addEventListener('input', function() {
            const dpValue = parseFloat(this.value) || 0;
            const remaining = totalAmount - dpValue;
            remainingAmountElement.textContent = `Sisa: Rp ${remaining.toLocaleString('id-ID')}`;
        });
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