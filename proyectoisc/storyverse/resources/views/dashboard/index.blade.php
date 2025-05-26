@extends('layouts.app')
@section('title', 'Dashboard - StoryVerse')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/instorve.css') }}">
@endsection
@section('content')
<header class="header9">
    <div class="logo9">
        <img id="icono" src="{{ asset('img/icono.png') }}" alt="StoryVerse">
    </div>
    <div class="nav-links9">
        <button id="themeToggle10" class="theme-button10">
            <img id="themeIcon10" src="{{ asset('img/claro.png') }}" alt="Modo Claro">
        </button>
    </div>
    <nav class="nav9">
        <div class="search-container9">
            <i class="fa fa-search search-icon9"></i>
            <input type="text" id="search-input9" placeholder="Buscar por título, autor, editorial...">
            <button id="search-button9">Buscar</button>
        </div>
    </nav>
    <div class="nav-links9">
        <a href="#" id="favorites-link"><i class="fa-solid fa-heart"></i> Favoritos</a>
        <a href="#" id="recommendations-link"><i class="fa-solid fa-star"></i> Recomendaciones</a>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('profile.panel') }}"><i class="fa-solid fa-user-tie"></i> Administrador</a>
        @endif
        <a href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Mi perfil</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <a href="#" onclick="this.closest('form').submit()" style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-right-to-bracket"></i> Cerrar sesión
            </a>
        </form>
    </div>
</header>
<main class="main10">
    <section class="welcome-bg-section">
        <div class="welcome-bg-image"></div>
        <div class="welcome-bg-message">
            <h1>Bienvenido, <span class="username-highlight">{{ auth()->user()->username }}</span></h1>
        </div>
    </section>

    <!-- Contenedor para los resultados de búsqueda -->
    <section id="search-results" class="category-section10" style="display: none;">
        <h2>Resultados de la búsqueda</h2>
        <div id="search-results-container"></div>
    </section>

    <!-- Contenedor para los favoritos -->
    <section id="favorites-section" class="category-section10" style="display: none;">
        <div class="favorites-header">
            <h2>Favoritos</h2>
            <button id="close-favorites" class="close-favorites-button">✖</button>
        </div>
        <div id="favorites-container" class="horizontal-list">
            <!-- Los favoritos se cargarán aquí dinámicamente -->
        </div>
    </section>

    <!-- Contenedor para las recomendaciones -->
    <section id="recommendations-section" class="category-section10" style="display: none;">
        <div class="recommendations-header">
            <h2>Recomendaciones</h2>
            <button id="close-recommendations" class="close-recommendations-button">✖</button>
        </div>
        <div id="recommendations-container" class="horizontal-list">
            <!-- Las recomendaciones se cargarán aquí dinámicamente -->
        </div>
    </section>
</main>

<footer class="footer9">
    <p>&copy; 2023 StoryVerse. Todos los derechos reservados.</p>
</footer>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// 2b. Funcionalidad de Vista Previa
window.previewItem = function(type, title, externalId) {
    let apiUrl = '';
    if (type === 'book') {
        apiUrl = `https://openlibrary.org${externalId}.json`;
    } else {
        apiUrl = `https://api.themoviedb.org/3/movie/${externalId}?api_key=832a3694fe96402af8b742808b950175&language=es`;
    }

    $.get(apiUrl, function(info) {
        let description = '';
        if (type === 'book') {
            description = info.description ? (typeof info.description === 'string' ? info.description : info.description.value) : '';
        } else {
            description = info.overview || '';
        }
        let html = `
        <div class="preview-modal">
            <div class="preview-content">
                <button class="close-preview" onclick="$('.preview-modal').remove();">✖</button>
                <h3>${info.title || info.name || title}</h3>
                <p style="font-size:13px;color:#888;">${type === 'book' ? (info.by_statement || '') : (info.release_date || '')}</p>
                <div class="preview-description">${description}</div>
                <a href="${type === 'book' ? 'https://openlibrary.org' + externalId : (info.homepage ? info.homepage : 'https://www.themoviedb.org/movie/' + externalId)}" target="_blank">
                    Visualizar en: ${type === 'book' ? 'OpenLibrary' : 'TMDB'}
                </a>
            </div>
        </div>
        `;
        $('body').append(html);
    });
};

