<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('글수정') }}
        </h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('articles.update', ['article' => $article->id]) }}" method="POST" class="mt-5">

            @csrf

            @method('PATCH') {{-- <input type="hidden" name="_method" value="PUT" />--}}
            <input type="text" name="body" class="block w-full mb-2 rounded" value="{{ old('body') ?? $article->body }}">

            @error('body')
                <p>{{ $message }}</p>
            @enderror

            <button class="update-btn">
                수정하기
            </button>
        </form>

        <p class="page-movement">
            <a href="{{ route('articles.index') }}">글 목록 페이지 이동</a>
        </p>

    </div>
</x-app-layout>
<style>
    .container{
        margin: 0 auto;
        padding: 10px 20px;
    }
    .update-btn{
        border: 1px solid blue;
        padding: 2px 5px;
        background: blue;
        color: white;
    }
    .page-movement{
        margin-top: 30px;
    }
</style>
