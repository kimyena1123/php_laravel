<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
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
    }

    public function index(){
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
    }

    public function show(Article $article){
        return view('articles.show', ['article' => $article]);
    }

    public function edit(Article $article){
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, Article $article){
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
    }

    public function destroy(Article $article){
        $article->delete();

        return redirect()->route('articles.index');
    }


}
