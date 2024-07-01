<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>개별 글</title>
    </head>
    <body class="bg-blue-100">
        <div class="container p-5">
            <h1 class="text-2xl">개별 글 보기</h1>
            <p><a href="{{ route('articles.index') }}">글 목록 페이지</a></p>

            작성내용: {{ $article->body }}

        </div>



    </body>
</html>
