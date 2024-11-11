<!-- Meta Tag -->
@yield('meta')
<title>@yield('title')</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">
{{-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<!-- Bootstrap -->
{{--<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">--}}
{{-- <link rel="stylesheet" type="text/css" href="style.css"  href="{{ asset('frontend/css/style.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

{{-- <link rel="stylesheet" type="text/css" href="css/vendor.css"> --}}
<link rel="stylesheet" href="{{ asset('frontend/css/vendor.css') }}">

{{-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('frontend/css/login.css')  }}"> --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

<!-- script
================================================== -->
{{-- <script src="js/modernizr.js"></script> --}}
<script type="text/javascript" src="{{ asset('frontend/js/modernizr.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('styles')
