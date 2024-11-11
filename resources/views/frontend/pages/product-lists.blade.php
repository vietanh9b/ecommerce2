@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || Product')
@section('main-content')
@include('frontend.layouts.header_fe')

  @php
    $svgContent = file_get_contents(public_path('frontend/svg/shop.svg'));
    echo $svgContent;
  @endphp


<section class="hero-section position-relative bg-light-blue padding-medium">
  <div class="hero-content">
      <div class="container">
          <div class="row">
              <div class="text-center padding-large no-padding-bottom">
                  <h1 class="display-2 text-uppercase text-dark">Shop</h1>
                  <div class="breadcrumbs">
                      <span class="item">
            {{-- <a href="index.html">Home ></a> --}}
            Home >
          </span>
                      <span class="item">Shop</span>
                  </div>
              </div>
          </div>
      </div>
  </div>

</section>
<div class="shopify-grid padding-large">
    <div class="container" style="font-size: 16px;margin-bottom: 3%;"  >

       <div class="row">
        @foreach ($childCategories as $childCategory)
            <div class="col-md-auto item-box">
                <div class="title">
                    <a href="{{ route('product-list', ['slug' => $childCategory->slug]) }}" data-slug="{{ $childCategory->slug }}" data-id="{{ $childCategory->id }}" onclick="getProductListByCategory(event)" style="font-size:20px;font-weight:600;text-transform:uppercase">{{ $childCategory->title }}</a>
                </div>
            </div>
        @endforeach
        <div class="input-group">
            <div class="form-outline">
              <input type="search" id="form1" class="form-control" />
            </div>
            <button type="button" class="btn btn-primary" onclick="searchProducts()">
                <i class="fas fa-search"></i>
              </button>
          </div>
    </div>


      </div>
    <form action="{{route('shop.filter')}}" method="POST" class="h-auto">
    @csrf
    <div class="container">
      <div class="row">
          <main class="">
              <div class="product-content product-store d-flex  flex-wrap">
                  </div>
          </main>
      </div>
  </div>
</form>
</div>
@push('after_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function getProductListByCategory(event) {
        event.preventDefault();

        var categoryID = $(event.target).data('id');
        $.ajax({
            url: '{{ route('get-product-list') }}',
            method: 'GET',
            data: { category_id: categoryID },
            success: function(response) {
                if (response.length > 0) {
                    // console.log(3123)
                    var productListHTML = '';
                    $.each(response, function(index, product) {
                        productListHTML += '<div class="col-lg-4 col-md-6">';
                        productListHTML += '<div class="product-card position-relative pe-3 pb-3">';
                        productListHTML += '<a href="' + product.url + '">';
                        productListHTML += '<div class="image-holder">';
                        productListHTML += '<img src="' + product.photo + '" alt="product-item" class="img-fluid">';
                        productListHTML += '</div>';
                        productListHTML += '</a>';
                        productListHTML += '<div class="card-detail d-flex justify-content-between pt-3 " >';
                        productListHTML += '<h3 class="card-title text-uppercase">';
                        productListHTML += '<a href="#">' + product.title + '</a>';
                        productListHTML += '</h3>';

                        productListHTML += '</div>';
                        productListHTML += '<span class="item-price text-primary" style="font-size:19px;">' + product.price + ' ₫</span>';

                        productListHTML += '</div>';
                        productListHTML += '</div>';
                    });
                    $('.product-content').html(productListHTML);
                } else {
                    $('.product-content').html('<h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>');
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function searchProducts() {
  var searchValue = $('#form1').val(); // Lấy giá trị từ ô input search

  $.ajax({
    url: '{{ route('search-products') }}',
    method: 'GET',
    data: { search: searchValue },
    success: function(response) {
      // Xử lý dữ liệu phản hồi từ server
      if (response.length > 0) {
        var productListHTML = '';
        $.each(response, function(index, product) {
            productListHTML += '<div class="col-lg-4 col-md-6">';
            productListHTML += '<div class="product-card position-relative pe-3 pb-3">';
            productListHTML += '<a href="' + product.url + '">';
            productListHTML += '<div class="image-holder">';
            productListHTML += '<img  style="width: 225px" src="' + product.photo + '" alt="product-item" class="img-fluid">';
            productListHTML += '</div>';
            productListHTML += '</a>';
            productListHTML += '<div class="card-detail d-flex justify-content-between pt-3 " >';
            productListHTML += '<h3 class="card-title text-uppercase">';
            productListHTML += '<a href="#">' + product.title + '</a>';
            productListHTML += '</h3>';

            productListHTML += '</div>';
            productListHTML += '<span class="item-price text-primary" style="font-size:19px;">' + product.price + ' ₫</span>';

            productListHTML += '</div>';
            productListHTML += '</div>';
        });
        $('.product-content').html(productListHTML);
      } else {
        $('.product-content').html('<h4 class="text-warning" style="margin:100px auto;">No products found.</h4>');
      }
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}

</script>


@endpush

