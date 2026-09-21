<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kasir</title>
    @vite('resources/css/app.css')
</head>
<body class="p-8">

    <h1 class="text-2xl font-bold mb-4">
        Kelola Akun Kasir
    </h1>

    @foreach ($users as $user)
        <div class="mb-2">
            {{ $user->name }} - {{ $user->email }}
        </div>
    @endforeach

</body>
</html>