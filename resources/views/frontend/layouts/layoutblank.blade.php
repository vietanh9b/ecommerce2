<!DOCTYPE html>
<html lang="zxx">
<head>
     {{-- @include('frontend.layouts.head')  --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css')  }}">
</head>
<body class="js">
<div class="container_blank_page">
    <!-- Preloader -->
{{--    <div class="preloader">--}}
{{--        <div class="preloader-inner">--}}
{{--            <div class="preloader-icon">--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End Preloader -->
    @include('frontend.layouts.notification')
    @yield('main-content')
    {{-- @include('frontend.layouts.footer') --}}

    @yield('after_scripts')
    @stack('after_scripts')
</div>
</body>
</html>
