<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', function() {
    return view('auth.login');
});

//Main resources controller
Route::resources([
    'user' => UserController::class,
    'teacher' => TeacherController::class
]);

//Liste prof
Route::get('list', [UserController::class, 'list'])->name('user.list');

//Dashboard
Route::get('/dashboard', function () {
    if (Auth::user()->admin === 1)
        return view('admin.dashboard');
    else
        return view('user.dashboard');
})->middleware(['auth'])->name('dashboard');

//mail

Route::get('/mail', 'App\Http\Controllers\MailController@sending',);

require __DIR__.'/auth.php';
