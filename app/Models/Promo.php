<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'nama_promo',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'persentase_diskon',
        'status',
    ];

    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
