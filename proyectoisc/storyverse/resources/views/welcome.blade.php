<!-- resources/views/welcome.blade.php -->
@extends('layouts.guest')

@section('title', 'StoryVerse')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<!-- BARRA DE NAVEGACION -->
<nav class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
  
    <!-- Primer bloque de links -->
    <div id="nav-links" class="nav-links">
        <a href="#Populares"><i class="fas fa-fire"></i> Populares</a>
        <a href="#Recientes"><i class="fas fa-clock"></i> Recientes</a>
        <a href="#Blog"><i class="fas fa-feather-alt"></i> Blog de Autores</a>
    </div>
  
    <!-- Logo centrado -->
    <div class="navbar-logo">
        <img src="{{ asset('img/icono.png') }}" alt="Logo Icon" />
    </div>
  
    <!-- Segundo bloque de links -->
    <div id="nav-links2" class="nav-links">
        <a href="{{ route('home') }}"><i class="fas fa-house-user"></i> Inicio</a>
        <a href="{{ route('login') }}"><i class="fas fa-user"></i> Iniciar sesión</a>
        <a href="#Contacto"><i class="fa-regular fa-id-badge"></i> Contáctanos</a>
    </div>
</nav>

<!-- Contenedor para móviles: une ambos -->
<div id="mobile-menu" class="mobile-nav-links">
    <a href="{{ route('home') }}"><i class="fas fa-house-user"></i> Inicio</a>
    <a href="#Recientes"><i class="fas fa-clock"></i> Recientes</a>
    <a href="#Populares"><i class="fas fa-fire"></i> Populares</a>
    <a href="#Blog"><i class="fas fa-feather-alt"></i> Blog de Autores</a>
    <a href="#Contacto"><i class="fa-regular fa-id-badge"></i> Contáctanos</a>
    <a href="{{ route('login') }}"><i class="fas fa-user"></i> Iniciar sesión</a>
</div>

<!-- SECCION 1 PRINCIPAL -->
<div class="hero-section">
    <div class="overlay"></div>
    <div class="hero-content">
        <h2>Bienvenido...</h2>
        <h1>Descubre tu<br>próxima historia</h1>
        <p class="details">Libros fascinantes | Películas inolvidables</p>
        <button class="btn btn-recommendations" id="Recomendaciones">
            <i class="fas fa-book"></i> Explora Recomendaciones
        </button>
    </div>
</div>
<!-- FIN S1-->