// Favoritos usando localStorage por usuario
const userId = {{ auth()->user()->id }};
function getFavorites() {
    const favs = localStorage.getItem('favorites_' + userId);
    return favs ? JSON.parse(favs) : [];
}

function saveFavorites(favs) {
    localStorage.setItem('favorites_' + userId, JSON.stringify(favs));
}

window.addToFavorites = function(type, title, cover, author, year, externalId) {
    let favs = getFavorites();
    // Evitar duplicados
    if (!favs.some(f => f.external_id === externalId && f.type === type)) {
        favs.push({ type, title, cover, author, year, external_id: externalId });
        saveFavorites(favs);
        alert('Añadido a favoritos');
    }
};

window.removeFromFavorites = function(type, externalId) {
    let favs = getFavorites();
    favs = favs.filter(f => !(f.external_id === externalId && f.type === type));
    saveFavorites(favs);
    cargarFavoritos();
};

function cargarFavoritos() {
    let favs = getFavorites();
    let html = '';
    favs.forEach(function(fav) {
        html += `
            <div class="content-item-horizontal">
                <img src="${fav.cover}" alt="Portada">
                <div class="buttons-overlay">
                    <button class="remove-favorite-button" onclick="removeFromFavorites('${fav.type}', '${fav.external_id}')">Eliminar</button>
                    <button class="preview-button" onclick="previewItem('${fav.type}', '${fav.title.replace(/'/g, "\\'")}', '${fav.external_id}')">Vista previa</button>
                </div>
                <p>${fav.title}</p>
            </div>
        `;
    });
    $('#favorites-container').html(html || '<p>No tienes favoritos aún.</p>');
}

// Funciones de interacción DOM
$(document).ready(function() {
    $('#search-button9').on('click', function() {
        realizarBusqueda();
    });
    $('#search-input9').on('keypress', function(e) {
        if (e.which === 13) realizarBusqueda();
    });

    function ocultarTodasLasSecciones() {
        $('.category-section10').hide();
        $('.welcome-bg-section').hide();
    }

    function mostrarPrincipal() {
        $('.category-section10').hide();
        $('#search-results').hide();
        $('#favorites-section').hide();
        $('#recommendations-section').hide();
        $('.welcome-bg-section').show();
        // Si tienes otras secciones principales, muéstralas aquí
        $('.category-section10').not('#search-results, #favorites-section, #recommendations-section').show();
    }

    function realizarBusqueda() {
        let query = $('#search-input9').val().trim();
        if (!query) return;
        ocultarTodasLasSecciones();
        $('#search-results').show();
        $('#search-results-container').html('<p>Buscando...</p>');

        $.get(`https://openlibrary.org/search.json?q=${encodeURIComponent(query)}&limit=15`, function(dataLibros) {
            let libros = dataLibros.docs.slice(0, 15);
            $.get(`https://api.themoviedb.org/3/search/movie?api_key=832a3694fe96402af8b742808b950175&query=${encodeURIComponent(query)}`, function(dataPeliculas) {
                let peliculas = dataPeliculas.results.slice(0, 15);

                let htmlLibros = '<h3>Libros</h3><div class="horizontal-list">';
                libros.forEach(function(libro) {
                    let cover = libro.cover_i ? `https://covers.openlibrary.org/b/id/${libro.cover_i}-M.jpg` : '{{ asset('img/default-cover.png') }}';
                    let author = libro.author_name ? libro.author_name.join(', ') : 'Desconocido';
                    let year = libro.first_publish_year || 'Desconocido';
                    let externalId = libro.key || '';
                    htmlLibros += `
                        <div class="content-item-horizontal">
                            <img src="${cover}" alt="Portada del libro">
                            <div class="buttons-overlay">
                                <button class="favorite-button" onclick="addToFavorites('book', '${libro.title.replace(/'/g, "\\'")}', '${cover}', '${author.replace(/'/g, "\\'")}', '${year}', '${externalId}')">Favoritos</button>
                                <button class="preview-button" onclick="previewItem('book', '${libro.title.replace(/'/g, "\\'")}', '${externalId}')">Vista previa</button>
                            </div>
                            <p>${libro.title}</p>
                        </div>
                    `;
                });
                htmlLibros += '</div>';

                let htmlPeliculas = '<h3>Películas</h3><div class="horizontal-list">';
                peliculas.forEach(function(pelicula) {
                    let poster = pelicula.poster_path ? `https://image.tmdb.org/t/p/w200${pelicula.poster_path}` : '{{ asset('img/default-cover.png') }}';
                    let year = pelicula.release_date ? pelicula.release_date.split('-')[0] : 'Desconocido';
                    let externalId = pelicula.id || '';
                    htmlPeliculas += `
                        <div class="content-item-horizontal">
                            <img src="${poster}" alt="Póster de la película">
                            <div class="buttons-overlay">
                                <button class="favorite-button" onclick="addToFavorites('movie', '${pelicula.title.replace(/'/g, "\\'")}', '${poster}', '', '${year}', '${externalId}')">Favoritos</button>
                                <button class="preview-button" onclick="previewItem('movie', '${pelicula.title.replace(/'/g, "\\'")}', '${externalId}')">Vista previa</button>
                            </div>
                            <p>${pelicula.title}</p>
                        </div>
                    `;
                });
                htmlPeliculas += '</div>';

                $('#search-results-container').html(htmlLibros + htmlPeliculas);
            });
        });
    }

    // Mostrar sección principal si el input de búsqueda queda vacío
    $('#search-input9').on('input', function() {
        if ($(this).val().trim() === '') {
            mostrarPrincipal();
        }
    });

    // Mostrar favoritos y ocultar otras secciones
    $('#favorites-link').on('click', function(e) {
        e.preventDefault();
        ocultarTodasLasSecciones();
        $('#favorites-section').show();
        cargarFavoritos();
    });

    // Cerrar favoritos y mostrar principal
    $('#close-favorites').on('click', function() {
        $('#favorites-section').hide();
        mostrarPrincipal();
    });

    // Mostrar recomendaciones y ocultar otras secciones
    $('#recommendations-link').on('click', function(e) {
        e.preventDefault();
        ocultarTodasLasSecciones();
        $('#recommendations-section').show();
        cargarRecomendaciones();
    });

    // Cerrar recomendaciones y mostrar principal
    $('#close-recommendations').on('click', function() {
        $('#recommendations-section').hide();
        mostrarPrincipal();
    });
});

