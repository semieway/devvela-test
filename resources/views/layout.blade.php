<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<header>
    <nav class="navbar bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Main page</a>
                <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                <a class="nav-link" href="{{ route('product.create') }}">Create</a>
                <a class="nav-link" href="{{ route('product.upload') }}">Upload file</a>
            </li>
        </ul>
    </nav>
</header>
<body class="container">
@yield('content')
</body>
</html>
