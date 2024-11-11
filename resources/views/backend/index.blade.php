@extends('backend.layouts.master')
@section('title', env('APP_NAME') . ' || DASHBOARD')
@section('main-content')
    {{-- <div class="container-fluid"> --}}
    @include('backend.layouts.notification')
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Category -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a class="card border-left-primary shadow h-100 py-2" href="#">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('Category') }}</div>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"></div> -->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Products -->   
            <!-- Content Row -->
        </div>
        <div class="col-xl-9 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistic</h6>
                </div>
                <div class="card-body">
                    <canvas id="chart_statistic"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Best-selling Products</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Lợi nhuận thu về</th>
                            
                          </tr>
                        </thead>
            
                        <tbody>
                          @foreach($products as $product)
                          @php
                            $attribute = new \App\Models\Attribute;
                            $productHelper = new \App\Helpers\Backend\ProductHelper();
                            $attrSku = $attribute->getSku($product['product_id']);
                            $productName =  $productHelper->convertSlugToTitle($attrSku);
                             @endphp 
                            <tr>
                                <th scope="row">
                                    <a href="#">{{$productName}}</a>
                                </th>
                                <td>{{$product['total_quantity']}}</td>
                                <td>{{$product['total_amount']}} VNĐ</td>  
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
         var labels = {!! json_encode($labels) !!};
    var revenues = {!! json_encode($revenues) !!};
    var quantities = {!! json_encode($quantities) !!};

    var ctx = document.getElementById('chart_statistic').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Revenue',
                    data: revenues,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                },
                {
                    label: 'Quantity',
                    data: quantities,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount'
                    }
                }
            }
        }
    });
    </script>
@endsection
