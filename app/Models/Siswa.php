<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['guru_id', 'nama', 'kelas'];

    // Relasi Siswa belongsTo Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class); // Siswa berhubungan dengan satu Guru
    }
}



