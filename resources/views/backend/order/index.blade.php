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
            <h6 class="m-0 font-weight-bold text-primary float-left">{{__('Order Lists')}}</h6>
            <div class="float-right">
                <form action="{{ Request::is('admin/order') ? route('order.index') : route('order.receipt.index') }}" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="start_date">{{__('Start Date')}}:</label>
                        <input type="date" class="form-control mx-sm-2" id="start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="end_date">{{__('End Date')}}:</label>
                        <input type="date" class="form-control mx-sm-2" id="end_date" name="end_date">
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Filter')}}</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($orders)>0)
                    <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Order No.')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Detail Address')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Delivery date')}}</th>
                            <th>{{__('Total Amount')}} </th>
                            <th>{{__('Payment Method')}} </th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Order No.')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Detail Address')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Delivery date')}}</th>
                            <th>{{__('Total Amount')}}</th>
                            <th>{{__('Payment Method')}} </th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $order)
                            {{-- @php
                                $shipping_charge = DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                            @endphp --}}
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->name}} </td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->detail_address}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{date_format($order->created_at, "Y/m/d")}}</td>
                                <td>{{ $order->delivery_date ? \Illuminate\Support\Carbon::parse($order->delivery_date)->format("Y/m/d") : '' }}</td>
                                <td>{{number_format($order->total_amount,2)}} vnd</td>
                                <td>{{$order->payment_method}}</td>
                                <td>
                                    @if($order->status=='new')
                                        <span class="badge badge-primary">{{$order->status}}</span>
                                    @elseif($order->status=='process')
                                        <span class="badge badge-warning">{{$order->status}}</span>
                                    @elseif($order->status=='delivered')
                                        <span class="badge badge-success">{{$order->status}}</span>
                                    @else
                                        <span class="badge badge-danger">{{$order->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($orderReceipt))
                                        <a href="{{route('order.show',$order->id)}}"
                                           class="btn btn-warning btn-sm float-left mr-1"
                                           style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                           title="view" data-placement="bottom"><i class="fas fa-eye wgt-order-show"></i></a>
                                    @else
                                        <a href="{{route('order.receipt.show',$order->id)}}"
                                           class="btn btn-warning btn-sm float-left mr-1"
                                           style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                           title="view" data-placement="bottom"><i class="fas fa-eye wgt-order-show"></i></a>
                                    @endif
                                    @php
                                        $destroyUrl = route('order.destroy',[$order->id]);
                                        if(!empty($orderReceipt)) {
                                            $destroyUrl = route('order.receipt.destroy',[$order->id]);
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="total-amount float-right">Total Amount: {{ number_format($totalAmount, 2) }} vnd</div> --}}
                    <div class="total-amount float-right" style="border: 2px solid ; padding: 10px; background-color: #e3e6f0; font-weight: bold;text-transform:uppercase;">
                        Total Amount: {{ number_format($totalAmount, 2) }} vnđ
                    </div>


{{--                    <span style="float:right">{{$orders->links()}}</span>--}}
                @else
                    <h6 class="text-center">{{__('No orders found!!! Please order some products')}}</h6>
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
    <script>

        $('#order-dataTable').dataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [9]
                }
            ],
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
                // alert(dataID);
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
