<?php

namespace App\Jobs;

use App\Services\TranslationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TranslateContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $text;
    protected $callback;

    public function __construct($text, $callback)
    {
        $this->text = $text;
        $this->callback = $callback;
    }

    public function handle(TranslationService $translationService)
    {
        $translatedText = $translationService->translateToSpanish($this->text);
        
        // Execute callback with translated text
        if (is_callable($this->callback)) {
            call_user_func($this->callback, $translatedText);
        }
    }
}