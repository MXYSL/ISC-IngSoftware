<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Autenticación social
Route::get('/auth/{provider}', [AuthController::class, 'redirectToProvider'])->name('social.auth');
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('social.callback');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [DashboardController::class, 'search'])->name('search');
    
    // Perfil de usuario
    Route::get('/profile/show', [UserProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [UserProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/panel', [UserProfileController::class, 'panel'])->name('profile.panel');
    Route::get('/profile/{user}/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user}', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/image', [UserProfileController::class, 'updateImage'])->name('profile.image.update');
    Route::delete('/profile/image', [UserProfileController::class, 'deleteImage'])->name('profile.image.delete');
    Route::get('/profile/search', [UserProfileController::class, 'search'])->name('profile.search');
    
    // Cambio de tema
    Route::post('/theme', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $user->tema = $request->input('tema', 'sistema');
        $user->save();
        
        return response()->json(['status' => 'success']);
    })->name('theme.update');
    
    
});
