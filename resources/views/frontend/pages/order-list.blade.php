<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h5>My Ordered</h5>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter orders
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="updateFilter('All orders')">All orders</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('New')">New</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('Process')">Process</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('Delivered')">Delivered</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('Cancel')">Cancel</a>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-hover" id="orderTable">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Address</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderList as $order)
                        @php
                        
                            $detail_address = $order->detail_address ?? '';

                        @endphp
            <tr data-status="{{ $order->status }}">
                {{-- <th scope="row"><a href="#">3456789JQK</a></th> --}}
                <th scope="row"><a href="#" class="order-detail-link" data-order-id="{{ $order->id }}" data-toggle="modal" data-target=".bd-example-modal-xl"> {{ $order->order_number }}</a></th>
                @include('frontend.popup.order-detail-popup')

                <td>{{ $detail_address }}</td>
                <td>{{$order->quantity}}</td>
                {{-- <td>
                    <span class="status-complete">{{$order->status}}</span>
                </td> --}}
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
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@push('after_scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>   

@endpush