<!-- SECCION NUEVOS / RECIENTES-->
<section class="new-releases-section2" id="Recientes">
    <div class="container2">
      <div class="section-header">
        <h2 class="section-title">CATÁLOGO GENERAL: NUEVAS PUBLICACIONES</h2>
        <div class="header-line"></div>
      </div>
      
      <div class="carousel-container">
        <div class="book-carousel2">
          <!-- Libro 1 -->
          <div class="book-card2">
            <div class="book-cover2">
              <img src="https://z-lib.io/images/14000000/14091819.webp" alt="Modern Philosophy">
              <div class="book-overlay2">
                <button class="view-btn2">Vista Previa</button>
              </div>
            </div>
            <div class="book-info2">
              <h3>Modern Philosophy</h3>
              <p class="author">Peter Carlton</p>
            </div>
          </div>
          

          <!-- Libro 3 -->
            <div class="book-card2">
                <div class="book-cover2">
                <img src="https://www.planetadelibros.com/usuaris/libros/fotos/362/original/portada_a-todos-los-chicos-de-los-que-me-enamore_jenny-han_202211041118.jpg" alt="A todos los chicos de los que me enamoré">
                <div class="book-overlay2">
                    <button class="view-btn2">Vista Previa</button>
                </div>
                </div>
                <div class="book-info2">
                <h3>A todos los chicos de los que me enamoré</h3>
                <p class="author">Jenny Han</p>
                </div>
            </div>
  
          <!-- Libro 4 -->
          <div class="book-card2">
            <div class="book-cover2">
              <img src="https://m.media-amazon.com/images/I/51uUv2l7IfL._AC_UF1000,1000_QL80_.jpg" alt="An Introduction to Computer Networks">
              <div class="book-overlay2">
                <button class="view-btn2">Vista Previa</button>
              </div>
            </div>
            <div class="book-info2">
              <h3>An Introduction to Computer Networks</h3>
              <p class="author">David Clarke</p>
            </div>
          </div>
          
          <!-- Libro 5 -->
          <div class="book-card2">
            <div class="book-cover2">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWc4eEz4ByDyeF_9kCgsDMQAoXt1cQZH2KnQ&s" alt="Ciencias Naturales y TIC">
              <div class="book-overlay2">
                <button class="view-btn2">Vista Previa</button>
              </div>
            </div>
            <div class="book-info2">
              <h3>Ciencias Naturales y TIC</h3>
              <p class="author">Instituto de Investigación</p>
            </div>
          </div>
          
          <!-- Libro 6 -->
          <div class="book-card2">
            <div class="book-cover2">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQs0Stc6cCoUhP77RdvBpt9kTQ3FOnLlyI4rQ&s" alt="Arquitectura Moderna">
              <div class="book-overlay2">
                <button class="view-btn2">Vista Previa</button>
              </div>
            </div>
            <div class="book-info2">
              <h3>Arquitectura Moderna</h3>
              <p class="author">Laura Menéndez</p>
            </div>
          </div>

            <!-- Libro 7 -->
            <div class="book-card2">
                <div class="book-cover2">
                <img src="https://images.cdn2.buscalibre.com/fit-in/360x360/dc/77/dc77d1b54b6a7ebd3f26ce0a68847f88.jpg" alt="Bajo la Misma Estrella">
                <div class="book-overlay2">
                    <button class="view-btn2">Vista Previa</button>
                </div>
                </div>
                <div class="book-info2">
                <h3>Bajo la Misma Estrella</h3>
                <p class="author">John Green</p>
                </div>
            </div>
  
            <!-- Libro 8 -->
            <div class="book-card2">
                <div class="book-cover2">
                <img src="https://m.media-amazon.com/images/I/71VrtQU9VBL.jpg" alt="Los Juegos del Hambre">
                <div class="book-overlay2">
                    <button class="view-btn2">Vista Previa</button>
                </div>
                </div>
                <div class="book-info2">
                <h3>Los Juegos del Hambre</h3>
                <p class="author">Suzanne Collins</p>
                </div>
            </div>

        </div>
    </div>
      
      <div class="navigation-controls2">
        <button class="nav-btn2 prev-btn2" aria-label="Anterior">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <div class="nav-dots2">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
        <button class="nav-btn2 next-btn2" aria-label="Siguiente">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>
  </section>
  <!-- FIN S2 -->  

