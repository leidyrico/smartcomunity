<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        // Buscar el usuario por el campo 'user' (que contiene el email)
        $user = User::where('user', $request->email)
                   ->where('status', 'A') // Solo usuarios activos
                   ->first();

        // Verificar si el usuario existe y la contraseña coincide
        if ($user && $user->password === $request->password) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', '¡Bienvenido! Has iniciado sesión correctamente.');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Has cerrado sesión correctamente.');
    }

    /**
     * Mostrar el dashboard (página después del login)
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        return view('dashboard', compact('user'));
    }
}