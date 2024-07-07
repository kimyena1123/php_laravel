<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('글쓰기') }}
        </h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('articles.store') }}" method="POST">

            @csrf {{-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />--}}
            <input type="text" name="body" value="{{old('body')}}" class="block w-full mb-2 rounded">

            @error('body')
                <p>{{ $message }}</p>
            @enderror

            <button class="save-btn">
                저장하기
            </button>

        </form>
        <p style="margin-top: 30px;">
            <a href="{{ route('articles.index') }}">글 목록 페이지로 이동</a>
        </p>

        {{-- {{ dd($errors -> first('body')) }} or {{ dd($errors -> get('body')) }} --}}
        {{--        session에 있는 값을 확인하려면 request의 old() 혹은 old('body')를 사용할 수 있다--}}
        {{--        {{ dd(request()->session())}}--}}

    </div>
</x-app-layout>

<style>
    .container{
        margin: 0 auto;
        padding: 10px 20px;
    }

    .save-btn{
        border: 1px solid black;
        padding: 2px 4px;
    }
</style>