<!-- GALERIA DE LIBROS POPULARES -->
<section class="portfolio-section" id="Populares">
    <div class="container">
      <h2 class="section-title">Libros y Peliculas Populares</h2>
      
      <!-- Filtros de categoría -->
      <div class="filter-container">
        <button class="filter-btn active" data-filter="all">Todo</button>
        <button class="filter-btn" data-filter="fant">Fantasía</button>
        <button class="filter-btn" data-filter="ter">Terror</button>
        <button class="filter-btn" data-filter="sus">Suspenso</button>
        <button class="filter-btn" data-filter="fic">Ficción</button>
        <button class="filter-btn" data-filter="rom">Romanse</button>
      </div>
      
      <!-- Galería de imágenes -->
      <div class="gallery-container">

        <!-- Elemento 1 (fantasia) -->
        <div class="gallery-item fant">
            <img src="https://lamexicanalibrerias.com/wp-content/uploads/2022/09/359895_portada_el-senor-de-los-anillos-1-la-comunidad-del-anillo_j-r-r-tolkien_202206071121-scaled.jpg" alt="Portada de El Señor de los Anillos">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>El Señor de los Anillos</h3>
                <p>Una épica aventura en la Tierra Media</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 2 (fantasia) -->
        <div class="gallery-item fant">
            <img src="https://http2.mlstatic.com/D_NQ_NP_892544-MLU77495244059_072024-O.webp" alt="Escena de Harry Potter y la Piedra Filosofal">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Harry Potter</h3>
                <p>Magia y amistad en Hogwarts</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 3 (romanse) -->
        <div class="gallery-item rom">
            <img src="https://m.media-amazon.com/images/I/81RC15VKlQL._UF894,1000_QL80_.jpg" alt="Portada de Orgullo y Prejuicio">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Orgullo y Prejuicio</h3>
                <p>Un clásico de amor y sociedad</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 4 (terror) -->
        <div class="gallery-item ter">
            <img src="https://http2.mlstatic.com/D_NQ_NP_941557-MLM25958113006_092017-O.webp" alt="Portada de It de Stephen King">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>It</h3>
                <p>Un clásico de terror psicológico</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 5 (fantasia) -->
        <div class="gallery-item fant">
            <img src="https://images.cdn1.buscalibre.com/fit-in/360x360/45/44/4544aa9e50feca33c58b1d4646f34b2f.jpg" alt="Portada de El Hobbit de J.R.R. Tolkien">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>El Hobbit</h3>
                <p>Una aventura épica en la Tierra Media</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 6 (terror) -->
        <div class="gallery-item ter">
            <img src="https://m.media-amazon.com/images/I/71lJit9-vUL.jpg" alt="Escena de El Resplandor de Stanley Kubrick">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>El Resplandor</h3>
                <p>Un thriller de horror psicológico</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 7 (terror) -->
        <div class="gallery-item ter">
            <img src="https://images.cdn2.buscalibre.com/fit-in/360x360/95/5b/955be07d4a94383ea56271dc865e5e8c.jpg" alt="Portada de Cementerio de animales de Stephen King">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Cementerio de animales</h3>
                <p>Un relato aterrador de vidas perdidas</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 8 (romanse) -->
        <div class="gallery-item rom">
            <img src="https://images.justwatch.com/poster/77207501/s718/la-la-land.jpg" alt="Portada de La La Land">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>La La Land</h3>
                <p>Una historia de amor y música</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 9 (Romanse) -->
        <div class="gallery-item rom">
            <img src="https://m.media-amazon.com/images/I/71fgSHqvRtL._AC_UF894,1000_QL80_.jpg" alt="Portada de Me before You">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Yo antes de ti</h3>
                <p>Un cuento de amor incondicional y destino</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 10 (terror) -->
        <div class="gallery-item ter">
            <img src="https://es.web.img2.acsta.net/r_1280_720/pictures/18/05/11/10/36/1321203.jpg" alt="Portada de Hereditary">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Hereditary</h3>
                <p>Terror psicológico que desafía los límites</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 11 (ficcion) -->
        <div class="gallery-item fic">
            <img src="https://preview.redd.it/abmhd7m2w1h71.jpg?width=640&crop=smart&auto=webp&s=61802b768866ea5ec926a258d747b2ebfd0e4414" alt="Portada de Dune por Frank Herbert">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>DUNE</h3>
                <p>Una épica de ciencia ficción en Arrakis</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 12 (romanse) -->
        <div class="gallery-item rom">
            <img src="https://musicart.xboxlive.com/7/f31d3300-0000-0000-0000-000000000002/504/image.jpg" alt="Escena de Diario de una pasión">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Diario de una pasión</h3>
                <p>Una historia de amor que trasciende el tiempo</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 13 (Suspenso) -->
        <div class="gallery-item sus">
            <img src="https://zoomf7.net/wp-content/uploads/2019/06/gone-girl-poster.jpg" alt="Portada de Gone Girl">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Gone Girl</h3>
                <p>Suspenso con giros inesperados</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 14 (Suspenso) -->
        <div class="gallery-item sus">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFHvScVsq1dISR7Qsh7mnDSZc_fiyyIWFBhw&s" alt="Escena de Seven">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Seven</h3>
                <p>Una búsqueda atrapante de justicia y verdad</p>
            </div>
            </div>
        </div>
         
        <!-- Elemento 15 (ficción) -->
        <div class="gallery-item fic">
            <img src="https://www.planetadelibros.com/usuaris/libros/fotos/330/original/portada_1984_george-orwell_202102151044.jpg" alt="Portada de 1984 por George Orwell">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>1984</h3>
                <p>Un futuro distópico que pone a prueba la libertad</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 16 (ficción) -->
        <div class="gallery-item fic">
            <img src="https://hips.hearstapps.com/es.h-cdn.co/fotoes/images/media/imagenes/recursos/blade-runner-poster/136792680-1-esl-ES/blade-runner-poster.jpg" alt="Escena de Blade Runner">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Blade Runner</h3>
                <p>Un viaje sobre la humanidad y los replicantes</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 17 (fantasía) -->
        <div class="gallery-item fant">
            <img src="https://m.media-amazon.com/images/I/91hkAAEpLIL._AC_UF894,1000_QL80_.jpg" alt="Portada de Las Crónicas de Narnia">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Las Crónicas de Narnia</h3>
                <p>Un mundo mágico lleno de aventuras</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 18 (fantasía) -->
        <div class="gallery-item fant">
            <img src="https://m.media-amazon.com/images/I/81gp+9MhixL.jpg" alt="Portada de Percy Jackson y el ladrón del rayo">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Percy Jackson</h3>
                <p>Mitología y aventuras heroicas</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 19 (fantasía) -->
        <div class="gallery-item fant">
            <img src="https://www.mubis.es/media/users/7286/228904/portada-de-como-entrenar-a-tu-dragon-3-original.jpg" alt="Portada de Cómo entrenar a tu dragón">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Cómo entrenar a tu dragón</h3>
                <p>Dragones y valentía en una tierra vikinga</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 20 (terror) -->
        <div class="gallery-item ter">
            <img src="https://image.isu.pub/210716021547-1b320dc7b46d650e72e3bae66829a42a/jpg/page_1_thumb_large.jpg" alt="Portada de La llamada de Cthulhu por H.P. Lovecraft">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>La llamada de Cthulhu</h3>
                <p>Un horror cósmico indescriptible</p>
            </div>
            </div>
        </div>

        <!-- Elemento 21 (suspenso) -->
        <div class="gallery-item sus">
            <img src="https://www.arte.unicen.edu.ar/cdab/wp-content/uploads/2019/05/el-silencio-de-los-inocentes.jpg" alt="Portada de El Silencio de los Inocentes">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>El Silencio de los Inocentes</h3>
                <p>Suspenso y tensión con Hannibal Lecter</p>
            </div>
            </div>
        </div>
  
        <!-- Elemento 22 (romanse) -->
        <div class="gallery-item rom">
            <img src="https://images.cdn2.buscalibre.com/fit-in/360x360/ce/a3/cea3df33ddfc80bae9f80a57ace654b5.jpg" alt="Escena de Titanic">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Titanic</h3>
                <p>Un amor trágico a bordo de un destino fatal</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 23 (romanse) -->
        <div class="gallery-item rom">
            <img src="https://http2.mlstatic.com/D_NQ_NP_853393-MLU74121886064_012024-O.webp" alt="Portada de El Gran Gatsby">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>El Gran Gatsby</h3>
                <p>Una historia de amor, sueños y tragedia</p>
            </div>
            </div>
        </div>
        
        <!-- Elemento 24 (romanse) -->
        <div class="gallery-item rom">
            <img src="https://m.media-amazon.com/images/S/pv-target-images/e5525361d6c4df27a8177ff8f87bc8b2bef943331c796f716fd08e5aac537e40.jpg" alt="Escena de Antes del Amanecer">
            <div class="overlay1">
            <div class="overlay-content">
                <h3>Antes del Amanecer</h3>
                <p>Un encuentro que redefine el amor</p>
            </div>
            </div>
        </div>
  

      <!-- Botón para cargar más -->
      <div class="load-more">
        <button id="load-more-btn">Cargar Más</button>
      </div>
    </div>
  </section>
 <!-- FIN S3-->

