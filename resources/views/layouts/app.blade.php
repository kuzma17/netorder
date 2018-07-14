<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NetOrder') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="content">
        <div class="header_top">
            <div class="container">
                <div class="top_info">
                    <span>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    {{ $setting->get('email')}}
                    </span>
                    <span>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    {{$setting->get('phone')}}
                    </span>
                </div>
            </div>
        </div>
        @include('layouts.menu')
        @yield('content')
    </div>
    <div class="footer">
        <span class="copyright">Copyright 2018 © Designed by <a href="mailto:v.kuzma@mail.ru">kuzma</a></span>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
