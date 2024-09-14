<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('themes/admin/assets/images/favicon.ico')}}">

    @yield('style-libs')
    
    <!-- Layout config Js -->
    <script src="{{asset('themes/admin/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('themes/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    {{asset('themes/admin/')}}
    <!-- Icons Css -->
    <link href="{{asset('themes/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('themes/admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('themes/admin/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- custom style --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('style-libs')

</head>
<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

    @include('admin.layout.header')

<!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<!-- /.modal -->
        <!-- ========== App Menu ========== -->

        <!-- Left Sidebar End -->
        @include('admin.layout.sidebar')
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.layout.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    @include('admin.layout.other')
    <script>
        const PATH_ROOT='{{asset('themes/admin')}}';
    </script>
    <!-- JAVASCRIPT -->
    <script src="{{asset('themes/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('themes/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('themes/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('themes/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('themes/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('themes/admin/assets/js/plugins.js')}}"></script>

    @yield('script-libs')

    <!-- App js -->
    <script src="{{asset('themes/admin/assets/js/app.js')}}"></script>
    {{-- custom script --}}
    @yield('script')
</body>
</html>