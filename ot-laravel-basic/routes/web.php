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
})->name('articles.create');

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

    return redirect()->route('articles.index');

})->name('articles.store');

//글 목록 페이지
Route::get('/articles', function(Request $request){
    $title = '글 목록';

    $articles = Article::with('user')
                        ->orderby('created_at', 'desc')
                        ->paginate();

    $results = DB::table('articles as a')->join('users as u', 'a.user_id', '=', 'u.id')
                                ->select(['a.*', 'u.name'])
                                ->latest()
                                ->paginate();

    return view('articles.index',
        [
            'title'=>$title,
            'articles' => $articles,
            'results' => $results,
        ]
    );

//    return view('articles.index')->with('articles', $articles)->with('title', $title);
})->name('articles.index');

//Route::get('/articles/{모델이름}', function(모델){
Route::get('/articles/{article}', function(Article $article){

    return view('articles.show', ['article' => $article]);
})->name('articles.show');

Route::get('articles/{article}/edit', function(Article $article){
    return view('articles.edit', ['article' => $article]);
})->name('articles.edit');

Route::patch('articles/{article}', function(Request $request, Article $article){

    //비어있지 않고, 문자열이고, 255자를 넘으면 안된다
    $input = $request->validate([
        'body'=>[
            'required',
            'string',
            'max:255'
        ]
    ]);

    $article->body = $input['body'];
    $article->save();

    return redirect()->route('articles.index');
})->name('articles.update');

Route::delete('articles/{article}', function(Request $request, Article $article){
    $article->delete();

    return redirect()->route('articles.index');
})->name('articles.delete');


