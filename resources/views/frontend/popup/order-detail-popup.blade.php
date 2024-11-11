  
@php
$user = auth()->user() ?? null;
$listAddress = $user->getAddress();
$defaultAddress =$user->getAddressDefault() ?? $listAddress->first();

@endphp
  <div class="modal fade bd-example-modal-xl" id="orderDetailModal " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:1px;">
          <h3 class="modal-title" id="exampleModalCenterTitle">Order Information</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  
        <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <p class="title"><strong>Order ID:</strong> 
                        <span class="order_number"></span>
                    </p>
                    <p class="title"><strong>Delivery date:</strong> 
                        <span class="delivery_date"></span>
                    </p>
                    <p class="title"><strong>Status:</strong> 
                        <span class="status"></span>
                    </p>
                    <hr>
                    <p class="title"><strong>Contact Info</strong> </p>
                    <p class="subtitle"><strong>Name:</strong> 
                        <span class="name">{{$order->name}}</span>
                    </p>
                    <p class="subtitle"><strong>Email:</strong>
                         <span class="email"></span>
                        </p>
                    <p class="subtitle"><strong>Phone:</strong> 
                        <span class="phone"></span>
                    </p>
                  </div>

                  <div class="col">
                    {{-- <p class="title"><strong>Order Item:</strong> </p>
                    <div id="order_product">
                          <p class="order-item">
                            <span>iphone 14 pro</span>
                        </p>
                    </div> --}}
                    <div class="row">
                      <div class="col-8">
                        <p class="title"><strong>Order Item:</strong> </p>
                         <div id="order_product">
                          <p class="order-item">
                            <span>iphone 14 pro</span>
                        </p>
                        </div>
                      </div>

                      <div class="col-4">
                        <p class="title"><strong>Quantity:</strong></p>
                          <div id="order_product_quantity">
                           <p class="order-item-quantity">
                             <span>100 </span>
                           </p>
                         </div>
                      </div>
                    </div>
                  </div>


                </div>
      

                <hr>
      
                <div class="row">
                  <div class="col">
                    <p class="title"><strong>Payment Method:</strong> 
                        <span class="payment_method">{{$order->payment_method}}</span>
                    </p>
                  </div>
                  <div class="col">
                    <p class="title"><strong>Shipping Address:</strong>
                        <span class="detail_address">{{$order->detail_address}}</span>
                    </p>
                    
                  </div>
                </div>
              </div>
        </div>
  
        <div class="modal-footer" style="border:0px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  