<!-- SECCION 4 BARRA COLOR-->
<section class="stats-container">
    <div class="stats-grid">
      <div class="stat-item">
        <i class="icon book-icon">📚</i>
        <div class="stat-number">150+</div>
        <div class="stat-label">Libros Recomendados</div>
      </div>
      
      <div class="stat-item">
        <i class="icon movie-icon">🎬</i>
        <div class="stat-number">200+</div>
        <div class="stat-label">Películas Destacadas</div>
      </div>
      
      <div class="stat-item">
        <i class="icon star-icon">⭐</i>
        <div class="stat-number">95%</div>
        <div class="stat-label">Opiniones Positivas</div>
      </div>
      
      <div class="stat-item">
        <i class="icon comment-icon">💬</i>
        <div class="stat-number">1.5K</div>
        <div class="stat-label">Comentarios de Usuarios</div>
      </div>
    </div>
  </section>
<!-- FIN S4-->

<!-- SECCION 5 -->
<section class="recommendations-container" id="recomendaciones">
    <h1>Recomendaciones de Entretenimiento</h1>
    
    <div class="content-grid">
      <!-- Columna de Libros Destacados -->
      <div class="content-card">
        <div class="card-header">
          <h2>Libros Destacados</h2>
        </div>
        
        <div class="card-content">
          <!-- Libro 1 -->
          <div class="item">
            <span class="tag reciente">Reciente</span>
            <h3>"Sapiens: De animales a dioses" <span class="author">de Yuval Noah Harari</span></h3>
            <p>Una fascinante historia sobre la humanidad.</p>
          </div>
          
          <hr class="divider">
          
          <!-- Libro 2 -->
          <div class="item">
            <span class="tag clasico">Clásico</span>
            <h3>"Cien años de soledad" <span class="author">de Gabriel García Márquez</span></h3>
            <p>Un clásico de la literatura latinoamericana.</p>
          </div>
          
          <hr class="divider">
          
          <!-- Libro 3 -->
          <div class="item">
            <span class="tag fantasia">Fantasía</span>
            <h3>"El Señor de los Anillos" <span class="author">de J.R.R. Tolkien</span></h3>
            <p>Una épica aventura en la Tierra Media.</p>
          </div>
        </div>
      </div>
      
      <!-- Columna de Películas Destacadas -->
      <div class="content-card">
        <div class="card-header">
          <h2>Películas Destacadas</h2>
        </div>
        
        <div class="card-content">
          <!-- Película 1 -->
          <div class="item">
            <span class="tag reciente">Reciente</span>
            <h3>"Everything Everywhere All At Once"</h3>
            <p>Una historia única y galardonada.</p>
          </div>
          
          <hr class="divider">
          
          <!-- Película 2 -->
          <div class="item">
            <span class="tag clasico">Clásico</span>
            <h3>"Casablanca"</h3>
            <p>Un romance eterno y memorable.</p>
          </div>
          
          <hr class="divider">
          
          <!-- Película 3 -->
          <div class="item">
            <span class="tag ciencia-ficcion">Ciencia Ficción</span>
            <h3>"Interestelar"</h3>
            <p>Explorando los límites del espacio y el tiempo.</p>
          </div>
        </div>
      </div>
      
      <!-- Columna de Categorías -->
      <div class="content-card">
        <div class="card-header">
          <h2>Categorías</h2>
        </div>
        
        <div class="card-content categories">
          <div class="category">
            <span>Ficción</span>
            <div class="category-bar fiction"></div>
          </div>
          
          <div class="category">
            <span>Clásicos</span>
            <div class="category-bar classics"></div>
          </div>
          
          <div class="category">
            <span>Fantasía</span>
            <div class="category-bar fantasy"></div>
          </div>
          
          <div class="category">
            <span>Drama</span>
            <div class="category-bar drama"></div>
          </div>
          
          <div class="category">
            <span>Ciencia Ficción</span>
            <div class="category-bar sci-fi"></div>
          </div>
          
          <div class="category">
            <span>Aventura</span>
            <div class="category-bar adventure"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- FIN S5-->


