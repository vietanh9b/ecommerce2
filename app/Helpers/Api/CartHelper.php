<?php
/**
 *
 * Copyright © 2022 Wgentech. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Wgentech Dev Team
 * @author    binhnt@mail.wgentech.com
 *
 */

namespace App\Helpers\Api;

use App\Models\Cart;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use App\Helpers\Backend\ProductHelper;
use App\Models\Attribute;

class CartHelper
{

    
    /**
     * Handle product is out of stock when create Order
     *
     * @param $currentUserId
     * @param null $orderId
     * @return void
     * @throws \Exception
     */
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
            $productSku = $product->sku ?? '';
            $productName = $productHelper->convertSlugToTitle($productSku);
            if (empty($currentStock) || $currentStock - $currentCartQty < 0) {
                throw new \Exception(__('The quantity with '. $productName . ' is not enough to continue process'));
            }
        }
    }
}