function cargarRecomendaciones() {
    let favs = getFavorites();
    let autores = [];
    favs.forEach(f => {
        if (f.author && f.author !== 'Desconocido') autores = autores.concat(f.author.split(','));
    });
    autores = [...new Set(autores.map(a => a.trim()).filter(a => a))];

    let recomendacionesLibros = [];
    let recomendacionesPeliculas = [];

    // Libros por autor favorito
    if (autores.length > 0) {
        $.get(`https://openlibrary.org/search.json?author=${encodeURIComponent(autores[0])}&limit=8`, function(data) {
            recomendacionesLibros = data.docs.slice(0, 10);
            renderRecomendaciones(recomendacionesLibros, recomendacionesPeliculas);
        });
    }

    // Películas por géneros favoritos (los más frecuentes)
    let favMovies = favs.filter(f => f.type === 'movie');
    if (favMovies.length > 0) {
        getFavoriteMovieGenres(favMovies, function(genreIds) {
            if (genreIds.length > 0) {
                // Toma los 3 géneros más frecuentes
                let genreCount = {};
                genreIds.forEach(id => genreCount[id] = (genreCount[id] || 0) + 1);
                let topGenres = Object.entries(genreCount)
                    .sort((a, b) => b[1] - a[1])
                    .slice(0, 3)
                    .map(entry => entry[0])
                    .join(',');

                $.get(`https://api.themoviedb.org/3/discover/movie?api_key=832a3694fe96402af8b742808b950175&with_genres=${topGenres}&language=es&sort_by=popularity.desc&page=1`, function(data) {
                    recomendacionesPeliculas = data.results.slice(0, 10);
                    renderRecomendaciones(recomendacionesLibros, recomendacionesPeliculas);
                });
            } else {
                // Fallback
                $.get(`https://api.themoviedb.org/3/movie/popular?api_key=832a3694fe96402af8b742808b950175&language=es&page=1`, function(data) {
                    recomendacionesPeliculas = data.results.slice(0, 10);
                    renderRecomendaciones(recomendacionesLibros, recomendacionesPeliculas);
                });
            }
        });
    } else {
        // Fallback
        $.get(`https://api.themoviedb.org/3/movie/popular?api_key=832a3694fe96402af8b742808b950175&language=es&page=1`, function(data) {
            recomendacionesPeliculas = data.results.slice(0, 10);
            renderRecomendaciones(recomendacionesLibros, recomendacionesPeliculas);
        });
    }
}

