<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function create($lapangan_id)
    {
        $lapangan = Lapangan::findOrFail($lapangan_id);
        return view('pemesanan.create', compact('lapangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'lama' => 'required|integer|min:1',
          
        ]);
    
        // Hitung jam selesai
        $jamMulai = $request->jam_mulai;
        $jamSelesai = date('H:i', strtotime("+{$request->lama} hours", strtotime($jamMulai)));
    
        // Cek apakah ada pemesanan yang bertabrakan
        $existingBookings = Pemesanan::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->get();
    
        foreach ($existingBookings as $booking) {
            $existingStart = $booking->jam_mulai;
            $existingEnd = date('H:i', strtotime("+{$booking->lama} hours", strtotime($existingStart)));
    
            // Cek tabrakan waktu yang diperbaiki
            if (
                ($jamMulai >= $existingStart && $jamMulai < $existingEnd) ||  // Mulai baru di antara booking yang ada
                ($jamSelesai > $existingStart && $jamSelesai <= $existingEnd) || // Selesai baru di antara booking yang ada
                ($jamMulai <= $existingStart && $jamSelesai >= $existingEnd)    // Booking baru mencakup booking yang ada
            ) {
                return back()
                    ->withErrors(['jam_mulai' => 'Lapangan sudah dipesan pada jam tersebut ('.$existingStart.' - '.$existingEnd.')'])
                    ->withInput();
            }
            
            // Cek jika booking baru dimulai tepat setelah booking yang ada selesai (diperbolehkan)
            if ($jamMulai == $existingEnd) {
                // Diperbolehkan karena tepat setelah booking sebelumnya selesai
                continue;
            }
        }
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
     
    
 
        $pemesanan = Pemesanan::create([
            'user_id' => auth()->id(),
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'lama' => $request->lama,
            'harga' => $lapangan->harga,
            'total_harga' => $lapangan->harga * $request->lama,
            'status' => 'belum selesai',
        ]);
    
        return redirect()->route('pembayaran.create', $pemesanan->id);
    }
}