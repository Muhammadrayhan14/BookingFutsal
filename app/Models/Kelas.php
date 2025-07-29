<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['nama_kelas', 'hari', 'jam', 'deskripsi', 'instruktur_id'];

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }

  

    public function jadwals()
    {
        return $this->hasMany(JadwalKelas::class, 'kelas_id');
    }
    
    public function members() {
        return $this->belongsToMany(Member::class, 'kelas_member')
                    ->withPivot(['jadwal_id', 'status','waktu_absen','kelas_id','member_id']);
    }

   
}
