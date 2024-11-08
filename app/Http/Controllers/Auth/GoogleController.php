<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    // Redirige al usuario a Google para autenticación
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Maneja el callback de Google y la autenticación del usuario
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user(); // Si `stateless` no funciona, intenta sin él

            // Buscar o crear el usuario
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => Hash::make(uniqid()), // Contraseña generada aleatoriamente
                ]
            );

            // Autenticar al usuario
            Auth::login($user);

            // Redirigir al dashboard
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Error al iniciar sesión con Google');
        }
    }
}
