<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookService
{
    protected $baseUrl = 'https://openlibrary.org';
    
    public function searchBooks($query, $limit = 10)
    {
        try {
            $response = Http::get("https://openlibrary.org/search.json", [
                'q' => $query, // Parámetro correcto para búsquedas generales
                'limit' => $limit
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['docs'])) {
                    return array_map(function ($book) {
                        return [
                            'title' => $book['title'] ?? 'Sin título',
                            'author' => isset($book['author_name']) ? implode(', ', $book['author_name']) : 'Desconocido',
                            'year' => $book['first_publish_year'] ?? 'Desconocido',
                            'cover' => isset($book['cover_i']) 
                                ? "https://covers.openlibrary.org/b/id/{$book['cover_i']}-M.jpg" 
                                : asset('img/default-cover.png')
                        ];
                    }, $data['docs']);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error en BookService::searchBooks: ' . $e->getMessage());
        }
        
        return [];
    }
    
    public function getBookDetails($title)
    {
        try {
            $response = Http::get("{$this->baseUrl}/search.json", [
                'q' => $title // Cambiado de 'title' a 'q'
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['docs'][0])) {
                    $book = $data['docs'][0];
                    $bookKey = $book['key'] ?? null;
                    
                    if ($bookKey) {
                        $detailsResponse = Http::get("{$this->baseUrl}{$bookKey}.json");
                        
                        if ($detailsResponse->successful()) {
                            $details = $detailsResponse->json();
                            
                            $description = isset($details['description']) 
                                ? (is_string($details['description']) ? $details['description'] : $details['description']['value'] ?? 'No disponible')
                                : 'No disponible';
                            
                            return [
                                'title' => $book['title'],
                                'author' => isset($book['author_name']) ? implode(', ', $book['author_name']) : 'Desconocido',
                                'year' => $book['first_publish_year'] ?? 'Desconocido',
                                'description' => $description,
                                'cover' => isset($book['cover_i']) 
                                    ? "https://covers.openlibrary.org/b/id/{$book['cover_i']}-M.jpg" 
                                    : asset('img/default-cover.png')
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error en BookService::getBookDetails: ' . $e->getMessage());
        }
        
        return null;
    }
    
}