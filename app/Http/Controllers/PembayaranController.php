<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\PaymentNotification;
use Illuminate\Support\Facades\Mail;

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

    // Hapus jika tidak perlu
    if ($request->status == 'lunas') {
        $pembayaran = $pemesanan->pembayaran;
        if ($pembayaran) {
            Mail::to($pemesanan->user->email)->send(new PaymentNotification($pembayaran, true));
        }
    }

    return back()->with('success', 'Status pemesanan berhasil diperbarui');
}

public function generatePelunasanInvoice($id)
{
    $pembayaran = Pembayaran::with('pemesanan.lapangan')->findOrFail($id);
    
    // Update sisa bayar menjadi 0 jika status lunas
    if ($pembayaran->pemesanan->status == 'lunas') {
        $pembayaran->update([
            'sisa_bayar' => 0,
            'dp' => $pembayaran->pemesanan->total_harga // DP diupdate ke total harga
        ]);
    }
    
    $data = [
        'pembayaran' => $pembayaran,
        'tanggal' => now()->format('d F Y'),
        'nofaktur' => 'INV-PEL-' . str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT),
        'is_pelunasan' => true
    ];
    
    $pdf = PDF::loadView('admin.pembayaran.faktur-pelunasan', $data);
    return $pdf->download('faktur-pelunasan-' . $pembayaran->id . '.pdf');
}
}