<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';

    protected $fillable = [
        'id',
        'nama_lapangan',
        'gambar',
        'keterangan',
        'harga',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
