<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirect based on user role
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return '/admin-dashboard';
        } elseif ($role === 'pelanggan') {
            return '/member-dashboard';
        }elseif ($role === 'pengelola') {
            return '/pengelola-dashboard';
        }

        return '/'; 
    }
}
