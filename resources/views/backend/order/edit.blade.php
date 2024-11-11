@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
    <div class="card">
        <h5 class="card-header">{{__('Order Edit')}}</h5>
        <div class="card-body">
            <form action="{{route('order.update',$order->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <div>
                        <label for="status">{{__('Status :')}}</label>
                        <select name="status" id="order_status" class="form-control">
                            <option
                                value="new" {{($order->status=='delivered' || $order->status=="process" || $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='new')? 'selected' : '')}}>{{__('New')}}</option>
                            <option
                                value="process" {{($order->status=='delivered'|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='process')? 'selected' : '')}}>{{__('Process')}}</option>
                            <option
                                value="delivered" {{($order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='delivered')? 'selected' : '')}}>{{__('Delivered')}}</option>
                            <option
                                value="cancel" {{($order->status=='delivered') ? 'disabled' : ''}}  {{(($order->status=='cancel')? 'selected' : '')}}>{{__('Cancel')}}</option>
                        </select>
                    </div>
                    <div class="delivery-date" style="display:none">
                        <label for="delivery_date">{{__('Delivery date:')}}</label>
                        <input name="delivery_date" value="{{$order->delivery_date}}" type="date" class="form-control">
                    </div>
                    @if(!empty($orderReceipt))
                    <input type="hidden" value="{{$orderReceipt}}" name="order_receipt">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
            </form>
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
        .delivery-date {
            margin-top: 16px;
            display: none;
        }
        .delivery-date input {
            width:unset;
        }
    </style>
@endpush
@push('after_scripts')
    <script>
        $('.wgt-collapse').click(function () {
            var elementId = $(this).attr('data-target');
            if (elementId && typeof elementId != 'undefined') {
                $(elementId).collapse('toggle');
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            var order_status =  document.getElementById("order_status").value
            if(order_status == 'delivered') {
                $('.delivery-date').css("display", "block")
            }
        });
        $('#order_status').change(function() {
            if(this.value == 'delivered') {
                $('.delivery-date').css("display", "block")
            } else {
                $('.delivery-date').css("display", "none")
            }
        });
    </script>
@endpush

 