<div class="book-bg"></div>
<div class="header">
    <h1>StoryVerse - Panel de Usuarios</h1>
    <div>
        <button class="theme-toggle" onclick="toggleTheme()">🌙/☀️</button>
        <a href="{{ route('dashboard') }}"><button class="back-btn">Menú principal</button></a>
    </div>
</div>

<div class="alert alert-success">
    ¡Bienvenido/a a tu panel de perfil!
</div>

<!-- Botones principales -->
<div class="mb-3">
    <button onclick="showSection('search')">Consultar usuario</button>
    <button onclick="showSection('create')">Agregar usuario</button>
    <button onclick="showSection('list')">Consultar lista completa de usuarios</button>
</div>

<!-- Sección: Buscar usuario (modal/dialogo) -->
<div id="section-search" style="display:none;">
    <div id="search-modal" style="border-radius: 8px; box-shadow: 0 2px 8px #0002; padding: 2em; max-width: 400px; margin: 2em auto;">
        <h3>Buscar usuario</h3>
        <form id="searchUserForm" onsubmit="return searchUser(event)">
            <input type="text" id="searchName" name="name" placeholder="Nombre de usuario" required>
            <button type="submit">Buscar</button>
            <button type="button" onclick="closeSearch()">Cerrar</button>
        </form>
        <div id="searchResult"></div>
    </div>
</div>

<!-- Sección: Crear usuario -->
<div id="section-create" style="display:none;">
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
        <input type="file" name="profile_photo">
        <select name="role_id" required>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
        <button type="submit">Crear</button>
    </form>
</div>

<!-- Sección: Lista completa de usuarios -->
<div id="section-list" style="display:none;">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f0f0f0;">
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? '' }}</td>
                <td>
                    <button onclick="viewUser({{ $user->id }})">Visualizar</button>
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('profile.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para visualizar/editar usuario -->
<div id="view-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:#0005; z-index:1000;">
    <div id="view-modal-content" style="border-radius:8px; box-shadow:0 2px 8px #0002; padding:2em; max-width:400px; margin:5vh auto;">
        <!-- Aquí se carga el formulario de edición por AJAX -->
    </div>
</div>

<style>
:root {
    --primary:rgb(183, 169, 108);/*barra de navegacion*/
    --secondary:rgb(209, 196, 151);/*color del cuadro de bievenido*/
    --accent:rgb(0, 0, 0);/*letras y botones claro/oscuro*/
    --text:rgb(0, 0, 0); /*texto titulos de formularios*/
    --bg: rgb(145, 130, 93); /*color de fondo*/
    --card:rgba(255, 255, 255, 0); /*fondo de formularios*/
    --shadow: 0 4px 24pxrgba(237, 206, 133, 0.33); /*sombra de formularios*/
}
[data-theme="dark"] {
    --primary:rgb(64, 31, 114);
    --secondary:rgb(140, 71, 213);
    --accent:rgb(255, 255, 255);
    --text: #fff;
    --bg:rgb(44, 38, 50);
    --card:rgba(36, 24, 43, 0.06);
    --shadow: 0 4px 24px #0005;
}
body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Quicksand', 'Segoe UI', Arial, sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    transition: background 0.15s, color 0.1s;
}
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5em 2em 1em 2em;
    background: var(--primary);
    box-shadow: var(--shadow);
    border-radius: 0 0 2em 2em;
}
.header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2em;
    color: var(--accent);
    letter-spacing: 2px;
    margin: 0;
}
.header .theme-toggle, .header .back-btn {
    background: rgb(255, 255, 255);
    color: rgb(0, 0, 0);
    border: none;
    border-radius: 2em;
    padding: 0.5em 1.2em;
    font-size: 1em;
    cursor: pointer;
    margin-left: 1em;
    transition: background 0.2s;
}
.header .theme-toggle:hover, .header .back-btn:hover {
    background: var(--primary);
    color: var(--accent);
    border: 1px solid var(--accent);
}
.alert {
    margin: 2em auto 1em auto;
    max-width: 600px;
    background: var(--secondary);
    color: var(--accent);
    border-radius: 1em;
    padding: 1em 2em;
    box-shadow: var(--shadow);
    font-size: 1.1em;
    text-align: center;
}
.mb-3 {
    display: flex;
    justify-content: center;
    gap: 1em;
    margin-bottom: 2em;
}
.mb-3 button {
    background: var(--primary);
    color: var(--accent);
    border: none;
    border-radius: 2em;
    padding: 0.7em 1.5em;
    font-size: 1em;
    font-family: inherit;
    cursor: pointer;
    box-shadow: var(--shadow);
    transition: background 0.2s, color 0.2s;
}
.mb-3 button:hover {
    background: var(--accent);
    color: #fff;
}
table {
    width: 100%;
    max-width: 900px;
    margin: 2em auto;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--card);
    border-radius: 1em;
    box-shadow: var(--shadow);
    overflow: hidden;
}
th, td {
    padding: 1em;
    text-align: left;
}
th {
    background: var(--primary);
    color: var(--accent);
    font-weight: bold;
    border-bottom: 2px solid var(--accent);
}
td {
    border-bottom: 1px solid #eee;
}
tr:last-child td {
    border-bottom: none;
}
form, #search-modal, #view-modal-content {
    background: var(--card);
    border-radius: 1em;
    box-shadow: var(--shadow);
    padding: 2em;
    margin: 2em auto;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    gap: 1em;
}
input[type="text"], input[type="email"], input[type="password"], select, input[type="file"] {
    padding: 0.7em;
    border-radius: 1em;
    border: 1px solid var(--primary);
    background: var(--secondary);
    color: var(--text);
    font-size: 1em;
    font-family: inherit;
    outline: none;
    transition: border 0.2s;
}
input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
    border: 1.5px solid var(--accent);
}
button[type="submit"], button[type="button"] {
    background: rgb(4, 4, 4);
    color: #fff;
    border: none;
    border-radius: 2em;
    padding: 0.7em 1.5em;
    font-size: 1em;
    cursor: pointer;
    margin-top: 0.5em;
    transition: background 0.2s;
}
button[type="submit"]:hover, button[type="button"]:hover {
    background: var(--text);
    color: var(--bg);
}
#search-modal, #view-modal {
    box-shadow: var(--shadow);
}
#view-modal-content {
    max-width: 420px;
}
@media (max-width: 600px) {
    .header {
        flex-direction: column;
        gap: 1em;
        padding: 1em;
    }
    .header h1 {
        font-size: 1.3em;
    }
    .mb-3 {
        flex-direction: column;
        gap: 0.7em;
    }
    table, form, #search-modal, #view-modal-content {
        max-width: 98vw;
        padding: 1em;
    }
    th, td {
        padding: 0.7em;
        font-size: 0.95em;
    }
}
.book-bg {
    background: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=900&q=80') center/cover no-repeat;
    opacity: 0.25;
    position: fixed;
    top: 0; left: 0; width: 100vw; height: 100vh;
    z-index: 0;
    pointer-events: none;
}
</style>

