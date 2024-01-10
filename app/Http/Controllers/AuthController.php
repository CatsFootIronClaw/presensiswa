<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function index(){
        return view('login');
    }

    //mengecek apakah sama seperti yang didatabase
    function login(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $credentials = [
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            Session::regenerateToken();
            if ($user->role == 'tatausaha') {
                return redirect('dashboard/tatausaha');
            } elseif ($user->role == 'walikelas') {
                return redirect('dashboard/walikelas');
            } elseif ($user->role == 'gurubk') {
                return redirect('dashboard/gurubk');
            } elseif ($user->role == 'gurupiket') {
                return redirect('dashboard/gurupiket');
            } elseif ($user->role == 'siswa') {
                return redirect('dashboard/siswa');
            } elseif ($user->role == 'pengurus') {
                return redirect('dashboard/pengurus');
            }   
        } else {

            return redirect()->back()->with('error', 'Terdapat Kesalahan Pada Username atau Password');
        }

    }

    function logout(){
        Auth::logout();
        Session::regenerateToken();
        return redirect('/');
    }
}
