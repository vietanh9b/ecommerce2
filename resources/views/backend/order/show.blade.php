@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <h5 class="card-header">{{ __('Order') }}</h5>
        <div class="card-body">
            @if($order)
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>{{ __("S.N.") }}</th>
                        <th>{{ __("Order No.") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Email") }}</th>
                        <th>{{ __("Quantity") }}</th>
                        <th>{{ __("Total Amount") }}</th>
                        <th>{{ __("Status") }}</th>
                        <th>{{ __("Action") }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_number}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>${{number_format($order->total_amount,2)}}</td>
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
                            <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1"
                               style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                               data-placement="bottom"><i class="fas fa-edit"></i></a>
                            {{-- @else
                                <a href="{{route('order.receipt.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1"
                                   style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                                   data-placement="bottom"><i class="fas fa-edit"></i></a> --}}
                            @endif
                            @php
                                $destroyUrl = route('order.destroy',[$order->id]);
                                if(!empty($orderReceipt)) {
                                    $destroyUrl = route('order.receipt.destroy',[$order->id]);
                                }
                            @endphp
                        </td>
                    </tr>
                    </tbody>
                </table>

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-lx-4"  style="background-color: rgba(0, 0, 0, .05);flex: 0 0 49%;  ">
                                <div class="order-info">
                                    <h4 class="text-center pb-4">{{ __('ORDER INFORMATION') }}</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>{{ __('Order Number') }}</td>
                                            <td> : {{$order->order_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Order Date') }}</td>
                                            <td> : {{$order->created_at->format('D d M, Y')}}
                                                at {{$order->created_at->format('g : i a')}} </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Quantity') }}</td>
                                            <td> : {{$order->quantity}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Order Status') }}</td>
                                            <td> : {{$order->status}} in ({{$order->delivery_date ?? ''}}) </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Total Amount') }}</td>
                                            <td> : $ {{number_format($order->total_amount,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Payment Method') }}</td>
                                            <td>: {{ __('Cash on Delivery') }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Order Remark') }}</td>
                                            <td>: {{ $order->getAttribute('remark') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lx-4"  style="background-color: rgba(0, 0, 0, .05);flex: 0 0 49%;">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4">{{ __("CUSTOMER INFORMATION") }}</h4>
                                    <table class="table">
                                        <tr>
                                            <td>{{ __('First Name') }}</td>
                                            <td> : {{$order->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Last Name') }}</td>
                                            <td> : {{$order->last_name}}</td>
                                        </tr>
                                        @if($order->gender)
                                            <tr>
                                                <td>{{ __('Gender') }}</td>
                                                @if($order->gender == \App\Models\CustomerAddress::GENDER_MALE)
                                                    <td> : {{ __('Male') }}</td>
                                                @else
                                                    <td> : {{ __('Female') }}</td>
                                                @endif
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>{{ __('Email') }}</td>
                                            <td> : {{$order->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Company name') }}</td>
                                            <td> : {{$order->company_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Phone No.') }}</td>
                                            <td> : {{$order->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("Address") }}</td>
                                            <td> : {{$order->address1}}, {{$order->address2}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @include('backend.order.show.order-items')
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info, .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4, .shipping-info h4 {
            text-decoration: underline;
        }

    </style>
@endpush
@push('after_scripts')
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

