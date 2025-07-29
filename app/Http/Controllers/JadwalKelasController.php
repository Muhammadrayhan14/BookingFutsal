<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKelas;
use App\Models\KelasMember;

class JadwalKelasController extends Controller
{
    public function tambahJadwal(Request $request, $kelasId)
{
    $request->validate([
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai'
    ]);

    JadwalKelas::create([
        'kelas_id' => $kelasId,
        'hari' => $request->hari,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai
    ]);

    return back()->with('success', 'Jadwal berhasil ditambahkan');
}

public function absenKehadiran(Request $request, $jadwalId, $memberId)
{
    $request->validate([
        'status' => 'required|in:hadir,tidak_hadir'
    ]);

    KelasMember::updateOrCreate(
        ['jadwal_id' => $jadwalId, 'member_id' => $memberId],
        ['status' => $request->status]
    );

    return back()->with('success', 'Status kehadiran diperbarui');
}
}