<!-- SECCION AUTORES POPULARES -->
  <section>
    <div class="container5" id="Blog">
        <div class="section-header5">
            <h2 class="section-title5">Últimos Autores Destacados</h2>
        </div>
        
        <div class="author-card5">
            <img src="https://e00-elmundo.uecdn.es/assets/multimedia/imagenes/2024/09/23/17271138910753.jpg" alt="Sally Rooney" class="author-image5">
            <div class="author-content5">
                <h3 class="author-title5">Sally Rooney</h3>
                <div class="author-meta5">
                    <div class="views5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>
                        </svg>
                        834
                    </div>
                    <div class="comments5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 6H19V15H6V17C6 17.55 6.45 18 7 18H18L22 22V7C22 6.45 21.55 6 21 6ZM17 12V3C17 2.45 16.55 2 16 2H3C2.45 2 2 2.45 2 3V17L6 13H16C16.55 13 17 12.55 17 12Z" fill="currentColor"/>
                        </svg>
                        423
                    </div>
                </div>
                <p class="author-description5">La aclamada autora irlandesa continúa dominando las listas de bestsellers con su nueva novela "Ecos del Silencio", donde explora las complejas relaciones interpersonales en la era digital. Su estilo minimalista y su aguda observación social la mantienen como una de las voces más importantes de la literatura contemporánea.</p>
                <p class="highlight-quote5">Su prosa cristalina disecciona la melancolía y vulnerabilidad de la juventud actual como ningún otro autor contemporáneo.</p>
            </div>
        </div>
        
        <div class="author-card5">
            <img src="https://m.media-amazon.com/images/M/MV5BZmY5MTBjMjUtMzVmOC00ZTVlLThmYjctMmM0MjIyNDBlODgwXkEyXkFqcGc@._V1_.jpg" alt="Colson Whitehead" class="author-image5">
            <div class="author-content5">
                <h3 class="author-title5">Colson Whitehead</h3>
                <div class="author-meta5">
                    <div class="views5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>
                        </svg>
                        755
                    </div>
                    <div class="comments5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 6H19V15H6V17C6 17.55 6.45 18 7 18H18L22 22V7C22 6.45 21.55 6 21 6ZM17 12V3C17 2.45 16.55 2 16 2H3C2.45 2 2 2.45 2 3V17L6 13H16C16.55 13 17 12.55 17 12Z" fill="currentColor"/>
                        </svg>
                        364
                    </div>
                </div>
                <p class="author-description5">El multipremiado autor norteamericano sigue reinventándose con "Sombras de América", una novela que entrelaza historia y ficción para explorar las tensiones raciales en Estados Unidos. Su capacidad para combinar narrativa histórica con elementos de género le ha valido reconocimiento mundial y adaptaciones cinematográficas de sus obras anteriores.</p>
                <p class="highlight-quote5">Whitehead transforma la historia americana en una poderosa alegoría sobre la identidad nacional y las cicatrices del pasado que no terminan de sanar.</p>
            </div>
        </div>
        
        <div class="author-card5">
            <img src="https://ichef.bbci.co.uk/ace/ws/640/cpsprodpb/4e68/live/94cbc0f0-87bb-11ef-b582-ebb053a6df4f.jpg.webp" alt="Han Kang" class="author-image5">
            <div class="author-content5">
                <h3 class="author-title5">Han Kang</h3>
                <div class="author-meta5">
                    <div class="views5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="currentColor"/>
                        </svg>
                        631
                    </div>
                    <div class="comments5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 6H19V15H6V17C6 17.55 6.45 18 7 18H18L22 22V7C22 6.45 21.55 6 21 6ZM17 12V3C17 2.45 16.55 2 16 2H3C2.45 2 2 2.45 2 3V17L6 13H16C16.55 13 17 12.55 17 12Z" fill="currentColor"/>
                        </svg>
                        512
                    </div>
                </div>
                <p class="author-description5">La escritora surcoreana, ganadora del Premio Internacional Booker, ha publicado "El jardín de cristal", una obra contemplativa que explora la fragilidad humana y la conexión con la naturaleza. Su prosa poética y su enfoque en temas como la violencia, la memoria y el cuerpo continúan cautivando a lectores de todo el mundo.</p>
                <p class="highlight-quote5">La delicadeza de su escritura contrasta con la fuerza brutal de las emociones que evoca, creando una experiencia literaria única que trasciende fronteras culturales.</p>
            </div>
        </div>
    </div>
  </section>
