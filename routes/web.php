<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Models\News;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------singl
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class , 'landing']);

Route::get('/{news:slug}/view', [HomeController::class,'single'])->name('single.page');

Route::middleware(['guest'])->group(function(){
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class,'masuk'])->name('masuk.page');
Route::get('/register',[LoginController::class, 'register']);
Route::post('/register',[LoginController::class,'tambah'])->name('tambah.page');
});

Route::post('/comment', [NewsController::class,'comment'])->name('comment.news');
Route::middleware(['auth'])->group(function (){
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/admin', function () { return view('dashboard.index');});
Route::resource('/admin/news', NewsController::class);
Route::delete('/comment/{comment:id}', [NewsController::class , 'hapus'])->name('comment.hapus');
Route::post('/balas/comment/{id}', [NewsController::class, 'balas'])->name('comment.balas');
});
