<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="TestApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Saver Asia') }}</title>

    <!-- Styles -->
    @stack('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@yield('layout')

<!-- Scripts -->
@stack('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>