<!-- FIN S6 -->

<!-- SECCION CONTACTO -->
    <section>
        <div class="contacto-container6" id="Contacto">
            <div class="info-contacto6">
                <div>
                    <h2 class="ubicacion-titulo6">UBICACIÓN</h2>
                    <p class="ubicacion-direccion6">
                        28 Jackson Blvd Ste 1020 Chicago<br>
                        IL 60604-2340
                    </p>
                </div>
                
                <div>
                    <h2 class="siguenos-titulo6">SÍGUENOS</h2>
                    <div class="redes-sociales6">
                        <a href="#" class="icono-social6">
                            <svg viewBox="0 0 320 512">
                                <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                            </svg>
                        </a>
                        <a href="#" class="icono-social6">
                            <svg viewBox="0 0 512 512">
                                <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                            </svg>
                        </a>
                        <a href="#" class="icono-social6">
                            <svg viewBox="0 0 448 512">
                                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                            </svg>
                        </a>
                        <a href="#" class="icono-social6">
                            <svg viewBox="0 0 488 512">
                                <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <p class="politica-privacidad6">© 2025 Política de privacidad</p>
            </div>
            
            <div class="form-contacto6">
                <h2 class="form-titulo6">FORMULARIO DE CONTACTO</h2>
                <form class="formulario6">
                    <input type="text" class="campo-formulario6" placeholder="Enter your Name">
                    <input type="email" class="campo-formulario6" placeholder="Enter a valid email address">
                    <textarea class="mensaje-formulario6" placeholder="Enter your message"></textarea>
                    <button type="submit" class="boton-enviar6">ENVIAR</button>
                </form>
            </div>
        </div>
    </section>
<!-- FIN S7 -->


<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


@endsection

