<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Attribute;
use App\Helpers\Backend\ProductHelper;
use App\Models\CustomerAddress;
use \Illuminate\Support\Str;
use \Carbon\Carbon;
use \App\Helpers\Api\DeliveryHelper;
use App\Helpers\Api\CartHelper;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        $query = Order::orderBy('id', 'DESC')->where('status', '<>', 'delivered');

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $orders = $query->get();
        $totalAmount = $orders->sum('total_amount');

        if (!$start_date && !$end_date) {
            $totalAmount = Order::where('status', '<>', 'delivered')->sum('total_amount');
        }

        return view('backend.order.index')
            ->with('orders', $orders)
            ->with('totalAmount', $totalAmount);
    }

    

    public function store(Request $request)
    {
        try {
            $validate = $this->validate($request, [
                'address_id' => 'required',
            ]);
            if (!$validate) {
                throw new \Exception(__('Something went wrong, the address not found with customer'));
            }
            $currentUserId = auth()->user()->id ?? '';
            $addressId = $request->get('address_id');
            if (empty($currentUserId)) {
                throw new \Exception(__('Not found customer'));
            }
            if (empty(Cart::where('user_id', $currentUserId)->where('order_id', null)->first())) {
                throw new \Exception(__('Cart is empty'));
            }
            $order = new Order();
            $this->checkAvailableToContinueProcess($currentUserId);
            $orderData = $this->prepareDataForOrder($currentUserId, $addressId);
            // $orderData['remark'] = $request->get('remark');
            $order->fill($orderData);
            $order->save();

            session()->forget('cart');
            Cart::where('user_id', $currentUserId)->where('order_id', null)->update(['order_id' => $order->id]);

            return redirect()->route('checkout.success');
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
            return back();
        }
    }

    public function checkAvailableToContinueProcess($currentUserId, $orderId = null) {
        $allCartItem = Cart::where('user_id', $currentUserId)->where('order_id', $orderId)->get();
        $productHelper = new ProductHelper();
        if ($allCartItem->count() <= 0) {
            throw new \Exception(__('No cart item available'));
        }
        foreach ($allCartItem as $item) {
            $productId = $item->getAttribute('product_id');
            $product = Attribute::where('id', $productId)->first();
            if (empty($product)) {
                throw new \Exception(__('Product not found'));
            }
            $currentStock = $product->getAttribute('stock');
            $currentCartQty = $item->getAttribute('quantity');
            $productSlug = $product->sku ?? '';
            $productName =  $productHelper->convertSlugToTitle($productSlug);
            
            if (empty($currentStock) || $currentStock - $currentCartQty < 0) {
                throw new \Exception(__('The quantity with '. $productName . 'is not enough to continue process'));
            }
        }
    }

    public function prepareDataForOrder($userId, $addressId)
    {
        $shippingAddress = $this->prepareShippingAddress($userId, $addressId);
        $orderData['name'] = $shippingAddress->getAttribute('name');
        $orderData['email'] = $shippingAddress->getAttribute('email');
        $orderData['phone'] = $shippingAddress->getAttribute('phone_number');
        $orderData['detail_address'] = $shippingAddress->getAttribute('detail_address');
        $orderData['order_number'] = 'ORD-' . strtoupper(Str::random(10));
        $orderData['user_id'] = $userId;
        $orderData['sub_total'] = $this->getTotalCartPrice($userId);
        $orderData['quantity'] = $this->countQuantityInCart($userId);
        $orderData['total_amount'] = $this->getTotalCartPrice($userId);
        // Set Status order with delivery time setting
        $status = $this->prepareStatusOrder();

        $orderData['status'] = $status; //to do
        $orderData['payment_method'] = 'cod'; // to do
        $orderData['payment_status'] = 'Unpaid'; // to do

        return $orderData;
    }
    

    public function getTotalCartPrice($userId)
    {
        return Cart::where('user_id', $userId)->where('order_id', null)->sum('amount');
    }


    public function countQuantityInCart($userId)
    {
        return Cart::where('user_id', $userId)->where('order_id', null)->sum('quantity');
    }

    private function prepareStatusOrder() {

        $timeCreateOrder = Carbon::now();
        $status = DeliveryHelper::STATUS_NEW_ORDER;

        return $status;


    }

    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('backend.order.show')->with('order', $order);
        }
        request()->session()->flash('error', 'Order does not exist');
        return redirect()->back();
    }


    public function prepareShippingAddress($userId, $addressId)
    {
        $customerAddress = CustomerAddress::where('user_id', $userId)
            ->where('id', $addressId)
            ->first();
        if (empty($customerAddress)) {
            return null;
        }
        return $customerAddress;
    }
    
    public function showOrderReceipt($id)
    {
        $order = Order::find($id);

        if ($order) {
            return view('backend.order.show')->with('order', $order)->with('orderReceipt', Order::ORDER_RECEIPT);
        }

        request()->session()->flash('error', 'Order does not exist');

        return redirect()->back();
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('backend.order.edit')->with('order', $order);
    }


    public function update(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            $this->validate($request, [
                'status' => 'required|in:new,process,delivered,cancel',
            ]);
            if (!empty($request->status) && $request->status == 'delivered' && !empty($request->delivery_date)) {
                $this->validate($request, [
                    'delivery_date' => 'required|date'
                ]);
            }
            $data = $request->all();
            $userId = $order->getAttribute('user_id');
            $helper = new \App\Helpers\Api\CartHelper();
            $helper->checkAvailableToContinueProcess($userId, $id);

            if ($request->get('status') == 'delivered') {
                foreach ($order->cart as $cart) {
                    $product = $cart->product_attr;
                    $product->stock -= $cart->quantity;
                    $product->save();
                }
            }
            $data['delivery_date'] = $request->get('delivery_date');
            $order->fill($data)->save();
            request()->session()->flash('success', __('Successfully updated order'));

        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
        }

        if($request->order_receipt) {
            return redirect()->route('order.receipt.show', $id);
        }

        return redirect()->route('order.show', $id);

    }

    public function showOrderDetail($id)
    {
        $productHelper = new ProductHelper();
        $order = Order::find($id);
        $orderItems = $order->cart_info ?? [];
        $listProductId = [];
        foreach ($orderItems as $item){
            $listProductId[] = $item['product_id'];
        }
        $listProductAttr = [];
        $attributeModel = new Attribute();
        $cartModel = new Cart();
        foreach($listProductId as $productId){
            $listProductAttr[] = $attributeModel->getSku($productId);
        }
        $listQtyCart = [];
        foreach($listProductId as $productId){
            $listQtyCart[] = $cartModel->getQtyByCart($productId,$id);
        }
        $listProductName = [];
        foreach($listProductAttr as $productAttr){
            $listProductName[] = $productHelper->convertSlugToTitle($productAttr);
        }
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        } 

        return response()->json(['data' => $order, 'listProductName' => $listProductName, 'listQtyCart'=> $listQtyCart]);
    }

    public function getOrderReceipt(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
    
        $query = Order::orderBy('id', 'DESC')->where('status', Order::STATUS_DELIVERY);
    
        if ($start_date && $end_date) {
            $query->whereBetween('delivery_date', [$start_date, $end_date]);
        }
        if (!$start_date && !$end_date) {
            $totalAmount = Order::where('status', Order::STATUS_DELIVERY)->sum('total_amount');
        }
    
        $orders = $query->get();
        $totalAmount = $orders->sum('total_amount');
    
        return view('backend.order.index')
            ->with('orders', $orders)
            ->with('status', Order::STATUS_DELIVERY)
            ->with('orderReceipt', Order::ORDER_RECEIPT)
            ->with('totalAmount', $totalAmount);
    }


}
