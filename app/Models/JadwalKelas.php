<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
         protected $fillable = [
            'kelas_id',
             'hari',
              'jam_mulai',
               'jam_selesai',
            'tanggal'];

             
            protected $casts = [
                'tanggal' => 'date',
            ];
                        

            public function kelas()
            {
                return $this->belongsTo(Kelas::class, 'kelas_id')->withDefault([
                    'nama_kelas' => 'Kelas Tidak Ditemukan'
                ]);
            }
            
            public function kelasMembers()
            {
                return $this->hasMany(KelasMember::class, 'jadwal_id');
            }
}
