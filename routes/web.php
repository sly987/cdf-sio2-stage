<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Page de connexion
Route::get('/', function () {
    return view('auth.login');
});

//Admin
Route::get('/professeurs/create', [UserController::class, 'create'])->name('professeurs.create');
Route::post('/professeurs/create', [UserController::class, 'store'])->name('professeurs.store');
Route::get('/professeurs', [UserController::class, 'index'])->name('professeurs');
Route::get('/professeurs/{id}', [UserController::class, 'show'])->name('professeurs.show');
Route::get('/professeurs/edit/{id}', [UserController::class, 'edit'])->name('professeurs.edit');
Route::put('/professeurs/update/{id}', [UserController::class, 'update'])->name('professeurs.update');

//Utilisateur
Route::get('/h', function () {
    return view('historique');
});

//Fiches de paie
Route::get('/t', [UserController::class, 'fichecreate'])->name('televerse.create');
Route::post('/t', [UserController::class, 'fichestore'])->name('televerse.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
