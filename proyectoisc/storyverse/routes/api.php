<?php
use App\Http\Controllers\FavoriteController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index']); // Obtener favoritos del usuario
    Route::post('/favorites', [FavoriteController::class, 'store']); // Agregar a favoritos
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']); // Eliminar de favoritos
});