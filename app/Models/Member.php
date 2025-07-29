<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'no_hp',
        'alamat',
        'status',
        'tanggal_daftar',
        'tanggal_berakhir',
        'paket_id',
        'order_id',
        'status',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'tanggal_berakhir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
    
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_member')
       
            ->withTimestamps();
    }
    public function absensi()
    {
        return $this->hasMany(KelasMember::class, 'member_id');
    }
}
