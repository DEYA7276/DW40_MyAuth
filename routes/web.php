<?php

use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('/welcome2', 'welcome')->name('welcome');
Route::get('/develop', function () {
    return 'Welcome to developer';
})->name('develop.index');

Route::get('/develop/{develops}', function ($develops){
    if ($develops === '5'){
        return redirect()->route('develop.index');
    }
    return 'Detalles del desarrollar'. $develops;
});

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//ruta personalizada para llamar la funcion de index y mostrar los posteos
Route::get('/posts',[PostController::class, 'index'])->name('posts.index');
//ruta personalizada para crear el registro en la BD de posts
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}/edit',[App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
//ruta para update
Route::patch('/posts/{post}',[App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
//ruta para eliminar
Route::delete('/posts/{post}',[App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
require __DIR__.'/auth.php';