function renderRecomendaciones(libros, peliculas) {
    let html = '';
    if (libros && libros.length > 0) {
        html += '<h3>Libros</h3><div class="horizontal-list">';
        libros.forEach(function(libro) {
            let cover = libro.cover_i ? `https://covers.openlibrary.org/b/id/${libro.cover_i}-M.jpg` : '{{ asset('img/default-cover.png') }}';
            let author = libro.author_name ? libro.author_name.join(', ') : 'Desconocido';
            let year = libro.first_publish_year || 'Desconocido';
            let externalId = libro.key || '';
            html += `
                <div class="content-item-horizontal">
                    <img src="${cover}" alt="Portada del libro">
                    <div class="buttons-overlay">
                        <button class="favorite-button" onclick="addToFavorites('book', '${libro.title.replace(/'/g, "\\'")}', '${cover}', '${author.replace(/'/g, "\\'")}', '${year}', '${externalId}')">Favoritos</button>
                        <button class="preview-button" onclick="previewItem('book', '${libro.title.replace(/'/g, "\\'")}', '${externalId}')">Vista previa</button>
                    </div>
                    <p>${libro.title}</p>
                </div>
            `;
        });
        html += '</div>';
    }
    if (peliculas && peliculas.length > 0) {
        html += '<h3>Películas</h3><div class="horizontal-list">';
        peliculas.forEach(function(pelicula) {
            let poster = pelicula.poster_path ? `https://image.tmdb.org/t/p/w200${pelicula.poster_path}` : '{{ asset('img/default-cover.png') }}';
            let year = pelicula.release_date ? pelicula.release_date.split('-')[0] : 'Desconocido';
            let externalId = pelicula.id || '';
            html += `
                <div class="content-item-horizontal">
                    <img src="${poster}" alt="Póster de la película">
                    <div class="buttons-overlay">
                        <button class="favorite-button" onclick="addToFavorites('movie', '${pelicula.title.replace(/'/g, "\\'")}', '${poster}', '', '${year}', '${externalId}')">Favoritos</button>
                        <button class="preview-button" onclick="previewItem('movie', '${pelicula.title.replace(/'/g, "\\'")}', '${externalId}')">Vista previa</button>
                    </div>
                    <p>${pelicula.title}</p>
                </div>
            `;
        });
        html += '</div>';
    }
    $('#recommendations-container').html(html || '<p>No hay recomendaciones aún.</p>');
}

function getFavoriteMovieGenres(favs, callback) {
    let genreIds = [];
    let pending = 0;
    favs.forEach(fav => {
        if (fav.type === 'movie' && fav.external_id) {
            pending++;
            $.get(`https://api.themoviedb.org/3/movie/${fav.external_id}?api_key=832a3694fe96402af8b742808b950175&language=es`, function(data) {
                if (data.genres && data.genres.length > 0) {
                    data.genres.forEach(g => genreIds.push(g.id));
                }
            }).always(function() {
                pending--;
                if (pending === 0) callback([...new Set(genreIds)]);
            });
        }
    });
    if (pending === 0) callback([]);
}

function setTheme(theme) {
    document.body.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    $('#themeIcon10').attr('src', theme === 'dark' ? '{{ asset('img/oscuro.png') }}' : '{{ asset('img/claro.png') }}');
}

// Al cargar la página, aplica el tema guardado
let savedTheme = localStorage.getItem('theme') || 'light';
setTheme(savedTheme);
// Cambiar tema al hacer clic en el botón
$('#themeToggle10').on('click', function() {
    let current = document.body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    setTheme(current);
});
</script>
@endsection