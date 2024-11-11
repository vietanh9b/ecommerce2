<?php
$orderItems = $order->cart_info ?? [];
$productHelper = new \App\Helpers\Backend\ProductHelper();
    ?>
@if(!empty($orderItems))
    <section class="confirmation_part section_padding" style="margin-top: 20px">
        <div class="order_boxes">
            <div class="row">
                <div class="col-lg-6 col-lx-6 " style="background-color: rgba(0, 0, 0, .05);flex: 0 0 49%;">
                    <div class="oder-items-info order-info">
                        <h4 class="text-center pb-4">{{ __("ORDER ITEMS INFORMATION") }}</h4>
                        <table class="table">
                            @foreach($orderItems as $orderItem)
                                @php
                                    $skuProduct =  $orderItem->product_attr['sku'] ?? '';
                                    $titleProduct = $productHelper->convertSlugToTitle($skuProduct);
                                    $productId = $orderItem->product_attr['product_id'];
                                @endphp
                                <tr>
                                    <td>{{__('Item') }}</td>
                                    <td>
                                        <p class="name_product"><a
                                                href="{{route('product.edit', $productId)}}"
                                                target="_blank">{{ $titleProduct ?? ''}}</a>
                                        </p>
                                    </td>
                                    <td>{{__('Quantity')}}</td>
                                    <td>{{ $orderItem->quantity ?? ''}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                @if(!empty($order->time) || !empty($order->photo))
                    <div class="col-lg-6 col-lx-4">
                        <div class="shipping-info">
                            <h4 class="text-center pb-4">{{ __("ORDER DELIVERED INFORMATION") }}</h4>
                            <table class="table">
                                <tr>
                                    @if(!empty($order->time))
                                        <td>{{__('Time delivered : ') }}</td>
                                        <td>
                                            <p>{{$order->time}}</p>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{__('Image:')}}</td>
                                    @if(!empty($order->photo))
                                        <td>
                                            <img src="{{$order->photo}}" class="img-fluid zoom"
                                                 alt="{{$order->photo}}" style="max-width: 200px; max-height: 200px" >
                                        </td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
