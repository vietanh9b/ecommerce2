<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
    <div class="sidebar-brand-icon">
      <img style="width:125px;" src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
    </div>
    <div style="font-size:13px" class="sidebar-brand-text mx-3">{{__('DT Group')}}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('admin')}}">
      <i class="fas fa-chart-line"></i>
      <span>{{__('Dashboard')}}</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      {{__('Banner')}}
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- Nav Item - Charts -->
  <li class="nav-item ">
      <a class="nav-link" href="{{route('file-manager')}}">
        <i class="fab fa-medium"></i>
          <span>{{__('Media Manager')}}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed wgt-collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-image"></i>
      <span>{{__('Banners')}}</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{__('Banner Options:')}}</h6>
        <a class="collapse-item" href="#">{{__('Banners')}}</a>
        <a class="collapse-item" href="#">{{__('Add Banners')}}</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
          {{__('Shopping Cart')}}
      </div>

  <!-- Categories -->
  {{-- <li class="nav-item">
      <a class="nav-link collapsed wgt-collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
        <i class="fas fa-sitemap"></i>
        <span>{{__('Category')}}</span>
      </a>
      <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">#</h6>
          <a class="collapse-item" href="#">{{__('Category')}}</a>
          <a class="collapse-item" href="#">{{__('Add Category')}}</a>
        </div>
      </div>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link" href="{{route('category.index')}}">
      <i class="fas fa-tags"></i>
        <span>{{__('Category')}}</span>
    </a>
</li>
  {{-- Products --}}
  <li class="nav-item">
    <a class="nav-link" href="{{route('product.index')}}">
      <i class="fas fa-tablet-alt"></i>
        <span>{{__('Products')}}</span>
    </a>
  </li>
  <!--Orders -->
  <li class="nav-item">
      <a class="nav-link" href="{{route('order.index')}}">
        <i class="fas fa-truck"></i>
          <span>{{__('Orders')}}</span>
      </a>
  </li>
  <!--Receipt -->
  <li class="nav-item">
      <a class="nav-link" href="{{route('order.receipt.index')}}">
        <i class="fas fa-receipt"></i>
          <span>{{__('Receipt')}}</span>
      </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    {{__('Posts')}}
  </div>

  <!-- Posts -->
  <li class="nav-item">
    <a class="nav-link collapsed wgt-collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
      <i class="fab fa-blogger"></i>
      <span>{{__('Posts')}}</span>
    </a>
    <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Post Options:</h6>
        <a class="collapse-item" href="{{route('post.index')}}">{{__('Posts')}}</a>
        <a class="collapse-item" href="{{route('post.create')}}">{{__('Add Post')}}</a>
      </div>
    </div>
  </li>

   <!-- Category -->
   <li class="nav-item">
      <a class="nav-link collapsed wgt-collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
        <i class="fas fa-sitemap fa-folder"></i>
        <span>{{__('Post Category')}}</span>
      </a>
      <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{{__('Category Options:')}}</h6>
          <a class="collapse-item" href="#">{{__('Category')}}</a>
          <a class="collapse-item " href="#">{{__('Add Category')}}</a>
        </div>
      </div>
    </li>

    <!-- Tags -->

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
   <!-- Heading -->
  <div class="sidebar-heading">
      {{__('General Settings')}}
  </div>
  <li class="nav-item">
    <a class="nav-link" href="{{route('users.index')}}">
      <i class="fas fa-users"></i>
        <span>{{__('All Customer')}}</span>
    </a>
</li>
   <!-- General settings -->
   <li class="nav-item">
      <a class="nav-link collapsed wgt-collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
          <i class="fas fa-cog"></i>
          <span>{{__('Settings')}}</span>
      </a>
       <div id="collapseSetting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">{{__('Settings:')}}</h6>
               <a class="collapse-item">{{__('General setting')}}</a>
               <a class="collapse-item" href="#">{{__('Version setting')}}</a>
               <a class="collapse-item" href="#">{{__('Currency symbol setting')}}</a>
           </div>
       </div>
  </li>
  @include(backpack_view('inc.sidebar_content'))

</ul>
@push('after_scripts')
  <script>
      $('.wgt-collapse').click(function () {
          var elementId = $(this).attr('data-target');
          if (elementId && typeof elementId != 'undefined') {
              $(elementId).collapse('toggle');
          }
      });
  </script>
@endpush
