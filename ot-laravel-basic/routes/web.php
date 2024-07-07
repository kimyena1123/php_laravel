<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Route::controller(ArticleController::class)->group(function(){
//
//    Route::get('/articles/create', 'create')->name('articles.create'); //글 저장하는 페이지
//    Route::post('/articles', 'store')->name('articles.store'); // 글 저장하는 method
//    Route::get('/articles', 'index')->name('articles.index'); //글 목록 페이지
//    Route::get('/articles/{article}', 'show')->name('articles.show');
//    Route::get('articles/{article}/edit', 'edit')->name('articles.edit');
//    Route::patch('articles/{article}', 'update')->name('articles.update');
//    Route::delete('articles/{article}', 'destroy')->name('articles.destroy');
//});
route::resource('articles', ArticleController::class);










