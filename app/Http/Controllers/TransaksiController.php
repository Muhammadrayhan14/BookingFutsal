<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Carbon;

class TransaksiController extends Controller
{
    public function handleSuccess($orderId)
    {
        // Ambil data transaksi
        $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();
        
        // Update status transaksi
        $transaksi->update([
            'status' => 'success',
            'tanggal_pembayaran' => now()
        ]);
        
        // Berikan benefit ke member
        $member = $transaksi->member;
        // ... logika untuk memberikan benefit paket
        
        return view('member.pembayaran-success', compact('transaksi'));
    }
    
    public function handlePending($orderId)
    {
        $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();
        $transaksi->update(['status' => 'pending']);
        
        return view('member.pembayaran-pending', compact('transaksi'));
    }
    
    public function handleError($orderId)
    {
        $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();
        $transaksi->update(['status' => 'failed']);
        
        return view('member.pembayaran-error', compact('transaksi'));
    }
    
    public function checkStatus($orderId)
    {
        // Gunakan API Midtrans untuk cek status terbaru
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        
        try {
            $status = \Midtrans\Transaction::status($orderId);
            
            $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();
            $transaksi->update([
                'status' => strtolower($status->transaction_status),
                'tanggal_pembayaran' => in_array($status->transaction_status, ['capture', 'settlement']) ? now() : null
            ]);
            
            return redirect()->route('pembayaran.'.$transaksi->status, ['order_id' => $orderId]);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memeriksa status pembayaran');
        }
    }
}
