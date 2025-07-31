<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Promo;
use App\Models\Lapangan;
use App\Models\Pemesanan;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaketHampirHabisMail;

class MemberController extends Controller
{
    public function index(Request $request)
    {
      
    }


 
  public function dashboardMember(Request $request)
  {
      $tanggal = $request->input('tanggal', date('Y-m-d'));
      $lapanganId = $request->input('lapangan_id');
      
      // Ambil semua lapangan
      $lapangans = Lapangan::when($lapanganId, function($query) use ($lapanganId) {
              return $query->where('id', $lapanganId);
          })
          ->get();
      
      // Ambil semua pemesanan untuk tanggal tersebut
      $allBookings = Pemesanan::whereDate('tanggal', $tanggal)
          ->when($lapanganId, function($query) use ($lapanganId) {
              return $query->where('lapangan_id', $lapanganId);
          })
          ->orderBy('jam_mulai')
          ->with('user') // Eager load user data
          ->get();
      
      // Generate time slots (08:00 - 22:00)
      $allSlots = [];
      foreach (range(8, 22) as $hour) {
          $allSlots[] = sprintf('%02d:00', $hour);
      }
      
      return view('pelanggan.availability', [
          'lapangans' => $lapangans,
          'tanggal' => $tanggal,
          'allSlots' => $allSlots,
          'allBookings' => $allBookings
      ]);
  }
    public function show($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('lapangan.show', compact('lapangan'));
    }





    
}


