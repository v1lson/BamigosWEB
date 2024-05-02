<?php

use App\Http\Controllers\BansController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\MuteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServidorController;
use App\Models\Servidor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});
Route::get('bienvenida', function () {
    return view('welcome');
});
Route::get('/reglas', function () {
    return view('paginas.reglas');
});
Route::resource("/", ServidorController::class);
Route::resource("Estadistica", EstadisticaController::class);
Route::resource("Bans", BansController::class);
Route::resource("Mute", MuteController::class);
Route::get('/login', \App\Http\Controllers\Auth\SteamAuthController::class);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/Estadistica/{id_servidor}/{order_by}/{orden}', [EstadisticaController::class, 'show'])->name('est');
Route::get('/Mute/{id_servidor}', [MuteController::class, 'show'])->name('Mute');
Route::get('/Bans/{id_servidor}', [BansController::class, 'show'])->name('Bans');
Route::get('/{categoria}', [ServidorController::class, 'categoria'])->name('/');
require __DIR__.'/auth.php';
