<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'member_id',
        'paket_id',
        'tanggal_transaksi',
        'total_bayar',
        'metode_pembayaran',
        'order_id',
        'status',
        'promo_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function promo()
{
    return $this->belongsTo(Promo::class);
}

}

