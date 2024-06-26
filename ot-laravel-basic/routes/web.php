<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
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

    $host = config('database.connections.mysql.host');
    $dbname = config('database.connections.mysql.database');
    $username = config('database.connections.mysql.username');
    $password = config('database.connections.mysql.password');


    //pdo 객체
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //쿼리 준비
    $stmt = $conn->prepare("INSERT INTO articles (body, user_id) VALUES (:body, :user_id)");

    //쿼리 값을 설정
    $body = $request->input('body'); // body값 가져와서 변수에 담기
    //dd($request->collect());

    $stmt->bindValue(':body', $input['body']);
    $stmt->bindValue(':user_id', Auth::id());

    //실행
    $stmt->execute();

    return 'hello';
});
