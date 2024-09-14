@extends('client.layouts.master')
@section('content')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$product->name}}</strong></div>
      </div>
    </div>
  </div>  

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="{{asset(Storage::url($product->img_thumbnail))}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6">
          <h2 class="text-black">{{$product->name}}</h2>
          <p>{{$product->description}}</p>
          <p class="mb-4">{!!$product->content!!}</p>
          <p><strong class="text-primary h4">{{$product->price_sale}}đ</strong></p>
          {{-- form --}}
          <form action="{{ route('client.cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="color_id" value="">
            <input type="hidden" name="size_id" value="">
        
            <div id="variants">
                <h3>Variants:</h3>
                <div class="variant">
                    <label for="color">Color:</label>
                    <select name="color_id" required>
                        @foreach($product->variants->pluck('color')->unique('id') as $color)
                            <option value="{{ $color->id }}" style="color: {{ $color->name }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
        
                    <label for="size">Size:</label>
                    <select name="size_id" required>
                        @foreach($product->variants->pluck('size')->unique('id') as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            <div class="mb-5">
                <div class="input-group mb-3" style="max-width: 120px;">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                    </div>
                    <input type="number" name="quantity" class="form-control text-center" value="1" min="1">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                    </div>
                </div>
            </div>
            <p><button type="submit" class="buy-now btn btn-sm btn-primary">Add To Cart</button></p>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 site-section-heading text-center pt-4">
          <h2>Featured Products</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="nonloop-block-3 owl-carousel">
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">Tank Top</a></h3>
                  <p class="mb-0">Finding perfect t-shirt</p>
                  <p class="text-primary font-weight-bold">$50</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">Corater</a></h3>
                  <p class="mb-0">Finding perfect products</p>
                  <p class="text-primary font-weight-bold">$50</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">Polo Shirt</a></h3>
                  <p class="mb-0">Finding perfect products</p>
                  <p class="text-primary font-weight-bold">$50</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">T-Shirt Mockup</a></h3>
                  <p class="mb-0">Finding perfect products</p>
                  <p class="text-primary font-weight-bold">$50</p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="block-4 text-center">
                <figure class="block-4-image">
                  <img src="images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="#">Corater</a></h3>
                  <p class="mb-0">Finding perfect products</p>
                  <p class="text-primary font-weight-bold">$50</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
