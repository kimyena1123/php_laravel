<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('개별 글') }}
        </h2>
    </x-slot>

    <div class="container">
        작성내용: {{ $article->body }}
        <p class="page-movement">
            <a href="{{ route('articles.index') }}">글 목록 페이지</a>
        </p>

    </div>

</x-app-layout>

<style>
    .container{
        margin: 0 auto;
        padding: 10px 20px;
    }
    .page-movement{
        margin-top: 20px;
    }
</style>
