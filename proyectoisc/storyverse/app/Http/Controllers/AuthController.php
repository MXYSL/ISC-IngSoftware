<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Verificar el rol del usuario autenticado
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect('/dashboard'); // Redirigir al panel de administrador
            } elseif ($user->role_id == 2) {
                return redirect('/dashboard'); // Redirigir al panel de usuario
            }
        }
        
        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2, // Rol predeterminado para usuarios normales
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
    
    // Social Authentication
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'username' => $socialUser->getName(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'role_id' => 2, // Usuario normal por defecto
                ]
            );
            
            Auth::login($user);
            
            // Verificar el rol del usuario autenticado
            if ($user->role_id == 1) {
                return redirect('/admin/index'); // Redirigir al panel de administrador
            } elseif ($user->role_id == 2) {
                return redirect('/dashboard'); // Redirigir al panel de usuario
            }
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Error al autenticar con ' . $provider]);
        }
    }
    
}