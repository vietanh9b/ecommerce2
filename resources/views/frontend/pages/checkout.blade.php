@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || My Cart')
@section('main-content')
@include('frontend.layouts.header_fe')

@php
$svgContent = file_get_contents(public_path('frontend/svg/cart.svg'));
echo $svgContent;
$user = auth()->user() ?? null;
$listAddress = $user->getAddress();
$addressDefault = $user->getAddressDefault() ?? $listAddress->first();

@endphp

<section class="hero-section position-relative bg-light-blue padding-medium" style="padding-top: 2em;padding-bottom: 2em;">
    <div class="hero-content">
      <div class="container">
        <div class="row">
          <div class="text-center padding-large no-padding-bottom">
            <h1 class="display-2 text-uppercase text-dark">Cart</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="/">Home ></a>
              </span>
              <span class="item">Cart</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="shopify-cart padding-large" style="padding-top: 3em;padding-bottom: 3em;">
    <div class="container">
      <div class="row">
        <div class="cart-table col-lg-8">
          <div class="cart-header">
            <div class="row d-flex text-uppercase">
              <h3 class="cart-title col-lg-5 pb-4">Product</h3>
              <h3 class="cart-title col-lg-3 pb-3">Quantity</h3>
              <h3 class="cart-title col-lg-4 pb-3">Price</h3>
            </div>
          </div>

          <form action="{{route('cart.update')}}" method="POST">
            @csrf
                @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                  <div class="cart-item border-top border-bottom ">
                    <div class="row align-items-center">
                      <div class="col-lg-5 col-md-4">
                        <div class="cart-info d-flex flex-wrap align-items-center mb-4">
                          <div class="col-lg-5">
                            <div class="card-image">
                      <img src="{{$cart->product_attr['photo']}}" alt="product" class="img-fluid">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card-detail ps-3">
                      <h3 class="card-title text-uppercase">
                        @php
                             $productHelper = new \App\Helpers\Backend\ProductHelper();
                             $productName =  $productHelper->convertSlugToTitle($cart->product_attr['sku']);
                             $productPrice =  $productHelper->formatPrice($cart->product_attr->price);
                        @endphp
                                <a href="">{{$productName}}</a>
                              </h3>
                              <div class="card-price">
                        <span class="money text-primary">{{$productPrice}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                      <div class="col-lg-5 col-md-6">
                        <div class="row d-flex">
                          <div class="col-md-6">
                            <div class="qty-field">
                              <div class="qty-number d-flex">
                                  <label class="screen-reader-text" for="quantity_pro"></label>
                                  <input type="number" id="quantity_pro1" class="input-text qty text"  step="1" min="1" max="9999" name="quant[{{$key}}]" value="{{$cart->quantity}}" title="quantity" size="4" pattern="[0-9]*" inputmode="numeric">
                                  <input type="hidden" name="qty_id[]" value="{{$cart->id}}">
                              </div>
                              <div class="regular-price"></div>
                              <div class="quantity-output text-center bg-primary"></div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="total-price">
                              <span class="money text-primary">{{$cart['amount']}} </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-1 col-md-1" style="padding-left: 35px;">
                        <div class="cart-remove">
                          <a href="{{route('cart-delete',$cart->id)}}">
                            <svg class="close" width="28px">
                              <use xlink:href="#close"></use>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
          <div class="cart-totals bg-grey padding-medium">

            <div class="button-wrap">
              <button type="submit" class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Update Cart</button>
              {{-- <button class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none"><a href="{{route('home')}}"> Continue Shopping</a></button> --}}
              <a href="{{route('home')}}" class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none">Continue Shopping</a>

            </div>
          </div>
        </form>
        </div>



        <div class="cart-checkout col-lg-4" style="padding-left: 20px;" >
          <div class="cart-totals bg-grey padding-medium" style="padding-top: 0em; padding-bottom:0em;">
            <h4 class="display-7 text-uppercase text-dark pb-4" style="margin-bottom: 8px;" >CHECK OUT YOUR ORDER</h4>



            <form class="form" method="POST" action="{{route('cart.order')}}">
              @csrf
              <div class="cart-totals bg-grey ">

                <div class="total-price ">
                  <table cellspacing="0" class="table text-uppercase">
                    <tbody>

                      <tr class="order-total pt-2 pb-2 border-bottom">
                        <th>Total:</th>
                        <td data-title="Sub total">
                          <span class="price-amount amount text-primary ps-5">
                            <bdi>
                              <span class="price-currency-symbol" data-price="{{Helper::totalCartPrice()}}">$</span>{{Helper::totalCartPrice()}}</bdi>
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="form-group" style="padding-bottom: 20px">
                <label for="payment-method">Payment Method</label>
                <select id="payment-method" name="payment-method" class="form-control" required>
                  <option value="">Select payment method</option>
                  <option value="credit-card">Cash on Delivery</option>
                  <option value="paypal">VN Pay</option>
                </select>
              </div>

              <div class="form-group contact-info-card">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <span>Contact Info</span>
                      <a href="{{route('profile')}}" class=" change_addressdefault change-link">Change</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 field">
                        <label>{{__('Name')}}</label>
                        <p class="value contact-name contact-name-info" name="name">{{ $addressDefault ? $addressDefault->getAttribute('name') : null }}</p>
                    </div>
                    <div class="col-6 field">
                        <label>{{__('Phone number')}}</label>
                        <p class="contact-phone contact-phone-info" name="phone_number"> {{ $addressDefault ? $addressDefault->phone_number : null }}</p>
                    </div>
                    <div class="col-6 field">
                        <label>{{__('Email')}}</label>
                        <p class="value contact-email-info" name="email">{{ $addressDefault->email  ?? $user->getAttribute('email') }}</p>
                    </div>
                    <div class="col-12 field">
                        <label>{{__('Address')}}</label>
                        <div class="contact-address-info" name="detail_address"><p> {{ $addressDefault ? $addressDefault->detail_address  : null }}</p></div>
                    </div>
                    <div class="col-12 field" style="display:none">
                      <label>{{__('Gender')}}</label>
                      <div class="contact-address-info" name="gender"><p> {{ $addressDefault ? $addressDefault->getAttribute('gender')  : App\Models\CustomerAddress::GENDER_MALE }}</p></div>
                  </div>
                    <div class="row" style="display:none">
                      <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                              <label>{{__('Address ID')}}<span>*</span></label>
                              <input type="text" name="address_id" placeholder=""
                                     class="input-address-id"
                                     value="{{ $addressDefault ? $addressDefault->id : null }}">
                              @error('address_id')
                              <span class='text-danger'>{{$message}}</span>
                              @enderror
                          </div>
                      </div>
                  </div>


                </div>
              </div>

              <button class="btn btn-black btn-medium text-uppercase me-2 mb-3 btn-rounded-none" type="submit">Confirm Order</button>

            </form>
          </div>
          </div>
        </div>

      </div>
    </div>
  </section>

    {{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection
