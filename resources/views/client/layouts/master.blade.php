<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @include('client.layouts.style')
  </head>
  <body>
  
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      @include('client.components.header')

    </header>

    @yield('banner')
    @yield('content')


    @include('client.components.footer')
  </div>
  @include('client.layouts.script')
  </body>
</html>