{{-- 
extend
section
--}}
@extends('admin.layout.master')
@section('title')
    This page is list products
@endsection
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Products</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary"><a href="{{route('admin.products.create')}}" class="text-light text-decoration-none">Add products</a></button>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button class="btn btn-warning"><a href="{{route('admin.catelogues.trash')}}">List trash</a></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Catelogue</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Price sale</th>
                    <th>Views</th>
                    <th>Is active</th>
                    <th>Is hot deal</th>
                    <th>Is good deal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr scope="row">
                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                        </div>
                    </th>
                    <td>{{$item->id}}</td>
                    <td>{{substr($item->name,0,16)}}</td>
                    <td>{{$item->Catelogue->name}}</td>
                    <td>
                        <img src="{{asset(Storage::url($item->img_thumbnail))}}" alt="" width="100px">
                    </td>
                    <td>{{$item->price_regular}}đ</td>
                    <td>{{$item->price_sale}}đ</td>
                    <td>{{$item->views}}</td>
                    <td>
                        @if ($item->is_active)
                            <div class="badge bg-success">Active</div>
                        @endif
                    </td>
                    <td>
                        @if ($item->is_hot_deal)
                            <div class="badge bg-success">Hot deal</div>
                        @else
                            <div class="badge bg-danger">No hot deal</div>
                        @endif
                    </td>
                    <td>
                        @if ($item->is_good_deal)
                            <div class="badge bg-success">Good deal</div>
                        @else
                            <div class="badge bg-danger">No good deal</div>
                        @endif
                    </td>
                    
                    <td class="w-100">
                        <button class="btn btn-info inline-block"><a class=" text-light" href="{{route('admin.products.edit',$item->id)}}">Edit</a></button>
                        <form action="{{route('admin.products.destroy',$item->id)}}" method="POST" class="inline-block">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger inline-block text-light" onclick="return confirm('Bạn có muốn xóa không?')">Delete</button>
                        </form>
                        <button class="btn btn-success inline-block"><a class=" text-light" href="{{route('admin.catelogues.show',$item->id)}}">Show</a></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection
@section('style-libs')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">    
@endsection
@section('script-libs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
    new DataTable("#example")
</script>
@endsection