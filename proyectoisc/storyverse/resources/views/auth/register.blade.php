<!-- resources/views/auth/register.blade.php -->
@extends('layouts.guest')

@section('title', 'Registro')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/acceso.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="left-panel">
        <h1>Crea tu<br>Cuenta</h1>
        <p>Únete a nuestra biblioteca digital, descubre miles de libros y guarda tus lecturas favoritas. ¡Empieza tu viaje literario hoy!</p>
        <div class="social-media">
            <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a> 
            <p>Regresar a menu principal</p>
        </div>
    </div>
    <div class="right-panel">
        <div class="form-container">
            <h2>Registrate aquí</h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                </div>
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <img id="toggle-icon" class="toggle-password" 
                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'%3E%3C/path%3E%3Ccircle cx='12' cy='12' r='3'%3E%3C/circle%3E%3C/svg%3E" 
                             alt="Mostrar Contraseña" onclick="togglePasswordVisibility()">
                    </div>
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Recuerdame el Usuario</label>
                </div>
                <button type="submit" class="submit-btn">Registrarse</button>
            </form>
            <div class="login-link">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Ingresa aquí</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("toggle-icon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24'%3E%3C/path%3E%3Cline x1='1' y1='1' x2='23' y2='23'%3E%3C/line%3E%3C/svg%3E";
        } else {
            passwordField.type = "password";
            toggleIcon.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'%3E%3C/path%3E%3Ccircle cx='12' cy='12' r='3'%3E%3C/circle%3E%3C/svg%3E";
        }
    }
</script>
@endsection