@section('scripts')
<!-- BARRA MENU -->
<script>
    function toggleMenu() {
      const mobileMenu = document.getElementById('mobile-menu');
      mobileMenu.classList.toggle('show');
    }
  
    // Cierra menú móvil al dar clic en un link
    document.addEventListener('DOMContentLoaded', function() {
      const mobileLinks = document.querySelectorAll('#mobile-menu a');
      mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
          document.getElementById('mobile-menu').classList.remove('show');
        });
      });
    });
  </script>

<!-- FUENTE-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- RECOMENDACIONES -->
  <script>
    // Captura el botón por su id
    const botonRecomendaciones = document.getElementById('Recomendaciones');

    // Evento de clic para hacer scroll a la sección de recomendaciones
    botonRecomendaciones.addEventListener('click', () => {
        const seccion = document.getElementById('recomendaciones'); // Captura la sección
        seccion.scrollIntoView({ behavior: 'smooth' }); // Desplazamiento suave
    });
  </script>


<!-- GALERIA -->
  <script>
    // JavaScript para el funcionamiento de la galería con filtros
    document.addEventListener('DOMContentLoaded', function() {
  // Elementos DOM
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const loadMoreBtn = document.getElementById('load-more-btn');
    
    // Configuración
    const itemsToShow = 12; // Número máximo de elementos para mostrar inicialmente
    let currentFilter = 'all';
    let currentlyShown = 0;
    
    // Función para filtrar elementos
    function filterGallery(filter) {
        currentFilter = filter;
        currentlyShown = 0;
    
    // Ocultar todos los elementos primero
    galleryItems.forEach(item => {
      item.classList.add('hidden');
    });
    
    // Seleccionar elementos a mostrar según el filtro
    const filteredItems = filter === 'all' 
      ? galleryItems 
      : document.querySelectorAll(`.gallery-item.${filter}`);
    
    // Mostrar sólo hasta el número máximo establecido
    for (let i = 0; i < filteredItems.length && i < itemsToShow; i++) {
      filteredItems[i].classList.remove('hidden');
      currentlyShown++;
    }
    
    // Actualizar estado del botón "Cargar más"
    updateLoadMoreButton(filteredItems.length);
    }
  
  // Actualizar visibilidad del botón "Cargar más"
  function updateLoadMoreButton(totalItems) {
    if (currentlyShown < totalItems) {
      loadMoreBtn.style.display = 'inline-block';
    } else {
      loadMoreBtn.style.display = 'none';
    }
   }
  
  // Cargar más elementos
  function loadMoreItems() {
    const filteredItems = currentFilter === 'all' 
      ? galleryItems 
      : document.querySelectorAll(`.gallery-item.${currentFilter}`);
    
    let count = 0;
    
    for (let i = currentlyShown; i < filteredItems.length && count < 6; i++) {
      filteredItems[i].classList.remove('hidden');
      currentlyShown++;
      count++;
    }
    
    updateLoadMoreButton(filteredItems.length);
  }
  
  // Event listeners para los botones de filtro
  filterButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Actualizar clase active en botones
      filterButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
      
      // Aplicar filtro
      const filter = this.getAttribute('data-filter');
      filterGallery(filter);
    });
  });
  
  // Event listener para el botón de cargar más
  loadMoreBtn.addEventListener('click', loadMoreItems);
  
  // Inicializar la galería (mostrar 'Todo' por defecto)
  filterGallery('all');
});
  </script>

