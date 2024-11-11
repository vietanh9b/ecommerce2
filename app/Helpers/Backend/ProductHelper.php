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

namespace App\Helpers\Backend;

use App\Http\Controllers\CategoryController;
use App\Models\CustomerGroup;
use App\Models\Product;
use App\Models\TierPrice;
use App\Repositories\ProductRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProductHelper
{

    public function getCurrentParentCategoryStoreView($product)
    {
        $productRepository = new \App\Repositories\ProductRepository();
        return $productRepository->getParentCategoryLevel($product, $currentStoreId);
    }


    public function getCurrentSubParentCategoryStoreView($product)
    {
        $productRepository = new \App\Repositories\ProductRepository();
        return $productRepository->getSubParentCategoryLevel($product);
    }

    public function validateDataRequest($subject, $request)
    {

        $subject->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'price' => 'required|numeric',
        ]);
    }

    public function convertSlugToTitle($slug){
        $title = str_replace('-', ' ', $slug); 
        $title = ucwords($title); 
        return $title;
    }

    public function formatPrice($productPrice){
       return number_format($productPrice, 0, ',', '.');
    }
}
