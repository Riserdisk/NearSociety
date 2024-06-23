<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

// Controlador de inicio de sesión de vecinos
class NeighborLoginController extends Controller
{
    public function showLoginForm()
    {
        // Vista de inicio de sesión de vecinos
        return view('auth.neighbor-login');
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Intentar autenticar al vecino
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended(route('events.index'));
        }
        // Si la autenticación falla, redirigir al vecino con un mensaje de error
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    // Cerrar sesión del vecino
    public function logout(Request $request)
    {
        // Cerrar sesión del vecino
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al vecino a la página de inicio
        return redirect('/');
    }
}
