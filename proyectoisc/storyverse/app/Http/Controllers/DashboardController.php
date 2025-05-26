<?php
// filepath: c:\Users\mayra\storyverse\app\Http\Controllers\DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Services\MovieService;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $bookService;
    protected $movieService;

    public function __construct(BookService $bookService, MovieService $movieService)
    {
        $this->bookService = $bookService;
        $this->movieService = $movieService;
        $this->middleware('auth'); // Aplica el middleware de autenticación
    }

    public function index()
    {
        $user = auth()->user();

        $categories = [
            'Populares' => [
                'books' => $this->bookService->searchBooks('bestsellers'),
                'movies' => $this->movieService->getMovies('popular')
            ],
            'Fantasía' => [
                'books' => $this->bookService->searchBooks('fantasy'),
                'movies' => $this->movieService->getMovies('popular')
            ],
            'Ciencia Ficción' => [
                'books' => $this->bookService->searchBooks('science fiction'),
                'movies' => $this->movieService->getMovies('top_rated')
            ],
            'Misterio' => [
                'books' => $this->bookService->searchBooks('mystery'),
                'movies' => $this->movieService->getMovies('now_playing')
            ]
        ];

        return view('dashboard.index', compact('categories'));
         return view('admin.dashboard');
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');

        if (empty($query)) {
            return response()->json(['error' => 'No se proporcionó un término de búsqueda.']);
        }

        try {
            $books = $this->bookService->searchBooks($query, 15);
            $movies = $this->movieService->searchMovies($query);

            return response()->json([
                'books' => $books,
                'movies' => $movies
            ]);
        } catch (\Exception $e) {
            Log::error('Error en DashboardController::search: ' . $e->getMessage());
            return response()->json(['error' => 'Error al realizar la búsqueda.'], 500);
        }
    }
}

