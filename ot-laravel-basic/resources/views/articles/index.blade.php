<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>글 목록</title>
    </head>
    <body class="bg-blue-100">
    <div class="container p-5">
        <h1 class="text-2xl">{{ $title }}</h1>
        <p><a href="/articles/create/">글 작성 페이지</a></p>

        @auth
        @foreach($articles as $article) {{-- @for($i=0; $i<$articles->count(); $i++) --}}
            <div style="border:1px solid #bbb; margin: 5px; padding: 10px;">
                <p>작성내용: {{ $article->body }}</p>
                <p>작성자: {{ $article->user->name }}</p>
                <p><a href="/articles/{{ $article->id }}">작성시간: {{ $article->created_at->diffForHumans()}}</a> </p>
            </div>
        @endforeach
        @endauth
{{--    로그인한 사람한테만 보여주는 blade 문법 : @auth와 @endauth   --}}
    </div>

{{--    <ul>--}}
{{--        @for($i = 0; $i < $totalCount / $perPage; $i++)--}}
{{--            <li><a href="/articles?page={{$i+1}}&per_page={{$perPage}}">{{$i+1}}</a></li>--}}
{{--        @endfor--}}
{{--    </ul>--}}


    <div style="width: 100%; height: 300px; display: flex;">
        {{ $articles -> links() }}
    </div>

    </body>
</html>
