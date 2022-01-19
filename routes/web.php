<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;

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
Route::get('/', [UserController::class, 'connexion']);

//Main resources controller
Route::resources([
    'user' => UserController::class,
    'teacher' => TeacherController::class
]);

//Dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