<!-- RECIENTES / NUEVOS -->
<script>
    // JavaScript para la funcionalidad del carrusel de libros nuevos
    document.addEventListener('DOMContentLoaded', function() {
      // Elementos DOM
      const carousel = document.querySelector('.book-carousel2');
      const prevBtn = document.querySelector('.prev-btn2');
      const nextBtn = document.querySelector('.next-btn2');
      const dots = document.querySelectorAll('.dot');
      const bookCards = document.querySelectorAll('.book-card2');
      
      // Variables
      let currentIndex = 0;
      let cardWidth, cardsPerView, maxIndex;
      
      // Función para calcular dimensiones
      function calculateDimensions() {
        cardWidth = bookCards[0].offsetWidth + 25; // Ancho + gap
        const carouselWidth = carousel.parentElement.offsetWidth;
        cardsPerView = Math.max(1, Math.floor(carouselWidth / cardWidth));
        maxIndex = Math.max(0, Math.ceil(bookCards.length / cardsPerView) - 1);
        
        // Actualizar número de puntos si es necesario
        updateDotCount();
      }
      
      // Actualizar el número de puntos según el número de slides
      function updateDotCount() {
        const dotsContainer = document.querySelector('.nav-dots2');
        dotsContainer.innerHTML = '';
        
        for (let i = 0; i <= maxIndex; i++) {
          const dot = document.createElement('span');
          dot.classList.add('dot');
          if (i === currentIndex) {
            dot.classList.add('active');
          }
          
          dot.addEventListener('click', () => {
            slideCarousel(i);
          });
          
          dotsContainer.appendChild(dot);
        }
      }
      
      // Función para desplazar el carrusel
      function slideCarousel(index) {
        // Asegurar que el índice está dentro de los límites
        index = Math.max(0, Math.min(index, maxIndex));
        
        currentIndex = index;
        const offset = -currentIndex * cardsPerView * cardWidth;
        
        // Aplicar la transformación
        carousel.style.transform = `translateX(${offset}px)`;
        
        // Actualizar los puntos de navegación y botones
        updateDots();
        updateButtons();
      }
      
      // Actualizar los puntos de navegación
      function updateDots() {
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
          dot.classList.toggle('active', index === currentIndex);
        });
      }
      
      // Actualizar el estado de los botones
      function updateButtons() {
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === maxIndex;
        
        prevBtn.style.opacity = currentIndex === 0 ? 0.5 : 1;
        nextBtn.style.opacity = currentIndex === maxIndex ? 0.5 : 1;
      }
      
      // Inicializar el carrusel
      function initCarousel() {
        calculateDimensions();
        slideCarousel(0);
        
        // Añadir transición suave después de la carga inicial
        setTimeout(() => {
          carousel.style.transition = 'transform 0.5s ease';
        }, 100);
      }
      
      // Event listeners para los botones
      prevBtn.addEventListener('click', () => {
        slideCarousel(currentIndex - 1);
      });
      
      nextBtn.addEventListener('click', () => {
        slideCarousel(currentIndex + 1);
      });
      
      // Gestión de eventos táctiles
      let startX, moveX;
      let isDragging = false;
      
      function handleTouchStart(e) {
        startX = e.touches[0].clientX;
        isDragging = true;
        carousel.style.transition = 'none';
      }
      
      function handleTouchMove(e) {
        if (!isDragging) return;
        moveX = e.touches[0].clientX;
        const diffX = moveX - startX;
        const currentOffset = -currentIndex * cardsPerView * cardWidth;
        carousel.style.transform = `translateX(${currentOffset + diffX}px)`;
      }
      
      function handleTouchEnd() {
        if (!isDragging) return;
        isDragging = false;
        carousel.style.transition = 'transform 0.5s ease';
        
        const diffX = moveX - startX;
        if (diffX < -50 && currentIndex < maxIndex) {
          slideCarousel(currentIndex + 1);
        } else if (diffX > 50 && currentIndex > 0) {
          slideCarousel(currentIndex - 1);
        } else {
          slideCarousel(currentIndex);
        }
      }
      
      // Añadir eventos táctiles
      carousel.addEventListener('touchstart', handleTouchStart);
      carousel.addEventListener('touchmove', handleTouchMove);
      carousel.addEventListener('touchend', handleTouchEnd);
      
      // Ajustar carrusel cuando se redimensiona la ventana
      window.addEventListener('resize', () => {
        const oldCardsPerView = cardsPerView;
        calculateDimensions();
        
        // Mantener el carrusel en una posición válida después del redimensionamiento
        slideCarousel(Math.min(currentIndex, maxIndex));
      });
      
      // Inicializar el carrusel
      initCarousel();
      
      // Opcionalmente: Auto-rotación
      
      let autoplayInterval;
      function startAutoplay() {
        autoplayInterval = setInterval(() => {
          if (currentIndex < maxIndex) {
            slideCarousel(currentIndex + 1);
          } else {
            slideCarousel(0);
          }
        }, 5000); // Cambiar cada 5 segundos
      }
      
      function stopAutoplay() {
        clearInterval(autoplayInterval);
      }
      
      // Iniciar autoplay
      startAutoplay();
      
      // Detener autoplay cuando el usuario interactúa
      carousel.addEventListener('mouseenter', stopAutoplay);
      carousel.addEventListener('touchstart', stopAutoplay);
      
      // Reanudar autoplay cuando el usuario deja de interactuar
      carousel.addEventListener('mouseleave', startAutoplay);
      
    });
</script>

@endsection