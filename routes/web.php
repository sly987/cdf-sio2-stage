<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\ReglageController;
use App\Http\Controllers\FicheMoisController;
use App\Http\Controllers\FileAccessController;

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
Route::get('/', function() {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/dashboard', function () {
        if (Auth::user()->admin === 1)
            return view('admin.dashboard');
        else
            return view('user.dashboard');
    })->name('dashboard');

    //Main resources controller
    Route::resources([
        'admin' => AdminController::class,
        'user' => UserController::class,
        'annee'=>AnneeController::class,
        'listeFiche'=>FicheMoisController::class
    ]);

    //Gestion de fichier
    Route::get('/file/download/{fiche}', [FileAccessController::class, 'download'])->name('file.download');
    Route::get('/file/{fiche}/destroy', [FileAccessController::class, 'destroy'])->name('file.destroy');

    //Confirmé une fiche
    Route::get('admin/{id}/confirmed', [AdminController::class, 'confirmed'])->name('admin.confirmed');
    //Liste prof
    Route::get('list', [AdminController::class, 'list'])->name('admin.list');

    //reglage
    Route::get('/reglage', [ReglageController::class, 'donnerAnnee'])->name('reglage');
    Route::post('/reglage', [ReglageController::class, 'donnerAnnee'])->name('reglage');
});

//mail
require __DIR__.'/auth.php';
