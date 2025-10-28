<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    public function redirectLogin(Request $request)
    {
        $request->session()->put('oauth_mode', 'login');
        return Socialite::driver('google')->redirect();
    }

    public function redirectRegister(Request $request)
    {
        $request->session()->put('oauth_mode', 'register');
        return Socialite::driver('google')->redirect();
    }
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->withErrors(['google' => 'Estado inválido, intenta de nuevo.']);
        }

        $mode = $request->session()->pull('oauth_mode', 'login');
        $email = $googleUser->getEmail();
        $googleId = $googleUser->getId();

        $userByProvider = User::where('google_id', $googleId)->first();
        $userByEmail = $email ? User::where('email', $email)->first() : null;

        if ($mode === 'login') {
            if ($userByProvider) {
                Auth::login($userByProvider, true);
                return redirect()->route('dashboard');
            }
            if ($userByEmail) {
                return redirect()->route('register')->with('error', 'Tu correo ya existe pero no está vinculado a Google. Inicia con email y contraseña y vincula tu cuenta.');
            }
            return redirect()->route('register')->with('error', 'No existe una cuenta con este Google. Regístrate primero.');
        }

        // mode === 'register'
        if ($userByEmail) {
            return redirect()->route('login')->with('error', 'Este correo ya está registrado. Inicia sesión.');
        }

        // Crear usuario solo en registro
        $user = User::create([
            'name' => $googleUser->getName() ?? '',
            'email' => $email,
            'google_id' => $googleId,
            'password' => Hash::make(Str::random(32)),
        ]);

        Auth::login($user, true);
        return redirect()->route('dashboard');
    }
}
