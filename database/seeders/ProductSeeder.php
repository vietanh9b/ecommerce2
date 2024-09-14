<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();
        Tag::factory(15)->create();

        // size: S, M, L, XL, XXL
        foreach(['S', 'M', 'L', 'XL', 'XXL'] as $item){
            ProductSize::query()->create([
                'name'=>$item
            ]);
        }
        // color:#00FFFF,#EE0000,#00FF00,#CC00FF,#00FF00
        foreach(['#00FFFF','#EE0000','#00FF00','#CC00FF','#00FF00'] as $item){
            ProductColor::query()->create([
                'name'=>$item
            ]);
        }

        // product
        for($i=1;$i<1001;$i++){
            $name=fake()->text(100);
            Product::query()->create([
                'catelogue_id'=>rand(3,5),
                'name'=>$name,
                'slug'=>Str::slug($name).'-'.Str::random(8),
                'sku'=>Str::random(7).$i,
                'img_thumbnail'=>'https://canifa.com/img/1000/1500/resize/8/t/8ts23s014-sa644-1.webp',
                'price_regular'=>500000,
                'price_sale'=>399000,
            ]);
        }

        for($i=1;$i<1001;$i++){
            ProductGallery::query()->insert(
                [
                'product_id'=>$i,	
                'image'=>'https://canifa.com/img/1000/1500/resize/8/t/8ts23s014-sa644-1.webp'
                ],
                [
                    'product_id'=>$i,	
                    'image'=>'https://canifa.com/img/1000/1500/resize/1/d/1ds23s002-sm200-1-thumb.webp'
                ]
        );
        }
        for($i=1;$i<1001;$i++){
            DB::table('product_tag')->insert(
                [
                    'product_id'=>$i,
                    'tag_id'=>rand(1,8)
                ],
                [
                    'product_id'=>$i,
                    'tag_id'=>rand(9,15)
                ]
            );
        }
        for($productID=1;$productID<1001;$productID++){
            $data=[];
            for($sizeID=1;$sizeID<6;$sizeID++){
                for($colorID=1;$colorID<6;$colorID++){
                    $data[]=[
                        'product_id'=>$productID,
                        'product_size_id'=>$sizeID,
                        'product_color_id'=>$colorID,
                        'quantity'=>100,
                        'image'=>'https://canifa.com/img/1000/1500/resize/1/d/1ds23s002-sm200-1-thumb.webp'
                    ];
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}
