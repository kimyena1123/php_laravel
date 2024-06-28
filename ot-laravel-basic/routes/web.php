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
    $perPage = $request->input('per_page', 2);

    $articles = Article::select('body', 'created_at', 'user_id')
        ->orderby('created_at', 'desc')
        ->paginate($perPage);

    // 쿼리 빌더로 조회
    $results = DB::table('articles as a')
        ->join('users as u', 'a.user_id', '=', 'u.id')
        ->select(['a.*', 'u.name'])
        ->latest()
        ->paginate($perPage);

    // 쿼리 빌더 결과를 Eloquent 모델 인스턴스로 변환
    $articleModels = $results->map(function($item) {
        $article = new Article((array) $item);
        $article->name = $item->name; // 추가 필드를 설정

        // created_at을 Carbon 인스턴스로 변환
        $article->created_at = Carbon::parse($item->created_at);

        return $article;
    });

    return view('articles.index', [
        'title' => $title,
        'articles' => $articles,
        'results' => $articleModels,
    ]);

//    return view('articles.index')->with('articles', $articles)->with('title', $title);

});
