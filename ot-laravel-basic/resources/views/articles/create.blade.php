<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    css, js 불러오기--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <title>articles</title>
</head>
<body class="bg-blue-100">
<h1>글쓰기</h1>
    <form action="/articles" method="POST">
        <input type="text">
        <button type="submit">저장하기</button>
    </form>
</body>
</html>
