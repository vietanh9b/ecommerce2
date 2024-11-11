@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || INDEX')
@section('main-content')
@include('frontend.layouts.header_fe')

  @php
    $svgContent = file_get_contents(public_path('frontend/svg/index.svg'));
    echo $svgContent;

  @endphp

<section id="billboard" class="position-relative overflow-hidden bg-light-blue" style="padding: 100px 0px 20px; ;">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper" style="height: auto;">
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Iphone 14 Pro Max</h1>
                                {{-- <a href="shop" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a> --}}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/banner-image-iphone.png') }}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex flex-wrap align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Apple Watch Series 8</h1>
                                {{-- <a href="shop" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a> --}}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="{{ asset('frontend/images/banner-image-watch.png') }}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-prev">
        <svg class="chevron-left" style="height:100px">
      <use xlink:href="#chevron-left" />
    </svg>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-next">
        <svg class="chevron-right" style="height:100px">
      <use xlink:href="#chevron-right" />
    </svg>
    </div>
</section>



<section id="company-services" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="cart-outline">
              <use xlink:href="#cart-outline" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Free delivery</h3>
                        <p>Áp dụng với đơn hàng trên 10 triệu </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="quality">
              <use xlink:href="#quality" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>
                        <p>Sản phẩm chính hãng 100%, là nhà phân phối độc quyền của Apple</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="price-tag">
              <use xlink:href="#price-tag" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Daily offers</h3>
                        <p>Sản phẩm mới luôn được cập nhật theo thị trường</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="shield-plus">
              <use xlink:href="#shield-plus" />
            </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>
                        <p>Đảm bảo độ bảo mật thông tin khách hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php
$parentCategories = \App\Models\Category::getParentCategories();
$firstCategory = $parentCategories[0];
$secondCategory = $parentCategories[1];
$thirdCategory = $parentCategories[2];
$fourthCategory = $parentCategories[3];

@endphp
{{-- @foreach ($parentCategories as $category)                       --}}
<section id="{{ $firstCategory->slug }}" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div  class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">{{ $firstCategory->title }} Products</h2>
                <div class="btn-right">
                    <a href="{{ route('product-list', ['slug' => $firstCategory->slug]) }}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper" >
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/ip14black.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000-29.000.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/ip14gold.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Promax 256gb</a>
                                </h3>
                                <!-- <span class="item-price text-primary">$1100</span> -->
                            </div>
                            <h5 class="item-price text-primary">28.000.000-29.500.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/ip14sliver.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Pro 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">26.000.000-27.000.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/ip14purple.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 Pro 256gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">27.900.000-29.000.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 ₫</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
{{-- @endforeach --}}


{{-- @foreach ($parentCategories as $category)                       --}}
<section id="{{ $secondCategory->slug }}" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div  class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">{{ $secondCategory->title }} Products</h2>
                <div class="btn-right">
                    <a href="{{ route('product-list', ['slug' => $secondCategory->slug]) }}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper" >
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/aw8grap.png') }}" alt="product-item" class="img-fluid">
                            </div>
                           
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Watch Series 8 41mm thép GPS+Cellular</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">15.900.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/aw8pink.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Watch Series 8 41mm nhôm GPS+Cellular</a>
                                </h3>
                                <!-- <span class="item-price text-primary">$1100</span> -->
                            </div>
                            <h5 class="item-price text-primary">11.800.000-11.900.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/aw7blue.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Watch Series 7 Nhôm GPS</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">7.500.000-7.800.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/aw7kem.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Watch Series 7 Nhôm GPS + Cellular</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">8.500.000₫</h5>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                           
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 ₫</h5>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
{{-- @endforeach --}}



{{-- @foreach ($parentCategories as $category)                       --}}
<section id="{{ $thirdCategory->slug }}" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div  class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">{{ $thirdCategory->title }} Products</h2>
                <div class="btn-right">
                    <a href="{{ route('product-list', ['slug' => $thirdCategory->slug]) }}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper" >
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/macpro13m2sliver.png') }}" alt="product-item" class="img-fluid">
                            </div>
                           
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">macbook pro 13inch M2 256GB</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">29.590.000-31.00.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/macpro14m2gray.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">macbook pro 14inch M2 512GB</a>
                                </h3>
                                <!-- <span class="item-price text-primary">$1100</span> -->
                            </div>
                            <h5 class="item-price text-primary">47.550.000-47.950.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/macairm1sliver.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">macbook air 13inch m1 256gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">18.590.000-18.900.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/macairm2gold.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">macbook air 13inch m2 256b</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">27.590.000-29.000.000₫</h5>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                           
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 ₫</h5>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
{{-- @endforeach --}}



