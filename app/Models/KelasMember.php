<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasMember extends Model
{
    protected $table = 'kelas_member';
    protected $fillable = ['kelas_id', 'member_id', 'jadwal_id', 'status', 'waktu_absen'];  
    
    protected $dates = ['waktu_absen'];
    protected $casts = [
        'waktu_absen' => 'datetime',
    ];

// app/Models/KelasMember.php
public function jadwal()
{
    return $this->belongsTo(JadwalKelas::class, 'jadwal_id');
}

public function member()
{
    return $this->belongsTo(User::class, 'member_id'); // Sesuaikan dengan model member Anda
}
}
