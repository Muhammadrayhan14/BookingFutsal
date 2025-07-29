<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Lapangan;

use App\Models\User;

use Carbon\Carbon;

use App\Http\Requests\StoreJadwalRequest;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index()
    {
   
            
        // Total transaksi (dalam 30 hari terakhir)
    $totalTransaksi = Pemesanan::where('created_at', '>=', Carbon::now()->subDays(30))
    ->sum('total_harga');

// Total pelanggan
$totalPelanggan = User::where('role', 'pelanggan')->count();

// Transaksi bulan ini
$transaksiBulanIni = Pemesanan::whereMonth('created_at', Carbon::now()->month)
    ->sum('total_harga');

// Data untuk chart transaksi 12 bulan terakhir
$chartData = $this->getChartData();

// 5 transaksi terbaru
$transaksiTerbaru = Pemesanan::with('user')
    ->orderBy('created_at', 'desc')
    ->take(5)
    ->get();

return view('admin.dashboard', compact(
    'totalTransaksi',
    'totalPelanggan',
    'transaksiBulanIni',
    'chartData',
    'transaksiTerbaru'
));
    }


    public function dashboardpengelola()
{
   
    $totalTransaksi = Pemesanan::where('created_at', '>=', Carbon::now()->subDays(30))
        ->sum('total_harga');
    
        $totalPelanggan = User::where('role', 'pelanggan')->count();
    
    // Transaksi bulan ini
    $transaksiBulanIni = Pemesanan::whereMonth('created_at', Carbon::now()->month)
        ->sum('total_harga');
    
    // Data untuk chart transaksi 12 bulan terakhir
    $chartData = $this->getChartData();
    
    // 5 transaksi terbaru
    $transaksiTerbaru = Pemesanan::with('user')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalTransaksi',
        'totalPelanggan',
        'transaksiBulanIni',
        'chartData',
        'transaksiTerbaru'
    ));
}

private function getChartData()
{
    $data = [];
    $months = [];
    
    for ($i = 11; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);
        $monthYear = $date->format('M Y');
        
        $total = Pemesanan::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->sum('total_harga');
        
        // If no data, use random for testing
        $data[] = $total > 0 ? $total : rand(100000, 1000000);
        $months[] = $monthYear;
    }
    
    return [
        'labels' => $months,
        'data' => $data,
    ];
}
   
     

       
}
;