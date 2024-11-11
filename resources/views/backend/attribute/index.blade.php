@extends('backend.layouts.master')

@section('main-content')
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">{{__('Category Lists')}}</h6>
            <a href="{{route('attribute.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
               data-placement="bottom" title="{{__('Add Attribute')}}"><i class="fas fa-plus"></i>{{__(' Add Attribute')}}
            </a>
        </div>
      
        <div class="card-body">
            <div class="table-responsive">
                @if(count($attributes)>0)
                    <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Action')}}</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Action')}}</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($attributes as $attribute)
                            <tr>
                                <td>{{$attribute->id}}</td>
                                <td>{{$attribute->name}}</td>   
                                <td>
                                    <a href="{{route('attribute.edit',$attribute->id)}}"
                                       class="btn btn-primary btn-sm float-left mr-1"
                                       style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                       title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{route('attribute.destroy',[$attribute->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn"
                                                data-id="{{$attribute->id}}"
                                                style="height:30px;width:30px;border-radius:50%"
                                                data-toggle="tooltip"
                                                data-placement="bottom" title="{{__('Delete')}}">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>                             
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h6 class="text-center">{{__('No Attributes found!!! Please create Attribute')}}</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
@endpush
@push('after_scripts')
    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script src="{{ mix('/js/backend/storeView.js') }}"></script>
    <script>
        $('#banner-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [3, 4]
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
                var dataID = $(this).data('id');
                e.preventDefault();
                swal({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('Once deleted, you will not be able to recover this data!')}}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
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