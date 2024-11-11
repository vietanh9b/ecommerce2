@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || About Us')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/aboutus.svg'));
    echo $svgContent;
  @endphp

{{-- Banner --}}
<section class="hero-section position-relative bg-light-blue padding-medium">
    <div class="hero-content">
        <div class="container">
            <div class="row">
                <div class="text-center padding-large no-padding-bottom">
                    <h1 class="display-2 text-uppercase text-dark">About Us</h1>
                    <div class="breadcrumbs">
                      
                        <span class="item">DT Group là đơn vị số 1 trong nước tạo nên những trải nghiệm tuyệt vời cho quá trình mua sắm các loại mặt hàng trên nền tảng thương mại điện tử tại Việt Nam. 
                            Vào năm 2023, nhận thấy số lượng người ở Việt Nam sử dụng các sản phẩm công nghệ của Apple chiếm thị phần lớn nhất so với các hãng khác.
                            Chúng tôi quyết định tách riêng mảng sản phẩm công nghệ Apple để lập ra sàn thương mại điện tử chuyên bán các đồ công nghệ mới nhất Apple.
                             Sau khi đã kết nối và kí kết hợp đồng, chúng tôi trở thành đối tác ủy quyền tin cậy của hãng công nghệ uy tín hàng đầu trên thế giới đó chính là Apple.
                            Từ đó MiniStore chính thức được ra mắt.
                             </span>
                    </div>
                </div>
            </div>
        </div>
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

<section id="about-us" class="padding-large no-padding-top">
    <div class="container">
        <div class="row d-flex flex-wrap align-items-center justify-content-between">
            <div class="col-lg-6 col-md-12">
                <div class="image-holder mb-4">
                    <div>
                        <img src="{{ asset('frontend/images/single-image3.jpg') }}" alt="single" class="single-image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-left: 30px;">
                <div class="detail " style="padding-left: 10rem;">
                    <div class="display-header">
                        <h2 class="display-7 text-uppercase text-dark">Chính sách bảo hành của chúng tôi</h2>
                        <ul> <strong style="font-size: 20px;"> 1. Chính sách bảo hành tiêu chuẩn Apple: </strong>
                            <li style="font-size: 15px;">Tuân theo điều khoản bảo hành của Apple, áp dụng từ thời điểm xuất hóa đơn cho khách hàng</li>
                            <li style="font-size: 15px;">Link tham khảo chính sách tại Apple => <a style="color:#007edb" href="https://www.apple.com/legal/warranty/products/ios%E2%80%93of-apac-vietnamese.html">Link&nbsp;</a> </li>
                        </ul>
                    </div>
                    <div class="display-header">

                        <ul> <strong style="font-size: 20px;"> 2. Trong trường hợp sản phẩm gặp sự cố, khách hàng có thể xử lý: </strong>
                            <li style="font-size: 15px;">Cách 1: Khách hàng liên hệ và bảo hành máy tại các Trung tâm bảo hành uỷ quyền của Apple tại Việt Nam </li>
                            <li style="font-size: 15px;">
                                <span style="font-size: 15px;">Cách 2: </span>
                                <ul>
                                    <li style="font-size: 15px;"> Liên hệ với MiniStore (hotline CSKH: 1999.9999)</li>
                                    <li style="font-size: 15px;">MiniStore tiếp nhận và gửi máy tới Trung tâm bảo hành uỷ quyền của Apple tại Việt Nam để giám định và thông qua báo kết quả, phương thức xử lý từ Apple cho khách </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section id="our-store" class="padding-large no-padding-top">
    <div class="container">
        <div class="row d-flex flex-wrap align-items-center">
            <div class="col-lg-6">
                <div class="image-holder mb-5">
                    <img src="{{ asset('frontend/images/single-image2.jpg') }}" alt="our-store" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="locations-wrap">
                    <div class="display-header">
                        <h2 class="display-7 text-uppercase text-dark">Contact Us</h2>
                        <p>Bạn có thể liên lạc với chúng tôi</p>
                    </div>
                    <div class="location-content d-flex flex-wrap">
                        <div class="col-lg-6 col-sm-12">
                            <div class="content-box text-dark pe-4 mb-5">
                                <h3 class="card-title text-uppercase text-decoration-underline">Office</h3>
                                <div class="contact-address pt-3">
                                    <p>55 Giải Phóng, Quận Hai Bà Trưng, Thành phố Hà Nội, Việt Nam </p>
                                </div>
                                <div class="contact-number">
                                    <p>
                                        <a href="#">+123 987 789</a>
                                    </p>
                                    <p>
                                        <a href="#">+123 123 321</a>
                                    </p>
                                </div>
                                <div class="email-address">
                                    <p>
                                        <a href="#">ministore@yourinfo.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="content-box">
                                <h3 class="card-title text-uppercase text-decoration-underline">Việt Nam </h3>
                                <div class="contact-address pt-3">
                                    <p>55 Giải Phóng, Quận Hai Bà Trưng, Thành phố Hà Nội, Việt Nam</p>
                                </div>
                                <div class="contact-number">
                                    <p>
                                        <a href="#">+123 987 789</a>
                                    </p>
                                    <p>
                                        <a href="#">+123 123 321</a>
                                    </p>
                                </div>
                                <div class="email-address">
                                    <p>
                                        <a href="#">ministore@yourinfo.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection 


