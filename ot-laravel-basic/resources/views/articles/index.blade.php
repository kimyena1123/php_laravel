<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('글목록') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>{{ $title }}</h1>
        <p style="margin: 20px 0;">
            <a href="{{ route('articles.create') }}">글 작성 페이지 이동</a>
        </p>

        @auth
        @foreach($articles as $article) {{-- @for($i=0; $i<$articles->count(); $i++) --}}
            <div class="content-div">
                <p>작성내용: {{ $article->body }}</p>
                <p>작성자: {{ $article->user->name }}</p>
{{--                <p><a href="/articles/{{ $article->id }}">작성시간: {{ $article->created_at->diffForHumans()}}</a> </p>--}}
                <p><a href="{{ route('articles.show', ['article' => $article->id, 'sort' => 'asc']) }}">작성시간: {{ $article->created_at->diffForHumans()}}</a> </p>

                <div class="buttonDiv">
                    <span class="update-btn">
                        <a href="{{ route('articles.edit', ['article' => $article->id]) }}">수정</a>
                    </span>
                    <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn">
                            삭제
                        </button>
                    </form>
                </div>

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
</x-app-layout>

<style>
    .container{
        margin: 0 auto;
        padding: 10px 20px;
    }
    h1{
        font-size: 30px;
        margin-bottom: 10px;
    }
    .content-div{
        border:1px solid #bbb;
        margin: 15px;
        padding: 10px;
    }
    .buttonDiv{
        display: flex;
        gap: 5px;
    }
    .update-btn{
        border: 1px solid blue;
        padding: 2px 5px;
        background: blue;
        color: white;
    }
    .delete-btn{
        border: 1px solid red;
        padding: 2px 5px;
        background: red;
        color: white;
    }
</style>
