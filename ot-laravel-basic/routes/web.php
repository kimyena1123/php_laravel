<?php

use App\Http\Controllers\ProfileController;
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

    //2. DB 파사드를 이용하는 방법
    //DB::statement("INSERT INTO articles (body, user_id) VALUES (:body, :user_id)", ['body'=>$input['body'],'user_id'=>Auth::id()]);

    //3. 쿼리 빌더를 사용하는 방법
    //DB::table('articles')->insert([
    //    'body'=>$input['body'],
    //    'user_id'=>Auth::id(),
    //]);

    //4. Eloquent ORM -> 이  방식으로 하면 created_at과 updated_at도 자동으로 들어가서 저장된다. 1,2,3번은 안해줌
//    $article = new \App\Models\Article;
//    $article->body = $input['body'];
//    $article->user_id = Auth::id();
//    $article->save();

    Article::create([
        'body' => $input['body'],
        'user_id' => Auth::id(),
    ]);

    return 'hello';
});
