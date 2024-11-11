<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index(Request $request)
    { 
        $attributes = Attribute::orderBy('id','ASC')->get();
        return view('backend.attribute.index')->with('attributes', $attributes);
    }
    

    public function create()
    {
        $attributes = Attribute::all();
        return view('backend.attribute.create')->with('attributes', $attributes);
    }
    
    public function store(Request $request)
    {
        $flash = array(
            'status' => 'success',
            'message' => 'Successfully added new attribute'
        );
        try {
            $data = $request->all();
            $data['product_id'] = $data['product_id'];

            $attributeModel = new Attribute();
            $this->prepareAttributeDataModel($attributeModel, $data);
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }

return redirect()->back()->with($flash['status'], $flash['message']);
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        if($attribute){
            return response()->json([
                'status' =>200,
                'attribute' => $attribute,
            ]);
        }
        else{
             return response()->json([
                'status' =>404,
                'attribute' => $attribute,
                'message' =>"Attribute not found!",
            ]);
        }
       
       
    }

    public function update(Request $request, $id)
    {
        $flash = array(
            'status' => 'success',
            'message' => 'Successfully updated'
        );

        try {
            $attribute = Attribute::findOrFail($id);
            $data = $request->all();
            
            $data['product_id'] = $data['product_id'];
            $this->prepareAttributeDataModel($attribute, $data);

        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }

        return redirect()->back()->with($flash['status'], $flash['message']);
    }
   
    
    public function destroy($id)
    { 
        $flash = array(
            'status' => 'success',
            'message' => 'Attribute Successfully deleted'
        );

        try {
            $attribute = Attribute::where('id', $id)->firstOrFail();

            if (isset($attribute)) {
                $attribute->delete();
            }
            else
            {
                $flash['status'] = 'error';
                $flash['message'] = 'Product SKU not found';

                return redirect()->back()->with($flash['status'], $flash['message']);
            }
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }

        return redirect()->back()->with($flash['status'], $flash['message']);
    }
       

    public function prepareAttributeDataModel($attributeModel, $data) {
        $attributeModel->sku    = $data['attribute_sku'];
        $attributeModel->color  = $data['attribute_color'] ?? '';
        $attributeModel->price  = $data['attribute_price'] ?? '';
        $attributeModel->stock  = $data['attribute_stock'] ?? null;
        $attributeModel->product_id = $data['product_id'] ?? null;
        $attributeModel->photo =  $data['attribute-photo'];

        $attributeModel->save();
    }
}
