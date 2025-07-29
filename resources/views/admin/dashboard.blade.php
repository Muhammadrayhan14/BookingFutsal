@extends('layouts.backend.main')

@section('konten')
<div class="container-fluid">
    <!-- Page Heading with Futsal Theme -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-futbol mr-2 text-orange"></i> Dashboard Futsal
        </h1>
        <div class="bg-orange p-2 rounded">
            <span class="text-white"><i class="fas fa-calendar-day mr-1"></i> {{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Content Row with Orange Theme -->
    <div class="row">
        <!-- Total Transaksi Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-orange shadow h-100 py-2" style="border-left: 4px solid #fd7e14!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">
                                <i class="fas fa-receipt mr-1"></i> Total Transaksi (30 Hari)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-orange-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pelanggan Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #ffc107!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <i class="fas fa-users mr-1"></i> Total Pelanggan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPelanggan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-warning-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Bulan Ini Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2" style="border-left: 4px solid #dc3545!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                <i class="fas fa-calendar mr-1"></i> Transaksi Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($transaksiBulanIni, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-futbol fa-2x text-danger-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row with Futsal Theme -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: linear-gradient(90deg, #fd7e14 0%, #ffc107 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-line mr-1"></i> Grafik Booking 12 Bulan Terakhir
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="transactionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: linear-gradient(90deg, #fd7e14 0%, #ffc107 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-history mr-1"></i> Booking Terbaru
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="bg-orange text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiTerbaru as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->user->name }}</td>
                                    <td class="font-weight-bold text-orange">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    
    .text-orange {
        color: #fd7e14 !important;
    }
    .bg-orange {
        background-color: #fd7e14 !important;
    }
    .border-left-orange {
        border-left-color: #fd7e14 !important;
    }
    .text-orange-300 {
        color: rgba(253, 126, 20, 0.3) !important;
    }
    .text-warning-300 {
        color: rgba(255, 193, 7, 0.3) !important;
    }
    .text-danger-300 {
        color: rgba(220, 53, 69, 0.3) !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format data for Chart.js
        var chartData = {
            labels: @json($chartData['labels']),
            datasets: [{
                label: "Total Booking",
                data: @json($chartData['data']),
                fill: true,
                backgroundColor: "rgba(253, 126, 20, 0.1)",
                borderColor: "rgba(253, 126, 20, 1)",
                borderWidth: 2,
                tension: 0.1,
                pointBackgroundColor: "rgba(253, 126, 20, 1)",
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        };

        // Create chart
        var ctx = document.getElementById("transactionChart");
        if (ctx) {
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            },
                            grid: {
                                color: "rgba(253, 126, 20, 0.1)"
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection