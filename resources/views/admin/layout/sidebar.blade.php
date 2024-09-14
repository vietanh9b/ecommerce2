<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('themes/admin/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('themes/admin/assets/images/logo-dark.png')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('themes/admin/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('themes/admin/assets/images/logo-light.png')}}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{asset('themes/admin/dashboard-analytics.html')}}" class="nav-link" data-key="t-analytics"> Analytics</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.catelogues.index')}}" class="nav-link"> Catelogues </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a href="#sidebarProduct" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProduct" data-key="t-product">
                        <i class="lab la-product-hunt"></i><span data-key="t-products">Products</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProduct">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.products.index')}}" class="nav-link" data-key="t-product"> List product</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.products.create')}}" class="nav-link" data-key="t-product"> Add Product </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.products.create')}}" class="nav-link" data-key="t-product">List Soft Delete Product</a>
                            </li>
                        </ul>
                    </div>
                        
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a href="#sidebarCatelogue" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCatelogue" data-key="t-catelogue">
                        <i class="lab la-quinscape"></i><span data-key="t-catelogue">Catelogues</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatelogue">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.catelogues.index')}}" class="nav-link" data-key="t-catelogue"> List Catelogues</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.catelogues.create')}}" class="nav-link" data-key="t-catelogue"> Add Catelogue </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.catelogues.trash')}}" class="nav-link" data-key="t-catelogue">List Soft Delete Catelogues</a>
                            </li>
                        </ul>
                    </div>
                        
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a href="#sidebarUser" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUser" data-key="t-user">
                        <i class="lab la-quinscape"></i><span data-key="t-user">Coupons</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.coupons.index')}}" class="nav-link" data-key="t-catelogue"> List Coupons</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.coupons.create')}}" class="nav-link" data-key="t-catelogue"> Add Coupons </a>
                            </li>
                        </ul>
                    </div>
                        
                </li> 
                <li class="nav-item">
                    <a href="#sidebarUser" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUser" data-key="t-user">
                        <i class="lab la-quinscape"></i><span data-key="t-user">Users</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.coupons.index')}}" class="nav-link" data-key="t-catelogue"> List User</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.coupons.create')}}" class="nav-link" data-key="t-catelogue"> Add Users </a>
                            </li>
                        </ul>
                    </div>
                        
                </li> 
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>