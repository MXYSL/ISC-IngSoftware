<?php

namespace App\Console\Commands;

use App\Services\BookService;
use Illuminate\Console\Command;

class SyncBooksCommand extends Command
{
    protected $signature = 'books:sync {category}';
    protected $description = 'Sync books from OpenLibrary API';

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        parent::__construct();
        $this->bookService = $bookService;
    }

    public function handle()
    {
        $category = $this->argument('category');
        
        $this->info("Syncing books for category: {$category}");
        
        $books = $this->bookService->searchBooks($category);
        
        // Process and cache books
        cache()->put("books_{$category}", $books, now()->addDay());
        
        $this->info("Synced " . count($books) . " books");
    }
}