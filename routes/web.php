<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\ReglageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FicheMoisController;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\UserManagementController;

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
 

    //Main resources controller
    Route::resources([
        'manage' => UserManagementController::class,
        'annee'=>AnneeController::class,
        'listeFiche'=>FicheMoisController::class,
        'dashboard'=>DashboardController::class
    ]);

    //Gestion de fichier
    Route::put('/file/update/{id}', [UserManagementController::class, 'updatefiche'])->name('manage.updatefiche');
    Route::get('/file/download/{fiche}', [FileAccessController::class, 'download'])->name('file.download');
    Route::get('/file/{fiche}/destroy', [FileAccessController::class, 'destroy'])->name('file.destroy');

    //Confirmé une fiche
    Route::get('admin/{id}/confirmed', [UserManagementController::class, 'confirmed'])->name('manage.confirmed');
    //Activité un mois
    Route::get('admin/{id}/dactivemonth', [UserManagementController::class, 'dactivemonth'])->name('manage.dactivemonth');
    Route::get('admin/{id}/activemonth', [UserManagementController::class, 'activemonth'])->name('manage.activemonth');
    //Liste prof
    Route::get('list', [UserManagementController::class, 'list'])->name('manage.list');

    //reglage
    Route::get('/reglage', [ReglageController::class, 'donnerAnnee'])->name('reglage');
    Route::post('/reglage', [ReglageController::class, 'donnerAnnee'])->name('reglage');
});

//mail
require __DIR__.'/auth.php';
