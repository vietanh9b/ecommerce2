<!DOCTYPE html>
<html lang="en">

@include('backend.layouts.head')
<body id="page-top">
 
<!-- Page Wrapper -->
<div id="wrapper">
 
  @include('backend.layouts.sidebar')
 
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
 
    <!-- Main Content -->
    <div id="content">
 
        @include('backend.layouts.navbar')
 
      <!-- Begin Page Content -->
      <div class="container-fluid">
 
          @yield('main-content')
 
      </div>
      <!-- /.container-fluid -->
 
    </div>
    <!-- End of Main Content -->
 
  </div>
  <!-- End of Content Wrapper -->
 
</div>
  @include('backend.layouts.footer')
<!-- End of Page Wrapper -->
 
  @include('backend.layouts.js')
  @stack('after_scripts')

</body>

</html>
