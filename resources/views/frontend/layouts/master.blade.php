<!DOCTYPE html>
<html lang="en">
<head>
   @include('frontend.layouts.head')
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    
    {{-- <!-- Header -->
	@include('frontend.layouts.header')
    <!--/ End Header --> --}}
    @include('frontend.layouts.notification')
    {{-- <!-- Header -->
    @include('frontend.layouts.header_fe') --}}
    <!--/ End Header -->
    @yield('main-content')
    <!-- Footer -->
    @include('frontend.layouts.footer')
    <!--/ End Footer -->

    @yield('after_scripts')
    @stack('after_scripts')
</body>
</html>