@extends('backend.layouts.master')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Users List</h6>
            <a href="{{route('users.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
               data-placement="bottom" title="Add User">
                <i class="fas fa-plus"></i>{{ __('Add User') }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="user-dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ __("ID") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Email") }}</th>
                        <th>{{ __("Role") }}</th>
                        <th>{{ __("Status") }}</th>
                        <th>{{ __("Action") }}</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>{{ __("ID") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Email") }}</th>
                        <th>{{ __("Role") }}</th>
                        <th>{{ __("Status") }}</th>
                        <th>{{ __("Action") }}</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                @if($user->status=='active')
                                    <span class="badge badge-success">{{$user->status}}</span>
                                @else
                                    <span class="badge badge-warning">{{$user->status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}"
                                   class="btn btn-primary btn-sm float-left mr-1"
                                   style="height:30px; width:30px;border-radius:50%"
                                   data-toggle="tooltip"
                                   title="edit" data-placement="bottom">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{route('users.destroy',[$user->id])}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id="{{$user->id}}"
                                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                            data-placement="bottom" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

    <script>
        $('#user-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [4, 5]
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
                var form = $(this).closest('form'),
                    dataID = $(this).data('id');
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
            })
        })

    </script>
@endpush
