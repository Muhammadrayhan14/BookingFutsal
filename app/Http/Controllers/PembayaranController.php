<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function create($pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        return view('pembayaran.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'dp' => 'required|numeric|min:0',
        ]);
    
        $pemesanan = Pemesanan::find($request->pemesanan_id);
        
        // Hitung sisa pembayaran
        $sisa_bayar = $pemesanan->total_harga - $request->dp;
        
        // Tentukan status berdasarkan pembayaran
        $status_pemesanan = ($sisa_bayar <= 0) ? 'lunas' : 'dp';
        
        $pembayaran = Pembayaran::create([
            'pemesanan_id' => $request->pemesanan_id,
            'dp' => $request->dp,
            'sisa_bayar' => $sisa_bayar,
        ]);
        
        // Update status pemesanan
        $pemesanan->update(['status' => $status_pemesanan]);
    
        return redirect()->route('pembayaran.show', $pembayaran->id)
                        ->with('success', $sisa_bayar <= 0 
                            ? 'Pembayaran lunas berhasil! Terima kasih telah melakukan booking.' 
                            : 'Pembayaran DP berhasil! Silakan lakukan pelunasan sebelum waktu booking.');
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('pemesanan.lapangan')->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function generateInvoice($id)
{
    $pembayaran = Pembayaran::with('pemesanan.lapangan')->findOrFail($id);
    
    $data = [
        'pembayaran' => $pembayaran,
        'tanggal' => now()->format('d F Y'),
        'nofaktur' => 'INV-' . str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT),
    ];
    
    $pdf = PDF::loadView('pembayaran.invoice', $data);
    return $pdf->download('invoice-' . $pembayaran->id . '.pdf');
}

public function riwayat()
{
    // Get all payments for the logged in user through their bookings
    $pembayarans = Pembayaran::with(['pemesanan.lapangan', 'pemesanan.user'])
        ->whereHas('pemesanan', function($query) {
            $query->where('user_id', auth()->id());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pembayaran.riwayat', compact('pembayarans'));
}

public function riwayatAdmin()
{
    $pembayarans = Pembayaran::with(['pemesanan.lapangan', 'pemesanan.user'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.pembayaran.riwayat', compact('pembayarans'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:lunas,DP,batal'
    ]);

    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->update(['status' => $request->status]);

    return back()->with('success', 'Status pemesanan berhasil diperbarui');
}
}