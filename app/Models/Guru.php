<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'keahlian'];

    // Relasi Guru memiliki banyak Siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class); // Guru memiliki banyak Siswa
    }
}
