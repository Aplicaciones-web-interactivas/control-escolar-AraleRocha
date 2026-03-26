<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function showHome()
    {
        return view('admin.home');
    }


    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->clave_institucional = $request->clave_institucional;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        return redirect('/admin/home');
    }

    public function login(Request $request)
    {
        $credentials = [
            'clave_institucional' => $request->clave_institucional,
            'password' => $request->password,
            'is_active' => true, 
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect('/admin/home');
        }

        return back()->with('error', 'Clave o contraseña incorrecta o usuario inactivo.')->onlyInput('clave_institucional');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', 'Sesión cerrada');
    }
}