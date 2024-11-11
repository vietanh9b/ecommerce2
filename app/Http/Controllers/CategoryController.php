<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UseDefault;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    const IS_PARENT_CATEGORY = 0;
    const ATTRIBUTE_IS_PARENT = 'parent_id';
    
    const RULE_VALIDATE_COMMON = [
        'title' => 'string|required',
        'summary' => 'string|nullable',
        'photo' => 'string|nullable',
        'status' => 'required|in:active,inactive',
    ];


    
    public function index(Request $request)
    { 
        $category = Category::orderBy('id','ASC')->get();
        return view('backend.category.index')->with('categories', $category);
    }
    

    public function create()
    {
        $category = Category::orderBy('id','ASC')->get();
        
        return view('backend.category.create')->with('categories', $category);
    }

    

    public function store(Request $request)
    {
        $category = Category::orderBy('id','ASC')->get();
        $categorySave = '';
        try {
            $slugRequest = $request->get('title');
            $validateSlug = [];
            if (!empty($request->get('slug'))) {
                $validateSlug = ['slug' => 'unique:categories,slug'];
                $slugRequest = $request->get('slug');
            }
            $slug = Str::slug($slugRequest);
            $request['slug'] = $slug;
            $this->validate($request, array_merge(self::RULE_VALIDATE_COMMON, $validateSlug));
            $data = $request->all();
            $data['slug'] = $slug;
            $data['summary'] = $request->get('summary');
            $data['status'] = $request->get('status');
            if ($request->get('parent_id') == Category::CATEGORY_PARENT) {
                $data['parent_id'] = self::IS_PARENT_CATEGORY;
                $data['category_type'] = $request->get('category_type');
            } 
            else {
                $data['parent_id'] = $request->get('parent_id');
                $data['category_type'] = $request->get('category_type');
            }
            $categorySave = Category::create($data);
            request()->session()->flash('success', __('Category successfully added'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
            redirect()->route('category.create');
        }
        return redirect()->route('category.index')->with('categories', $category);
    }

    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $categories =  Category::get();
        return view('backend.category.edit')->with('category', $category)->with('categories',$categories);
       
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $this->validateDataCategoryFormEdit($request, $category);
            $data = $request->all();
            $category->update($data);

            request()->session()->flash('success', __('Category successfully updated'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
        }
        return redirect()->route('category.index');
    }

    private function validateDataCategoryFormEdit($request, $category) {
        $newSlugRequest = $request->get('slug');
        $slug = Str::slug($newSlugRequest);
        $categoryId = $category->getAttribute('id');

        $validateSlug = ['slug' => [
            'required',
            Rule::unique('categories')
                ->ignore($categoryId)
                ->where(function ($query) use ($request, $category) {
                    $query->where('slug' , $request->get('slug')
            );
            return $query;
        })]];

        $request['slug'] = $slug;
        $this->validate($request, array_merge(self::RULE_VALIDATE_COMMON, $validateSlug));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        // $childCatId = Category::where(self::ATTRIBUTE_IS_PARENT, $id)->pluck('id');
        $status = $category->delete();

        if ($status) {
            // if (count($childCatId) > 0) {
            //     Category::shiftChild($childCatId);
            // }
            request()->session()->flash('success', __('Category successfully deleted'));
        } else {
            request()->session()->flash('error', __('Error while deleting category'));
        }
        return redirect()->route('category.index');
    }

    public static function shiftChild($catId)
    {
        return Category::whereIn('id', $catId)->update(['parent_id' => 0]);
    }

    public function productCat(Request $request)
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAllProductWithSlugOfCategory($request->slug, $storeId) ?? [];

        return view('frontend.pages.product-lists')
            ->with([
                'products' => $products,
            ]);
    }


}