<script>
function showSection(section) {
    document.getElementById('section-search').style.display = 'none';
    document.getElementById('section-create').style.display = 'none';
    document.getElementById('section-list').style.display = 'none';
    document.getElementById('view-modal').style.display = 'none';
    if(section === 'search') {
        document.getElementById('section-search').style.display = 'block';
    } else if(section === 'create') {
        document.getElementById('section-create').style.display = 'block';
    } else if(section === 'list') {
        document.getElementById('section-list').style.display = 'block';
    }
}

// Buscar usuario por nombre (AJAX)
function searchUser(event) {
    event.preventDefault();
    let name = document.getElementById('searchName').value;
    fetch('/profile/search?name=' + encodeURIComponent(name))
        .then(response => response.json())
        .then(user => {
            if(user && user.id) {
                document.getElementById('searchResult').innerHTML = `
                    <div style="margin-top:1em;">
                        <b>Usuario:</b> ${user.username}<br>
                        <b>Correo:</b> ${user.email}<br>
                        <b>Rol:</b> ${user.role}<br>
                        <button onclick="viewUser(${user.id})">Visualizar / Modificar</button>
                        ${user.id != {{ auth()->id() }} ? `<form action="/profile/${user.id}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                        </form>` : ''}
                    </div>
                `;
            } else {
                document.getElementById('searchResult').innerHTML = '<span style="color:red;">Usuario no encontrado.</span>';
            }
        });
    return false;
}

function closeSearch() {
    document.getElementById('section-search').style.display = 'none';
    document.getElementById('searchResult').innerHTML = '';
}

// Visualizar/editar usuario (abre modal y carga formulario por AJAX)
function viewUser(userId) {
    fetch('/profile/' + userId + '/edit')
        .then(response => response.text())
        .then(html => {
            document.getElementById('view-modal-content').innerHTML = html;
            document.getElementById('view-modal').style.display = 'block';
        });
}

// Cerrar modal al hacer click fuera del contenido
document.addEventListener('click', function(e) {
    if(e.target.id === 'view-modal') {
        document.getElementById('view-modal').style.display = 'none';
    }
});

function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
}
function toggleTheme() {
    const current = localStorage.getItem('theme') || 'light';
    setTheme(current === 'dark' ? 'light' : 'dark');
}
(function() {
    const saved = localStorage.getItem('theme');
    if(saved) setTheme(saved);
})();
</script>