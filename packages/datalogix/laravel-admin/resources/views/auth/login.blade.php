<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('admin.title') }}</title>
</head>
<body>
    <form method="post" action=""{{ route('admin.login') }}">
        @csrf
        <div>
            e-mail:
            <input type="text" name="email" />
        </div>
        <div>
            Passowrd:
            <input type="password" name="password" />
        </div>
        <div>
            <input type="submit" value="Enviar" />
        </div>
    </form>
</body>
</html>
