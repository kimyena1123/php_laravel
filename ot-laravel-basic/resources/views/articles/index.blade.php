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
        <h1 class="text-2xl">글 목록</h1>

        <?php foreach($articles as $article): ?>
            <div style="border:1px solid #bbb; margin: 5px; padding: 10px;">
                <p><?php echo $article->body; ?></p>
                <p><?php echo $article->created_at ?></p>
            </div>
        <?php endforeach ?>


    </div>
    </body>
</html>
