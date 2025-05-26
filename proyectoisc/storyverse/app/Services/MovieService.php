<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieService
{
    protected $baseUrl = 'https://api.themoviedb.org/3';
    protected $apiKey;
    
    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
    }
    
    public function getMovies($type = 'popular', $page = 1)
    {
        try {
            $response = Http::get("{$this->baseUrl}/movie/{$type}", [
                'api_key' => $this->apiKey,
                'language' => 'es-ES',
                'page' => $page
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['results'])) {
                    return array_map(function ($movie) {
                        return [
                            'title' => $movie['title'],
                            'year' => isset($movie['release_date']) ? explode('-', $movie['release_date'])[0] : 'Desconocido',
                            'poster' => isset($movie['poster_path']) 
                                ? "https://image.tmdb.org/t/p/w500{$movie['poster_path']}" 
                                : asset('img/default-cover.png')
                        ];
                    }, $data['results']);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error en MovieService::getMovies: ' . $e->getMessage());
        }
        
        return [];
    }
    
    public function searchMovies($query)
    {
        try {
            $apiKey = '832a3694fe96402af8b742808b950175'; 
            $response = Http::get("https://api.themoviedb.org/3/search/movie", [
                'api_key' => $apiKey,
                'query' => $query,
                'language' => 'es-ES' // Idioma opcional
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return array_map(function ($movie) {
                    return [
                        'title' => $movie['title'] ?? 'Sin título',
                        'poster' => isset($movie['poster_path']) 
                            ? "https://image.tmdb.org/t/p/w500{$movie['poster_path']}" 
                            : asset('img/default-poster.png'),
                        'year' => isset($movie['release_date']) ? explode('-', $movie['release_date'])[0] : 'Desconocido'
                    ];
                }, $data['results'] ?? []);
            }
        } catch (\Exception $e) {
            Log::error('Error en MovieService::searchMovies: ' . $e->getMessage());
        }

        return [];
    }
}