{{-- @foreach ($parentCategories as $category)                       --}}
<section id="{{ $fourthCategory->slug }}" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div  class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">{{ $fourthCategory->title }} Products</h2>
                <div class="btn-right">
                    <a href="{{ route('product-list', ['slug' => $fourthCategory->slug]) }}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper" >
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/airpods-max_550.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple AirPods Max</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">Cháy hàng</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/apod3.png') }}" alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Airpods 3</a>
                                </h3>
                                <!-- <span class="item-price text-primary">$1100</span> -->
                            </div>
                            <h5 class="item-price text-primary">4.350.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img  src="{{ asset('frontend/images/airpods-pro-2_550.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Airpods PRO 2</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">5.690.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/airpods-2_550.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Apple Airpods 2</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">2.690.000₫</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder" style="background-color: #EDF1F3;
                            border-radius: 10%;">
                                <img src="{{ asset('frontend/images/item_1.png') }}"  alt="product-item" class="img-fluid">
                            </div>
                            {{-- <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div> --}}
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 14 ProMax 128gb</a>
                                </h3>
                            </div>
                            <h5 class="item-price text-primary">28.000.000 ₫</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
{{-- @endforeach --}}

<section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 padding-xlarge" style="background-image: url('{{ asset('frontend/images/single-image1.png') }}');background-position: right; background-repeat: no-repeat;">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium" style="margin-left: 20%;">
                <h3>5% off tất cả các sản phẩm mừng ngày sinh nhật của Store</h3>
                <h2 class="display-2 pb-5 text-uppercase text-dark">Birthday Party</h2>
                <a href="shop" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Sale</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">

        </div>
    </div>
</section>
<section id="latest-blog" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Tin tức công nghệ</h2>
                <div class="btn-right">
                    <a href="{{route('blog')}}" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
                </div>
            </div>
            <div class="post-grid d-flex flex-wrap justify-content-between">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-sm-12">
                        <div class="card border-none me-3">
                            <div class="card-image">
                                <img src="{{$post->photo }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="card-body text-uppercase">
                            <div class="card-meta text-muted">
                                <span class="meta-date">{{$post->created_at->format('d/m/YY') }}</span>
                            </div>
                            <h3 class="card-title">
                                <a href="{{route('blog.detail',$post->slug)}}">{{$post->title }}</a>
                            </h3>
                        </div>
                    </div>
               @endforeach
                
            </div>
        </div>
    </div>
</section>
<section id="testimonials" class="position-relative">
    <div class="container">
        <div class="row">
            <div class="review-content position-relative">
                <div class="swiper-icon swiper-arrow swiper-arrow-prev position-absolute d-flex align-items-center">
                    <svg class="chevron-left">
            <use xlink:href="#chevron-left" />
          </svg>
                </div>
                <div class="swiper testimonial-swiper">
                    <div class="quotation text-center">
                        <svg class="quote">
              <use xlink:href="#quote" />
            </svg>
                    </div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide text-center d-flex justify-content-center">
                            <div class="review-item col-md-10">
                                <i class="icon icon-review"></i>
                                <blockquote>“Tư vấn tận tình, dịch vụ bảo hành cực tốt, giao hàng nhanh, nếu có cơ hội sẽ ủng hộ cửa hàng thêm”</blockquote>
                                <div class="rating">
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-half">
                    <use xlink:href="#star-half"></use>
                  </svg>
                                    <svg class="star star-empty">
                    <use xlink:href="#star-empty"></use>
                  </svg>
                                </div>
                                <div class="author-detail">
                                    <div class="name text-dark text-uppercase pt-2">Nguyễn Hằng</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide text-center d-flex justify-content-center">
                            <div class="review-item col-md-10">
                                <i class="icon icon-review"></i>
                                <blockquote>“Iphone 14 promax vừa mới lên báo mở bán vậy mà mấy hôm sau shop đã bán rồi, tốc độ nhập hàng nhanh nhất Việt Nam”</blockquote>
                                <div class="rating">
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-fill">
                    <use xlink:href="#star-fill"></use>
                  </svg>
                                    <svg class="star star-half">
                    <use xlink:href="#star-half"></use>
                  </svg>
                                    <svg class="star star-empty">
                    <use xlink:href="#star-empty"></use>
                  </svg>
                                </div>
                                <div class="author-detail">
                                    <div class="name text-dark text-uppercase pt-2">Quân Hoàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-icon swiper-arrow swiper-arrow-next position-absolute d-flex align-items-center">
                    <svg class="chevron-right">
            <use xlink:href="#chevron-right" />
          </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</section>
<script>
    function scrollToCategory(slug, event) {
        event.preventDefault();
        var target = document.getElementById(slug);

        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>

{{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection 


