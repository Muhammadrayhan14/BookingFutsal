<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\DetailGaleri;
use App\Models\Kelas;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Instruktur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
       $user = Auth::user();
       if($user){
        return redirect()->route('admin.dashboard');
       }
        return view('welcome');
    }
    
    public function kelas()
    {
        $kelas = Kelas::with('instruktur')->get();
        $member = auth()->check() ? auth()->user()->member : null;
    
        return view('kelas', compact('kelas', 'member'));
    }
    

    public function paket()
    {
        $pakets = Paket::orderBy('created_at', 'desc')->get();
        return view('paket', compact('pakets'));
    }


    public function instruktur()
    {
        $instrukturs = Instruktur::orderBy('created_at', 'desc')->get();
        return view('instruktur', compact('instrukturs'));
    }

    public function fasilitas()
    {
        return view('fasilitas');
    }
}
