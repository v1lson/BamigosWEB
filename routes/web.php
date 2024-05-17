<?php

use App\Http\Controllers\BansController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MuteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolUserController;
use App\Http\Controllers\ServidorController;
use App\Http\Middleware\CheckFlagB;
use App\Http\Middleware\CheckFlagL;
use App\Http\Middleware\CheckFlagM;
use App\Http\Middleware\CheckFlagR;
use App\Http\Middleware\CheckFlagS;
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
Route::get('/movil', function () {
    return view('movil');
});
Route::resource("/", ServidorController::class);
Route::resource("Estadistica", EstadisticaController::class);
Route::resource("Bans", BansController::class);
Route::resource("Mute", MuteController::class);
Route::resource("/Servidores", ServidorController::class);

Route::get('/login', \App\Http\Controllers\Auth\SteamAuthController::class);


Route::middleware([CheckFlagB::class])->group(function () {
    Route::get('/Bans/DeleteBan/{id}/{user}', [BansController::class, 'update'])->name('Bans.update');
    Route::post('/Castigos/{id_servidor}/Castigar', [BansController::class, 'create'])->name('Bans.create');
    Route::post('/Castigos/Store', [BansController::class, 'store'])->name('Bans.store');
    Route::post('/Castigos/Kick', [BansController::class, 'kick'])->name('Bans.kick');
    Route::get('/Castigos/{id_servidor}', [ServidorController::class, 'verTodosCastigos'])->name('Servidores.castigos');
});
Route::middleware([CheckFlagM::class])->group(function () {
    Route::get('/Mute/DeleteMute/{id}/{user}', [MuteController::class, 'update'])->name('Mute.update');
});
Route::middleware([CheckFlagL::class])->group(function () {
    Route::resource("Logs", LogController::class);
    Route::get('/Logs/{id_servidor}', [LogController::class, 'show'])->name('logs.show');
    Route::post('/Logs/{id_servidor}', [LogController::class, 'filtrar'])->name('logs.filter');
});
Route::middleware([CheckFlagS::class])->group(function () {
    Route::get('/Servidores', [ServidorController::class, 'verTodos'])->name('serviodres.todos');
});
Route::middleware([CheckFlagR::class])->group(function () {
    Route::resource("Roles", RolUserController::class);
    Route::post('/Roles/AddUser', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/Roles/AddUser/{id}', [RolUserController::class, 'showAddUser'])->name('Roles.showAddUser');
    Route::get('/Roles/AllUsers/{id}', [RolUserController::class, 'showAllUsers'])->name('Roles.showAllUsers');
});
Route::get('/Administradores', [ProfileController::class, 'showAdmins'])->name('admins');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/Estadistica/{id_servidor}/{order_by}/{orden}', [EstadisticaController::class, 'show'])->name('est');
Route::get('/Mute/{id_servidor}', [MuteController::class, 'show'])->name('Mute');
Route::get('/Bans/{id_servidor}', [BansController::class, 'show'])->name('Bans');
Route::get('/{categoria}', [ServidorController::class, 'categoria'])->name('/');
require __DIR__.'/auth.php';
