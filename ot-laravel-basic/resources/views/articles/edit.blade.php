<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>articles</title>
    </head>
    <body class="bg-blue-100">
    <div class="container p-5">
        <h1 class="text-2xl">글 수정하기</h1>
        <p><a href="{{ route('articles.index') }}">글 목록</a></p>

        <form action="{{ route('articles.update', ['article' => $article->id]) }}" method="POST" class="mt-5">

            @csrf
            <input type="hidden" name="_method" value="PUT" />
            <input type="text" name="body" class="block w-full mb-2 rounded" value="{{ old('body') ?? $article->body }}">

            @error('body')
                <p class="text-xs text-red-500 mb-3">{{ $message }}</p>
            @enderror

            <button class="py-1 px-3 bg-black text-white rounded text-xs">
                수정하기
            </button>
        </form>

    </div>
    </body>
</html>
