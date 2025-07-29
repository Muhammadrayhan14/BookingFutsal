<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama_paket',
        'durasi_hari',
        'harga',
        'deskripsi'
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
