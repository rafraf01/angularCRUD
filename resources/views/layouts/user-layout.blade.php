<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    @stack('styles')
    <style>
        body,html {
            padding:0;
            margin:0;
            height:100%;
        }
        .container{
            height:100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="nav-wrapper">
        <nav>
            <ul>
                <li><a>Home</a></li>
                <li><a>About</a></li>
            </ul>
        </nav>
    </div>
    @yield('content')
</div>
</body>
</html>
