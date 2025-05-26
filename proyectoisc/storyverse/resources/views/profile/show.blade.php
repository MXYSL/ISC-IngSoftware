<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection

@section('content')
<div class="app-container14">
    <!-- Botón de menú hamburguesa para móvil -->
    <button class="menu-toggle14" id="menuToggle14">
        <i class="fa-duotone fa-solid fa-ellipsis"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar14" id="sidebar14">
        <div class="logo14">
            <i class="fa-brands fa-audible"></i><span>StoryVerse</span>
        </div>
        <a href="{{ route('dashboard') }}" class="menu-item14"><i class="fas fa-house-user"></i> Inicio</a>
        <a href="#" class="menu-item14 active14"><i class="fas fa-user"></i> Perfil</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="#" onclick="this.closest('form').submit()" class="menu-item14">
                <i class="fa-solid fa-right-to-bracket"></i> Cerrar Sesión
            </a>
        </form>
    </div>

    <!-- Contenido principal -->
    <div class="main-content14">
        <div class="header14">
            <div class="header-actions14">
                <button class="theme-toggle14" id="themeToggle14">
                    <i id="sunIcon14" class="fa-regular fa-sun" style="display: {{ auth()->user()->tema === 'oscuro' ? 'block' : 'none' }};"></i>
                    <i id="moonIcon14" class="fa-regular fa-moon" style="display: {{ auth()->user()->tema === 'oscuro' ? 'none' : 'block' }};"></i>
                </button>
                <img id="icono" class="user-avatar14" src="{{ asset('img/icono.png') }}" alt="StoryVerse">
            </div>
        </div>

        <div class="profile-container14">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="profile-sidebar14">
                <img class="profile-image14" src="{{ auth()->user()->imagen_url }}" alt="Profile Image">
                <h3 class="profile-name14">{{ auth()->user()->username }}</h3>
                <p class="profile-title14">{{ auth()->user()->role->name ?? 'Usuario' }}</p>
                
                <div class="profile-stats14">
                    <div class="stat-item14">
                        <span class="stat-value14">254</span>
                        <span class="stat-label14">Followers</span>
                    </div>
                    <div class="stat-item14">
                        <span class="stat-value14">54</span>
                        <span class="stat-label14">Following</span>
                    </div>
                </div>
                
                <!-- Formulario para cambiar imagen -->
                <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="file-input-container">
                        <input type="file" name="imagen" accept="image/*" id="file-input" class="file-input" onchange="this.form.submit()">
                        <button type="button" class="btn-primary" onclick="document.getElementById('file-input').click()">Cambiar foto</button>
                    </div>
                </form>
                
                <!-- Formulario para eliminar imagen -->
                @if(auth()->user()->imagen)
                    <form action="{{ route('profile.image.delete') }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        @method('DELETE')
                        <!--<button type="submit" class="btn-danger">Eliminar foto</button> -->
                    </form>
                @endif
            </div>

            <div class="profile-main14"> 
                <!-- Formulario para actualizar perfil -->
                <form action="{{ route('profile.update', ['user' => auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group14">
                        <label class="form-label14">Usuario</label>
                        <input type="text" class="form-input14" name="username" value="{{ auth()->user()->username }}" required>
                    </div>

                    <div class="form-group14">
                        <label class="form-label14">Email</label>
                        <input type="email" class="form-input14" name="email" value="{{ auth()->user()->email }}" required>
                    </div>

                    <div class="form-group14">
                        <label class="form-label14">Contraseña</label>
                        <div class="password-container" style="position: relative;">
                            <input type="password" id="password" class="form-input14" name="password" placeholder="Dejar en blanco para no cambiar" style="padding-right: 40px;">
                            <i id="toggle-icon" class="fa-regular fa-eye" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #555;"></i>
                        </div>
                    </div> 
                    <button type="submit" class="upgrade-btn14">Guardar Cambios</button>
                </form>
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
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

    // Toggle menu para móvil
    document.getElementById('menuToggle14').addEventListener('click', function() {
        document.getElementById('sidebar14').classList.toggle('active14');
    });

    // Cambio de tema claro/oscuro
    document.getElementById('themeToggle14').addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const moonIcon = document.getElementById('moonIcon14');
        const sunIcon = document.getElementById('sunIcon14');
        const themeicono = document.getElementById("icono");
        
        const newTheme = currentTheme === 'dark' ? 'claro' : 'oscuro';
        
        fetch("{{ route('theme.update') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ tema: newTheme })
        });
        
        if (currentTheme === 'dark') {
            document.documentElement.removeAttribute('data-theme');
            moonIcon.style.display = 'block';
            sunIcon.style.display = 'none';
            themeicono.src = "{{ asset('img/icono.png') }}";
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            moonIcon.style.display = 'none';
            sunIcon.style.display = 'block';
            themeicono.src = "{{ asset('img/iconoc.png') }}";
        }
    });

    // Ocultar mensajes de alerta después de 3 segundos
    const alertElements = document.querySelectorAll('.alert');
    if (alertElements.length > 0) {
        setTimeout(function() {
            alertElements.forEach(alert => {
                alert.style.display = 'none';
            });
        }, 3000);
    }

    function setTheme(theme) {
        document.body.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        $('#themeIcon10').attr('src', theme === 'dark' ? '/img/oscuro.png' : '/img/claro.png');
    }
    let savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);
    $('#themeToggle10').on('click', function() {
        let current = document.body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        setTheme(current);
    });
</script>
@endsection