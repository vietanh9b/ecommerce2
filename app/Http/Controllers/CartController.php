<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Cart;

class CartController extends Controller
{
    public function singleAddToCart(Request $request){
        $request->validate([
            'sku'      =>  'required',
            'quant'      =>  'required',
        ]);

        $product = Attribute::where('sku', $request->sku)->first();
        if($product->stock < $request->quant[1]){
            return back()->with('error','Out of stock, You can add other products.');
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();


        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            /** @var Attribute $product */
            $already_cart->amount = ($product->price * $request->quant[1])+ $already_cart->amount;

            if ($already_cart->product_attr->stock < $already_cart->quantity || $already_cart->product_attr->stock <= 0) return back()->with('error','Stock not sufficient!.');

            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->price;
            $cart->quantity = $request->quant[1];
            $cart->amount= ($product->price * $request->quant[1]);
            if ($cart->product_attr->stock < $cart->quantity || $cart->product_attr->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();
    }

    public function checkout(Request $request){
        try {
            $listAddress = auth()->user()->getAddress();
            $addressDefault = auth()->user()->getAddressDefault() ?? $listAddress->first() ?? null;
            if (!$addressDefault) {
                $flash = array(
                    'status' => 'success',
                    'message' => 'Please add contact information'
                );
                return redirect()->route('profile', ['addressList' => $listAddress, 'defaultAddress' => $addressDefault])->with($flash['status'], $flash['message']);
            }
        } catch (\Exception $exception) {
                session()->flash('error', $exception->getMessage());
            }

        return view('frontend.pages.checkout');
    }


    public function cartUpdate(Request $request){
        if($request->quant){
            $error = array();
            $success = '';

            foreach ($request->quant as $k=>$quant) {
                $id = $request->qty_id[$k];
                $cart = Cart::find($id);
                if($quant > 0 && $cart) {

                    if($cart->product_attr->stock < $quant){
                        request()->session()->flash('error','Out of stock');
                        return back();
                    }
                    $cart->quantity = ($cart->product_attr->stock > $quant) ? $quant  : $cart->product_attr->stock;

                    if ($cart->product_attr->stock <=0) continue;
                    /** @var Attribute $attrProduct */
                    $attrProduct = $cart->product_attr;
                    $cart->amount = $attrProduct->getPrice() * $quant;
                    $cart->save();
                    $success = 'Cart successfully updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('Cart Invalid!');
        }
    }

    public function showSuccessCheckout(Request $request)
    {
        return view('frontend.pages.checkout-success');
    }

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Cart successfully removed');
            return back();
        }
        request()->session()->flash('error','Error please try again');
        return back();
    }

}
