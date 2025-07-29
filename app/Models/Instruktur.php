<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    protected $fillable = ['nama',
     'spesialisasi',
      'no_hp'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
