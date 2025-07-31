<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lapangan;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan user
     */
    public function laporanUser()
    {
        $users = User::orderBy('name')->get();
        return view('laporan.laporan_user', compact('users'));
    }

    /**
     * Export laporan user ke PDF
     */
    public function laporanUserPDF()
    {
        $users = User::orderBy('name')->get();
        $tanggal = Carbon::now()->format('d/m/Y');
        
        $data = [
            'title' => 'Laporan Data User',
            'tanggal' => $tanggal,
            'users' => $users,
            'footer' => [
                'lokasi' => 'Padang',
                'tanggal' => $tanggal,
                'penandatangan' => 'Pemilik'
            ]
        ];

        $pdf = Pdf::loadView('laporan.laporan_user_pdf', $data)
                 ->setPaper('a4', 'portrait')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);

        return $pdf->download('laporan-data-user-' . now()->format('Ymd') . '.pdf');
    }

    public function laporanLapangan()
    {
        $lapangans = Lapangan::orderBy('nama_lapangan')->get();
        return view('laporan.laporan_lapangan', compact('lapangans'));
    }
    
    public function laporanLapanganPDF()
    {
        $lapangans = Lapangan::orderBy('nama_lapangan')->get();
        $tanggal = Carbon::now()->format('d F Y');
        
        $data = [
            'lapangans' => $lapangans,
            'tanggal' => $tanggal,
            'total_lapangan' => $lapangans->count()
        ];
    
        $pdf = Pdf::loadView('laporan.laporan_lapangan_pdf', $data)
                 ->setPaper('a4', 'portrait')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);
    
        return $pdf->download('laporan-data-lapangan-' . now()->format('Ymd') . '.pdf');
    }


    public function laporanPemesanan(Request $request)
    {
        // Inisialisasi variabel dengan koleksi kosong
        $pemesanans = collect();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Hanya query data jika filter tanggal diisi
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $pemesanans = Pemesanan::with(['user', 'lapangan'])
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam_mulai', 'desc')
                ->get();
        }
            
        return view('laporan.laporan_pemesanan', compact('pemesanans', 'startDate', 'endDate'));
    }

    /**
     * Export laporan pemesanan ke PDF
     */
    public function laporanPemesananPDF(Request $request)
    {
        // Validasi bahwa tanggal harus diisi untuk export PDF
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $pemesanans = Pemesanan::with(['user', 'lapangan'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();
            
        $totalPendapatan = $pemesanans->sum('total_harga');
        
        $data = [
            'pemesanans' => $pemesanans,
            'startDate' => Carbon::parse($startDate)->format('d/m/Y'),
            'endDate' => Carbon::parse($endDate)->format('d/m/Y'),
            'totalPendapatan' => $totalPendapatan,
            'tanggalCetak' => Carbon::now()->format('d F Y')
        ];

        $pdf = Pdf::loadView('laporan.laporan_pemesanan_pdf', $data)
                 ->setPaper('a4', 'landscape')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);

        return $pdf->download('laporan-pemesanan-' . now()->format('Ymd') . '.pdf');
    }



    public function laporanPemesananPerbulan(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m'));
        $pemesanans = collect();
        
        if ($request->filled('bulan')) {
            $startDate = Carbon::parse($bulan)->startOfMonth();
            $endDate = Carbon::parse($bulan)->endOfMonth();
            
            $pemesanans = Pemesanan::with(['user', 'pembayaran'])
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->orderBy('tanggal', 'desc')
                ->orderBy('jam_mulai', 'desc')
                ->get();
        }
            
        return view('laporan.laporan_pemesanan_perbulan', compact('pemesanans', 'bulan'));
    }

    /**
     * Export laporan pemesanan perbulan ke PDF
     */
    public function laporanPemesananPerbulanPDF(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m'
        ]);
        
        $bulan = $request->input('bulan');
        $startDate = Carbon::parse($bulan)->startOfMonth();
        $endDate = Carbon::parse($bulan)->endOfMonth();
        
        $pemesanans = Pemesanan::with(['user', 'pembayaran'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();
            
        $totalPendapatan = $pemesanans->sum('total_harga');
        $totalDP = $pemesanans->sum(function($pemesanan) {
            return $pemesanan->pembayaran ? $pemesanan->pembayaran->jumlah_dp : 0;
        });
        
        $data = [
            'pemesanans' => $pemesanans,
            'bulan' => Carbon::parse($bulan)->format('F Y'),
            'totalPendapatan' => $totalPendapatan,
            'totalDP' => $totalDP,
            'tanggalCetak' => Carbon::now()->format('d F Y')
        ];

        $pdf = Pdf::loadView('laporan.laporan_pemesanan_perbulan_pdf', $data)
                 ->setPaper('a4', 'landscape')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);

        return $pdf->download('laporan-pemesanan-perbulan-' . $bulan . '.pdf');
    }



    public function laporanPemesananPertahun(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $allMonthsData = collect();
        
        if ($request->filled('tahun')) {
            // Ambil data dari database
            $dbData = Pemesanan::select(
                    DB::raw('MONTH(tanggal) as bulan'),
                    DB::raw('COUNT(id) as jumlah_pemesanan'),
                    DB::raw('SUM(total_harga) as total_pendapatan')
                )
                ->whereYear('tanggal', $tahun)
                ->groupBy(DB::raw('MONTH(tanggal)'))
                ->orderBy('bulan')
                ->get()
                ->keyBy('bulan');
            
            // Buat data untuk semua bulan
            $allMonthsData = collect(range(1, 12))->map(function ($month) use ($dbData) {
                return $dbData->has($month) 
                    ? $dbData->get($month) 
                    : (object)[
                        'bulan' => $month,
                        'jumlah_pemesanan' => 0,
                        'total_pendapatan' => 0
                    ];
            });
        }
            
        return view('laporan.laporan_pemesanan_pertahun', compact('allMonthsData', 'tahun'));
    }
    
    public function laporanPemesananPertahunPDF(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4'
        ]);
        
        $tahun = $request->input('tahun');
        
        // Ambil data dari database
        $dbData = Pemesanan::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(id) as jumlah_pemesanan'),
                DB::raw('SUM(total_harga) as total_pendapatan')
            )
            ->whereYear('tanggal', $tahun)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');
        
        // Buat data untuk semua bulan
        $allMonthsData = collect(range(1, 12))->map(function ($month) use ($dbData) {
            return $dbData->has($month) 
                ? $dbData->get($month) 
                : (object)[
                    'bulan' => $month,
                    'jumlah_pemesanan' => 0,
                    'total_pendapatan' => 0
                ];
        });
            
        $totalPendapatan = $allMonthsData->sum('total_pendapatan');
        $totalPemesanan = $allMonthsData->sum('jumlah_pemesanan');
        
        $data = [
            'allMonthsData' => $allMonthsData,
            'tahun' => $tahun,
            'totalPendapatan' => $totalPendapatan,
            'totalPemesanan' => $totalPemesanan,
            'tanggalCetak' => Carbon::now()->format('d F Y')
        ];
    
        $pdf = Pdf::loadView('laporan.laporan_pemesanan_pertahun_pdf', $data)
                 ->setPaper('a4', 'portrait')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);
    
        return $pdf->download('laporan-pemesanan-pertahun-' . $tahun . '.pdf');
    }


    public function laporanPembayaran(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        $pembayarans = collect();
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $pembayarans = Pembayaran::with(['pemesanan.user', 'pemesanan.lapangan'])
                ->whereHas('pemesanan', function($query) use ($startDate, $endDate) {
                    $query->whereBetween('tanggal', [$startDate, $endDate]);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
            
        return view('laporan.laporan_pembayaran', compact('pembayarans', 'startDate', 'endDate'));
    }

    /**
     * Export laporan pembayaran ke PDF
     */
    public function exportPembayaranPDF(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $pembayarans = Pembayaran::with(['pemesanan.user', 'pemesanan.lapangan'])
            ->whereHas('pemesanan', function($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        $totalDP = $pembayarans->sum('dp');
        $totalPendapatan = $pembayarans->sum(function($pembayaran) {
            return $pembayaran->pemesanan->total_harga;
        });
        
        $data = [
            'pembayarans' => $pembayarans,
            'startDate' => Carbon::parse($startDate)->format('d/m/Y'),
            'endDate' => Carbon::parse($endDate)->format('d/m/Y'),
            'totalDP' => $totalDP,
            'totalPendapatan' => $totalPendapatan,
            'tanggalCetak' => Carbon::now()->format('d F Y')
        ];

        $pdf = Pdf::loadView('laporan.laporan_pembayaran_pdf', $data)
                 ->setPaper('a4', 'landscape')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);

        return $pdf->download('laporan-pembayaran-' . now()->format('Ymd') . '.pdf');
    }

    public function laporanPembayaranPerbulan(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $pembayarans = collect();
        
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $pembayarans = Pembayaran::with(['pemesanan.user'])
                ->whereMonth('created_at', (int)$bulan)
                ->whereYear('created_at', (int)$tahun)
                ->orderBy('created_at', 'desc')
                ->get();
        }
            
        return view('laporan.laporan_pembayaran_perbulan', compact('pembayarans', 'bulan', 'tahun'));
    }
    
    public function exportPembayaranPerbulanPDF(Request $request)
    {
        $request->validate([
            'bulan' => 'required|numeric|between:1,12',
            'tahun' => 'required|digits:4'
        ]);
        
        $bulan = (int)$request->input('bulan');
        $tahun = (int)$request->input('tahun');
        
        $pembayarans = Pembayaran::with(['pemesanan.user'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $data = [
            'pembayarans' => $pembayarans,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tanggalCetak' => Carbon::now()->format('d F Y')
        ];
    
        $pdf = Pdf::loadView('laporan.laporan_pembayaran_perbulan_pdf', $data)
                 ->setPaper('a4', 'landscape')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);
    
        return $pdf->download('laporan-pembayaran-'.Carbon::create()->month($bulan)->locale('id')->monthName.'-'.$tahun.'.pdf');
    }
    

    public function laporanPembayaranPertahun(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $allMonthsData = collect();
        
        if ($request->filled('tahun')) {
            // Ambil data dari database
            $dbData = Pembayaran::select(
                    DB::raw('MONTH(pembayaran.created_at) as bulan'),
                    DB::raw('SUM(pemesanan.total_harga) as total')
                )
                ->join('pemesanan', 'pembayaran.pemesanan_id', '=', 'pemesanan.id')
                ->whereYear('pembayaran.created_at', $tahun)
                ->groupBy(DB::raw('MONTH(pembayaran.created_at)'))
                ->orderBy('bulan')
                ->get()
                ->keyBy('bulan');
            
            // Buat data untuk semua bulan
            $allMonthsData = collect(range(1, 12))->map(function ($month) use ($dbData) {
                return $dbData->has($month) 
                    ? $dbData->get($month) 
                    : (object)[
                        'bulan' => $month,
                        'total' => 0
                    ];
            });
        }
            
        return view('laporan.laporan_pembayaran_pertahun', compact('allMonthsData', 'tahun'));
    }
    
    public function exportPembayaranPertahunPDF(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4'
        ]);
        
        $tahun = $request->input('tahun');
        
        // Ambil data dari database
        $dbData = Pembayaran::select(
                DB::raw('MONTH(pembayaran.created_at) as bulan'),
                DB::raw('SUM(pemesanan.total_harga) as total')
            )
            ->join('pemesanan', 'pembayaran.pemesanan_id', '=', 'pemesanan.id')
            ->whereYear('pembayaran.created_at', $tahun)
            ->groupBy(DB::raw('MONTH(pembayaran.created_at)'))
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');
        
        // Buat data untuk semua bulan
        $allMonthsData = collect(range(1, 12))->map(function ($month) use ($dbData) {
            return $dbData->has($month) 
                ? $dbData->get($month) 
                : (object)[
                    'bulan' => $month,
                    'total' => 0
                ];
        });
            
        $data = [
            'allMonthsData' => $allMonthsData,
            'tahun' => $tahun,
            'totalPendapatan' => $allMonthsData->sum('total'),
            'tanggalCetak' => Carbon::now()->format('d F Y')
        ];
    
        $pdf = Pdf::loadView('laporan.laporan_pembayaran_pertahun_pdf', $data)
                 ->setPaper('a4', 'landscape')
                 ->setOptions([
                     'isHtml5ParserEnabled' => true,
                     'isRemoteEnabled' => true,
                     'defaultFont' => 'Arial'
                 ]);
    
        return $pdf->download('laporan-pembayaran-pertahun-'.$tahun.'.pdf');
    }
}