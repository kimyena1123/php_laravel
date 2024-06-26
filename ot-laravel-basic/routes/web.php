<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
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

Route::get('/articles/create', function(){
    return view('articles.create');
});
Route::post('/articles', function(Request $request){
    //비어있지 않고, 문자열이고, 255자를 넘으면 안된다.
    $input = $request->validate([
        'body'=>[
            'required',
            'string',
            'max:255'
        ],
    ]);

    //DB 파사드를 이용하는 방법
    DB::statement("INSERT INTO articles (body, user_id) VALUES (:body, :user_id)", ['body'=>$input['body'],'user_id'=>Auth::id()]);

    return 'hello';
});
