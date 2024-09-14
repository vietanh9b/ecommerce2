<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW='admin.products.';

    public function index()
    {
        $data=Product::query()->with('catelogue')->latest('id')->get();
        // $data=Arr::sortAsc($data);
        // foreach($data as $datum){
        //     $datum->catelogue->name;
        //     dd($datum);
        // }

        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues=Catelogue::query()->get();
        $colors=ProductColor::query()->get();
        $sizes=ProductSize::query()->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('catelogues','colors','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // dd($request);
        $dataProduct=$request->validate([
        'name' => 'required',
        'sku' => 'required',
        // 'catelogue' => 'required',
        'price_regular' => 'required',
        'price_sale' => 'required',
        // 'sizes'=>'required',
        // 'color'=>'required'
    ]);
    $dataProduct = $request->except(['cover', 'sizes', 'colors']);
    $sizes = $request->sizes;
    $colors = $request->colors;
    $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
    $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
    $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
    $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;

    // $dataProduct['is_active'] ??= 0;
    // $dataProduct['is_hot_deal'] ??= 0;
    // $dataProduct['is_good_deal'] ??= 0;
    // $dataProduct['is_show_home'] ??= 0;
    $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
    $existingVariants = [];
    $error_test = false;
    
    for ($i = 0; $i < count($sizes); $i++) {
        $variantKey = $sizes[$i] . '-' . $colors[$i];
        
        if (in_array($variantKey, $existingVariants)) {
            $error_test = true;
            break;
        }
        
        $existingVariants[] = $variantKey;
    }

    if (!$error_test) {
        $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        $product = Product::query()->create($dataProduct);
        
        foreach ($sizes as $index => $size) {
            ProductVariant::query()->create([
                'product_id' => $product->id,
                'product_size_id' => $size,
                'product_color_id' => $colors[$index],
            ]);
        }

        return redirect()->route('admin.products.create');
    } else {
        return redirect()->back()->withErrors(['msg' => 'Variants are duplicated']);
    }
}

    // public function store(Request $request)
    // {

    //     // dd($request);
    //     // echo 1;
    //     $dataProduct=$request->validate([
    //         // 'name' => 'required',
    //         // 'sku' => 'required',
    //         // 'catelogue' => 'required',
    //         // 'price_regular' => 'required',
    //         // 'price_sale' => 'required',
    //         // 'sizes'=>'required',
    //         // 'color'=>'required'
    //     ]);
    //     // list(
    //     //     $dataProduct,
    //     //     $dataProductVariants
    //     // ) = $this->handleData($request);
    //     // dd(validator()->errors());

    //     $dataProduct=$request->except(['cover','sizes','colors']);
    //     // dd($dataProduct);
    //     // var_dump($dataProduct);

    //     $product_variant=[];
    //     $sizes=$request->sizes;
    //     $colors=$request->colors;
    //     $dataProduct['is_active']=isset($dataProduct['is_active']) ? 1 : 0;
    //     $error_test=0;
    //     $lastArrTmp=[];
    //     for($i=0;$i<count($sizes);$i++){
    //         $check=false;
    //         for($x=$i+1;$x<count($colors);$x++){
    //             $value1=[$sizes[$i],$colors[$i]];
    //             $value2=[$sizes[$x],$colors[$x]];

    //                 if($value1!=$value2){
    //                     $product_variant['product_size_id']=$sizes[$i];
    //                     $product_variant['product_color_id']=$colors[$i];
    //                     // echo '<pre>';
    //                     // print_r($product_variant);
    //                     // echo '<pre>';
    //                     // die();
    //                 }else{
    //                     $check=true;
    //                 }
    //         }
    //         if(!$check){
    //             echo '<pre>';
    //             print_r($product_variant);
    //             echo '<pre>';
    //         }
    //     }
    //     die();
    //     // echo '<pre>';
    //     // print_r($product_variant['product_size_id']);
    //     // echo '<pre>';

    //     if(!$error_test){
    //         ProductVariant::query()->create();
    //         $test=Product::query()->create($dataProduct);
    //         return redirect()->route('admin.products.create');
    //     }
    //     return redirect()->back()->withErrors(validator()->errors());
    // }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $variant=ProductVariant::query()->where('product_id','=',$product->id)->get();
        $catelogues=Catelogue::query()->get();
        $colors=ProductColor::query()->get();
        $sizes=ProductSize::query()->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('product','catelogues','colors','sizes','variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
            // dd($product);
            $dataProduct=$request->validate([
                'name' => 'required',
                'sku' => 'required',
                // 'catelogue' => 'required',
                'price_regular' => 'required',
                'price_sale' => 'required',
                // 'sizes'=>'required',
                // 'color'=>'required'
            ]);
            $dataProduct = $request->except(['cover', 'sizes', 'colors','_token','_method']);
            $sizes = $request->sizes;
            $colors = $request->colors;
            $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
            $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
            $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
            $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        
            // $dataProduct['is_active'] ??= 0;
            // $dataProduct['is_hot_deal'] ??= 0;
            // $dataProduct['is_good_deal'] ??= 0;
            // $dataProduct['is_show_home'] ??= 0;
            $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
            $existingVariants = [];
            $error_test = false;
            
            for ($i = 0; $i < count($sizes); $i++) {
                $variantKey = $sizes[$i] . '-' . $colors[$i];
                
                if (in_array($variantKey, $existingVariants)) {
                    $error_test = true;
                    break;
                }
                
                $existingVariants[] = $variantKey;
            }
        
            if (!$error_test) {
                
                
            // Cập nhật các biến thể sản phẩm
            foreach ($sizes as $index => $size) {
                $productVariant = ProductVariant::where('product_id', $product->id)
                                ->where('product_size_id', $size)
                                ->where('product_color_id', $colors[$index])
                                ->first();

                if ($productVariant) {
                    // Cập nhật biến thể nếu tồn tại
                    $productVariant->update([
                        'product_id' => $product->id,
                        'product_size_id' => $size,
                        'product_color_id' => $colors[$index],
                    ]);


                if(isset($request->img_thumbnail)){
                    $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
                    Storage::delete($product->img_thumbnail);
                }

                $product = Product::where('id', $product->id);
                $product->update($dataProduct);
        
                return redirect()->route('admin.products.index');
            } else {
                return redirect()->back()->withErrors(['msg' => 'Variants are duplicated']);
            }
        }
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Xóa tất cả các biến thể liên quan trước
    $product->variants()->delete();

    // Xóa sản phẩm
    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
    private function handleData($request)
    {
        $dataProduct = $request->except(['product_variants']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
        if (!empty($dataProduct['img_thumbnail'])) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVariantsTmp = $request->product_variants;
        // dd($dataProductVariantsTmp);
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);

            // current_image xuất hiện khi update
            $image = !empty($item['image'])
                ? Storage::put('product_variants', $item['image']) : ($item['current_image'] ?? null);

            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quatity' => $item['quatity'],
                'image' => $image
            ];
        }

        $dataProductGalleriesTmp = $request->product_galleries ?: [];
        $dataProductGalleries = [];
        foreach ($dataProductGalleriesTmp as $image) {
            if (!empty($image)) {
                $dataProductGalleries[] = [
                    'id' => $item['id'] ?? null, // Tồn tại ID khi update
                    'image' => Storage::put('product_galleries', $image)
                ];
            }
        }

        $dataProductTags = $request->tags;
        $dataDeleteGalleries = $request->delete_galleries;

        return [$dataProduct, $dataProductVariants, $dataProductGalleries, $dataProductTags, $dataDeleteGalleries];
    }
}
