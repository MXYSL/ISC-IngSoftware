<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    protected $apiKey;
    
    public function __construct()
    {
        $this->apiKey = config('services.google_translate.api_key');
    }
    
    public function translateToSpanish($text)
    {
        try {
            $response = Http::post('https://translation.googleapis.com/language/translate/v2', [
                'key' => $this->apiKey,
                'q' => $text,
                'target' => 'es',
                'source' => 'en'
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['data']['translations'][0]['translatedText'])) {
                    return $data['data']['translations'][0]['translatedText'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Error en TranslationService: ' . $e->getMessage());
        }
        
        return $text; // Return original text if translation fails
    }
}