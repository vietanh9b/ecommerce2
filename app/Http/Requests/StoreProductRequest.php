<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required|string|max:255',
                'sku' => 'required',
                'catelogue' => 'required',
                'price_regular' => 'required|integer',
                'price_sale' => 'nullable|integer',
                'sizes'=>'required',
                'colors'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Bắt buộc phải nhập tên sản phẩm',
            'name.string'=>'Tên phải là chữ cái',
            'catelogue.required'=>'Bắt buộc phải chọn danh mục sản phẩm',
            'price_regular.required'=>'Bắt buộc phải nhập giá chung',
            'price_sale.required'=>'bắt buộc phải n',
            'sizes.required'=>'bắt buộc',
            'colors.required'=>'bắt buộc'
        ];
    }

}
