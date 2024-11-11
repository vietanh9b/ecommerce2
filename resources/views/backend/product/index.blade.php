@extends('backend.layouts.master')
<?php
// $helper = new \App\Helpers\Backend\CategoryHelper();
// $productHelper = new \App\Helpers\Backend\ProductHelper()
?>
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">{{__('Product List')}}</h6>
            <a href="{{route('product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
               data-placement="bottom" title="{{__('Add Product')}}"><i class="fas fa-plus"></i>{{__(' Add Product')}}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($products)>0)
                    <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Photo')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Photo')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->title}}</td>
                                <?php
                                    //  $parentCategory = $productHelper->getCurrentParentCategoryStoreView($product);
                                    // $subParentCategory = $productHelper->getCurrentSubParentCategoryStoreView($product);
                                ?>
                                    <td>{{$product->category->title ?? ''}}
                                        <sub>
                                            {{$product->category->title ?? ''}}
                                        </sub>
                                    </td>
                                <td>{{$product->price}}</td>
                        
                                <td>
                                    @if($product->photo)
                                        @php
                                            $photo=explode(',',$product->photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px"
                                             alt="{{$product->photo}}">
                                    @else
                                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid"
                                             style="max-width:80px" alt="avatar.png">
                                    @endif
                                </td>
                                <td>
                                    @if($product->status=='active')
                                        <span class="badge badge-success">{{$product->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$product->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('product.edit',[$product->id])}}"
                                       class="btn btn-primary btn-sm float-left mr-1"
                                       style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                       title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{route('product.destroy',[$product->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn"
                                                data-id="#"
                                                style="height:30px; width:30px;border-radius:50%"
                                                data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h6 class="text-center">{{__('No Products found!!! Please create Product')}}</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: inline-block;
            float: right;
        }

        .zoom {
            transition: transform .2s; /* Animation */
        }

        .zoom:hover {
            transform: scale(5);
        }
    </style>
@endpush

@push('after_scripts')

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>

        $('#product-dataTable').dataTable({
            "scrollX": false,
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [7, 9]
                }
            ]
        });
        function deleteData(id) {
        }

    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function (e) {
                var form = $(this).closest('form');
                e.preventDefault();
                swal({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('Once deleted, you will not be able to recover this data!')}}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("{{__('Your data is safe!')}}");
                        }
                    });
            })
        })
    </script>
@endpush
