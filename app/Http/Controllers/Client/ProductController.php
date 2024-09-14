<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $catelogues=Catelogue::query()->get();
        return view('client.index',compact('catelogues'));
    }
    public function shop(){
        $catelogues=Catelogue::query()->get();
        $products=Product::query()->with('catelogue')->get();
        // dd($products);
        return view('client.shop',compact('catelogues','products'));
    }
    public function detail(string $id){
        $catelogues=Catelogue::query()->get();
        // $product=Product::query()->find($id);
        $product = Product::with('variants.color', 'variants.size')->findOrFail($id);
        // dd($product1->variants->);
        return view('client.detail',compact('product','catelogues'));
    }
    public function addToCart(Request $request)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('message', 'Please login to add products to your cart.');
        // }
    
        $userId = Auth::id();
        // $productVariantId = $request->input('product_variant_id');
        $quantity = $request->input('quantity', 1);
    
        $productVariantId = ProductVariant::where('product_id', $request->input('product_id'))
        ->where('product_color_id', $request->input('color_id'))
        ->where('product_size_id', $request->input('size_id'))
        ->first();
        // Tìm giỏ hàng của người dùng hiện tại hoặc tạo mới nếu chưa có
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
    
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_variant_id', $productVariantId->id)
            ->first();
    
        if ($cartItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có, tạo mới một bản ghi trong `cart_items`
            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $productVariantId->id,
                'quantity' => $quantity,
            ]);
        }
        return redirect()->route('client.cart.show',$userId)->with('success', 'Product added to cart successfully!');
    }
    public function showCart(string $id)
    {
    $catelogues = Catelogue::query()->get();
    $cart = Cart::where('user_id', $id)
        // ->with('items.product') // Tải quan hệ items và product
        ->first(); // Lấy kết quả đầu tiên
        // dd($cart[0]->product);
    if (!$cart) {
        echo 'not found';
        // return redirect()->route('home')->with('error', 'Cart not found.');
    }
    
    // Debug để kiểm tra dữ liệu
    // dd($cart);
    
    return view('client.cart', compact('catelogues', 'cart'));
}

}
