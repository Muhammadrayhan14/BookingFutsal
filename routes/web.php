<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PromoController;

use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;


use Illuminate\Support\Facades\Mail;
use App\Mail\PaketHampirHabisMail;



use App\Http\Controllers\JadwalKelasController;
use App\Http\Controllers\AbsensiKelasController;


// ===========================
// Route Otentikasi
// ===========================
Auth::routes(); // /login, /logout, /register, dll.

// ===========================
// Halaman Frontend (Publik)
// ===========================
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/kelas-publik', [FrontendController::class, 'kelas'])->name('kelas');
Route::get('/paket-publik', [FrontendController::class, 'paket'])->name('paket');
Route::get('/instruktur', [FrontendController::class, 'instruktur'])->name('instruktur');
Route::get('/fasilitas', [FrontendController::class, 'fasilitas'])->name('fasilitas');



// ===========================
// Halaman Backend (Setelah Login)



// ===========================
Route::middleware(['auth'])->group(function () {

    // -----------------------
    // Dashboard Admin
    // -----------------------
    Route::middleware('role:admin')->group(function () {
       
        
        Route::get('/admin/pembayaran/faktur-pelunasan/{id}', [PembayaranController::class, 'generatePelunasanInvoice'])
        ->name('admin.pembayaran.faktur-pelunasan');

        Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::get('/riwayat-transaksi-admin', [PembayaranController::class, 'riwayatAdmin'])
         ->name('admin.pembayaran.riwayat');
         
        Route::post('/pembayaran/update-status/{id}', [PembayaranController::class, 'updateStatus'])
         ->name('admin.pembayaran.update-status');

         Route::get('/pembayaran/invoice/{id}', [PembayaranController::class, 'generateInvoice'])->name('pembayaran.invoice');

        Route::get('/lapangan-admin', [LapanganController::class, 'index'])->name('lapangan.index');
        Route::get('/lapangan-admin/create', [LapanganController::class, 'create'])->name('lapangan.create');
        Route::post('/lapangan-admin', [LapanganController::class, 'store'])->name('lapangan.store');
        Route::get('/lapangan-admin/{id}', [LapanganController::class, 'show'])->name('lapangan.show');
        Route::get('/lapangan-admin/{id}/edit', [LapanganController::class, 'edit'])->name('lapangan.edit');
        Route::put('/lapangan-admin/{id}', [LapanganController::class, 'update'])->name('lapangan.update');
        Route::delete('/lapangan-admin/{id}', [LapanganController::class, 'destroy'])->name('lapangan.destroy');
            

        //laporan
        Route::get('/user', [LaporanController::class, 'laporanUser'])->name('laporan.user');
        Route::get('/user/pdf', [LaporanController::class, 'laporanUserPDF'])->name('laporan.user.pdf');
        Route::get('/lapangan', [LaporanController::class, 'laporanLapangan'])->name('laporan.lapangan');
        Route::get('/lapangan/pdf', [LaporanController::class, 'laporanLapanganPDF'])->name('laporan.lapangan.pdf');
        Route::get('/pemesanan', [LaporanController::class, 'laporanPemesanan'])->name('laporan.pemesanan');
        Route::get('/pemesanan/pdf', [LaporanController::class, 'laporanPemesananPDF'])->name('laporan.pemesanan.pdf');
        Route::get('/pemesanan/perbulan', [LaporanController::class, 'laporanPemesananPerbulan'])->name('laporan.pemesanan.perbulan');
        Route::get('/pemesanan/perbulan/pdf', [LaporanController::class, 'laporanPemesananPerbulanPDF'])->name('laporan.pemesanan.perbulan.pdf');
        Route::get('/pemesanan/pertahun', [LaporanController::class, 'laporanPemesananPertahun'])->name('laporan.pemesanan.pertahun');
        Route::get('/pemesanan/pertahun/pdf', [LaporanController::class, 'laporanPemesananPertahunPDF'])->name('laporan.pemesanan.pertahun.pdf');
        Route::get('/pembayaran', [LaporanController::class, 'laporanPembayaran'])->name('laporan.pembayaran');
        Route::get('/pembayaran/pdf', [LaporanController::class, 'exportPembayaranPDF'])->name('laporan.pembayaran.pdf');
        Route::get('/pembayaran/perbulan', [LaporanController::class, 'laporanPembayaranPerbulan'])->name('laporan.pembayaran.perbulan');
        Route::get('/pembayaran/perbulan/pdf', [LaporanController::class, 'exportPembayaranPerbulanPDF'])->name('laporan.pembayaran.perbulan.pdf');
        Route::get('/pembayaran/pertahun', [LaporanController::class, 'laporanPembayaranPertahun'])->name('laporan.pembayaran.pertahun');
        Route::get('/pembayaran/pertahun/pdf', [LaporanController::class, 'exportPembayaranPertahunPDF'])->name('laporan.pembayaran.pertahun.pdf');
   
   
   
    });











    // -----------------------
    // Pelanggan (Member) Routes
    // -----------------------
    Route::middleware('role:pelanggan')->group(function () {
        Route::get('/member-dashboard', [MemberController::class, 'dashboardMember'])->name('member.dashboard');
    
        
    
        // Pemesanan Routes
        Route::get('/pemesanan/create/{lapangan_id}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    
    Route::get('/pembayaran/create/{pemesanan_id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])
    ->name('pembayaran.show');

    Route::get('/pembayaran/invoice/{id}', [PembayaranController::class, 'generateInvoice'])
     ->name('pembayaran.invoice');

     Route::get('/riwayat-transaksi', [PembayaranController::class, 'riwayat'])
     ->name('pembayaran.riwayat')
     ->middleware('auth');
    });



    Route::middleware('role:pengelola,admin')->group(function () {
        Route::get('/pengelola-dashboard', [adminController::class, 'dashboardpengelola'])->name('pengelola.dashboard');
    
        //laporan
        Route::get('/user', [LaporanController::class, 'laporanUser'])->name('laporan.user');
        Route::get('/user/pdf', [LaporanController::class, 'laporanUserPDF'])->name('laporan.user.pdf');
        Route::get('/lapangan', [LaporanController::class, 'laporanLapangan'])->name('laporan.lapangan');
        Route::get('/lapangan/pdf', [LaporanController::class, 'laporanLapanganPDF'])->name('laporan.lapangan.pdf');
        Route::get('/pemesanan', [LaporanController::class, 'laporanPemesanan'])->name('laporan.pemesanan');
        Route::get('/pemesanan/pdf', [LaporanController::class, 'laporanPemesananPDF'])->name('laporan.pemesanan.pdf');
        Route::get('/pemesanan/perbulan', [LaporanController::class, 'laporanPemesananPerbulan'])->name('laporan.pemesanan.perbulan');
        Route::get('/pemesanan/perbulan/pdf', [LaporanController::class, 'laporanPemesananPerbulanPDF'])->name('laporan.pemesanan.perbulan.pdf');
        Route::get('/pemesanan/pertahun', [LaporanController::class, 'laporanPemesananPertahun'])->name('laporan.pemesanan.pertahun');
        Route::get('/pemesanan/pertahun/pdf', [LaporanController::class, 'laporanPemesananPertahunPDF'])->name('laporan.pemesanan.pertahun.pdf');
        Route::get('/pembayaran', [LaporanController::class, 'laporanPembayaran'])->name('laporan.pembayaran');
        Route::get('/pembayaran/pdf', [LaporanController::class, 'exportPembayaranPDF'])->name('laporan.pembayaran.pdf');
        Route::get('/pembayaran/perbulan', [LaporanController::class, 'laporanPembayaranPerbulan'])->name('laporan.pembayaran.perbulan');
        Route::get('/pembayaran/perbulan/pdf', [LaporanController::class, 'exportPembayaranPerbulanPDF'])->name('laporan.pembayaran.perbulan.pdf');
        Route::get('/pembayaran/pertahun', [LaporanController::class, 'laporanPembayaranPertahun'])->name('laporan.pembayaran.pertahun');
        Route::get('/pembayaran/pertahun/pdf', [LaporanController::class, 'exportPembayaranPertahunPDF'])->name('laporan.pembayaran.pertahun.pdf'); 
    
       
    });


    
});
