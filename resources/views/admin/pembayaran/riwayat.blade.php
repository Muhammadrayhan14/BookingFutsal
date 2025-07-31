@extends('layouts.backend.main')

@section('konten')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg overflow-hidden">
        <!-- Card Header with Gradient Background -->
        <div class="card-header bg-gradient-primary text-white position-relative">
            <div class="position-absolute top-0 end-0 bg-white opacity-10" style="width: 150px; height: 150px; border-radius: 50%; transform: translate(50px, -50px);"></div>
            <div class="d-flex justify-content-between align-items-center position-relative">
                <div>
                    <h2 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i>Riwayat Transaksi Admin</h2>
                    <p class="mb-0 opacity-75 text-dark">Kelola semua transaksi pelanggan</p>
                </div>
                <div class="bg-white text-dark p-2 rounded-circle">
                    <i class="fas fa-user-cog fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive p-4">
                <table id="transaksiTable" class="table table-hover align-middle mb-0 w-100">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Lapangan</th>
                            <th>Waktu Booking</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">DP</th>
                            <th class="text-end">Sisa</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $index => $pembayaran)
                        <tr class="border-bottom">
                            <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-user text-dark"></i>
                                    </div>
                                    <span class="fw-bold">{{ $pembayaran->pemesanan->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">{{ $pembayaran->created_at->format('d M') }}</span>
                                    <small class="text-muted">{{ $pembayaran->created_at->format('Y') }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                        <i class="fas fa-map-marker-alt text-dark"></i>
                                    </div>
                                    <span class="fw-bold">{{ $pembayaran->pemesanan->lapangan->nama_lapangan }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">{{ date('d M', strtotime($pembayaran->pemesanan->tanggal)) }}</span>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $pembayaran->pemesanan->jam_mulai)->format('H.i') }} - {{ date('H:i', strtotime($pembayaran->pemesanan->jam_mulai) + ($pembayaran->pemesanan->lama * 3600)) }}
                                    </small>
                                </div>
                            </td>
                            <td class="text-end fw-bold">Rp{{ number_format($pembayaran->pemesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="text-end text-primary fw-bold">Rp{{ number_format($pembayaran->dp, 0, ',', '.') }}</td>
                            <td class="text-end text-danger fw-bold">Rp{{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('admin.pembayaran.update-status', $pembayaran->pemesanan->id) }}" method="POST" data-pembayaran-id="{{ $pembayaran->id }}">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm border-0 shadow-sm" style="min-width: 120px;">
                                        <option value="dp" {{ $pembayaran->pemesanan->status == 'dp' ? 'selected' : '' }}>Dp</option>
                                        <option value="lunas" {{ $pembayaran->pemesanan->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    </select>
                                </form>
                                
                                @if($pembayaran->pemesanan->status == 'lunas')
                                    <a href="{{ route('admin.pembayaran.faktur-pelunasan', $pembayaran->id) }}" 
                                       class="btn btn-sm btn-success mt-2 w-100">
                                       <i class="fas fa-file-invoice"></i> Faktur Pelunasan
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan CSS dan JS DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

<style>
    /* Tambahkan ini untuk mencegah scroll horizontal */
    .dataTables_wrapper {
        overflow-x: auto;
        width: 100%;
    }
    
    /* Pastikan tabel tidak melebihi container */
    #transaksiTable {
        width: 100% !important;
        margin: 0 auto;
    }
    
    /* Perbaikan tampilan untuk mobile */
    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        #transaksiTable {
            display: block;
            width: 100%;
        }
        
        .dataTables_scrollHeadInner,
        .dataTables_scrollHeadInner table {
            width: 100% !important;
        }
        
        .dataTables_scrollBody table {
            width: 100% !important;
        }
    }
    
    /* Style tambahan untuk memastikan tidak ada overflow */
    .container-fluid {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        overflow-x: hidden;
    }
    
    .card {
        overflow: hidden;
    }
</style>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#transaksiTable').DataTable({
            dom: '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-info btn-sm'
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-columns"></i> Kolom',
                    className: 'btn btn-secondary btn-sm'
                }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            responsive: true,
            scrollX: false,
            autoWidth: false,
            order: [[1, 'asc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
        });

        // Tangkap event perubahan status
        $(document).on('change', 'select[name="status"]', function() {
            var form = $(this).closest('form');
            var row = $(this).closest('tr');
            var totalHarga = parseFloat(row.find('td:nth-child(6)').text().replace('Rp', '').replace(/\./g, ''));
            var dpCell = row.find('td:nth-child(7)');
            var sisaCell = row.find('td:nth-child(8)');
            var status = $(this).val();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    if (status === 'lunas') {
                        // Update tampilan tanpa reload
                        dpCell.text('Rp' + totalHarga.toLocaleString('id-ID'));
                        sisaCell.text('Rp0').removeClass('text-danger').addClass('text-success');
                        
                        // Tambahkan tombol faktur pelunasan
                        form.after('<a href="/admin/pembayaran/faktur-pelunasan/' + 
                            row.find('form').data('pembayaran-id') + 
                            '" class="btn btn-sm btn-success mt-2 w-100"><i class="fas fa-file-invoice"></i> Faktur Pelunasan</a>');
                    }
                    
                    // Tampilkan pesan sukses
                    if (response.success) {
                        alert(response.success);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endsection