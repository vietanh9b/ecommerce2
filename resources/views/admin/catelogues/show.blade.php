@extends('admin.layout.master')
@section('title')
    This page is list catelogues
@endsection
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Datatables</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Datatables</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Catelogue</h5>
                <button class="btn btn-success"><a class=" text-light" href="{{route('admin.catelogues.index')}}">Back</a></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </th>
                    <th>Name</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr scope="row">
                    <td scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </td>
                    <td>Name</td>
                    <td>{{$data->name}}</td>
                </tr>
                <tr scope="row">
                    <td scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </td>
                    <td>Image</td>
                    <td>
                        <img src="{{asset(Storage::url($data->cover))}}" alt="" width="50px">
                    </td>
                </tr>
                <tr  scope="row">
                    <td scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </td>
                    <td>Is active</td>
                    <td>{!!$data->is_active
                        ?'<div class="badge bg-success">Yes</div>'
                        :'<div class="badge bg-danger">No</div>'
                !!}</td>
                </tr>
                <tr scope="row">
                    <td scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </td>
                    <td>Updated at</td>
                    <td>{{date('Y-m-d',strtotime($data->updated_at))}}</td>
                </tr>
                <tr  scope="row">
                    <td scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                        </div>
                    </td>
                    <td>Created at</td>
                    <td>{{date('Y-m-d',strtotime($data->created_at))}}</td>
                </tr>
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