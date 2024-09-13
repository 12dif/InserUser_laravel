<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('CSS/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('CSS/all.min.css')}}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Laravel</title>
    </head>

    <body>

    <div class="hstack justify-content-center mt-5 gap-3">
        <a href="{{route('locale',['locale'=>'fr'])}}">FR</a>
        <a href="{{route('locale',['locale'=>'en'])}}">EN</a>
    </div>

    @yield('content')

    <script src="{{asset('JS/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('JS/all.min.js')}}"></script>
    </body>
</html>
