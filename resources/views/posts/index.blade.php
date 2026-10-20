<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Post</title>
</head>
<body>
    <h1>Semua Post</h1>

    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }} — oleh {{ $post->user->name }}</li>
        @endforeach
    </ul>
</body>
</html>
