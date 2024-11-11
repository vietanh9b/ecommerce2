
@php
    $user = auth()->user() ?? null;
    if(Auth::check()){
        $listAddress = $user->getAddress();
        $defaultAddress =$user->getAddressDefault() ?? $listAddress->First();
    }

@endphp
<header id="header" class="site-header header-scrolled position-fixed text-black bg-light header">
    @include('frontend.popup.search') 
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
            </a>
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="navbar-icon">
          <use xlink:href="#navbar-icon"></use>
        </svg>
      </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img  src="{{ asset('frontend/images/main-logo.png') }}" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3" style="margin-right: 40px;">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="{{ route('home') }}">Home</a>
                        </li>
                        @php
                            $parentCategories = \App\Models\Category::getParentCategories();
                        @endphp
                        
                        @foreach ($parentCategories as $category)
                            <li class="nav-item">
                                <a class="nav-link me-4" href="{{ route('product-list', ['slug' => $category->slug]) }}"  >{{ $category->title }}</a>
                            </li>
                        @endforeach

                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('aboutus') }}" class="dropdown-item">About Us</a>
                                </li>
                                 <li>
                                    {{-- <a href="blog" class="dropdown-item">Blog</a> --}}
                                    <a href="{{route('blog')}}" class="dropdown-item">Blog</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class="user-items ">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="search-item pe-3">
                                        <a href="#" class="search-button">
                                            <svg class="search">
                                                 <use xlink:href="#search"></use>
                                            </svg>
                                        </a>
                                    </li> 
                                </ul>
                            </div>
                
                        </li>
                        <li class="nav-item">
                            @if(Auth::check())
                            <div class="user-items ">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="pe-3 nav-item dropdown">
                                        <a  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <svg class="user">
                                            <use xlink:href="#user"></use>
                                          </svg>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                          
                                          <li><a class="dropdown-item" href="{{route('profile')}}"><span class="small-text" style="font-weight: 600">{{ $defaultAddress->name ?? $user->name}}</span></a></li>

                                          <li><a class="dropdown-item" href="{{route('user.logout')}}" id="log-out"><span class="small-text">Đăng xuất</span></a></li>
                                        </ul>
                                      </li>
                                      

                                    <li class="pe-3">
                                        <a href="{{route('checkout')}}">
                                            <svg class="cart">
                                                 <use xlink:href="#cart"></use>
                                            </svg>
                                            <span class="total-count">{{Helper::cartCount()}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                    
                        @else
                                <li class="box_login"><a class="login" href="{{route('login.form')}}">{{ __('Login') }}</a></li>
                            @endif                      
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <style>
        li.pe-3 a {
            position: relative;
            display: inline-block;
        }

        li.pe-3 a .total-count {
            position: absolute;
            top: -13px;
            right: -11px;
            background-color: #FFFFFF;
            color: black;
            border-radius: 24px;
            padding: 2px 5px;
            font-size: 11px;
        }
    </style>
</header>
