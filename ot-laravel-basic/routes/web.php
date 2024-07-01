<?php

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

//글 저장하는 페이지
Route::get('/articles/create', function(){
    return view('articles.create');
});

// 글 저장하는 method
Route::post('/articles', function(Request $request){
    //비어있지 않고, 문자열이고, 255자를 넘으면 안된다.
    $input = $request->validate([
        'body'=>[
            'required',
            'string',
            'max:255'
        ],
    ]);

    //5. Eloquent ORM + 쿼리빌더
    Article::create([
        'body' => $input['body'],
        'user_id' => Auth::id(),
    ]);

    return 'hello';
});

//글 목록 페이지
Route::get('/articles', function(Request $request){
    $title = '글 목록';

    $articles = Article::with('user')->select('body','created_at', 'user_id')
                        ->orderby('created_at', 'desc')
                        ->paginate();

    return view('articles.index',
        [
            'title'=>$title,
            'articles' => $articles,
        ]
    );

//    return view('articles.index')->with('articles', $articles)->with('title', $title);
});
