<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seller_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'segment_id' => 'required|integer',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'sku' => 'required|unique:products,sku',
            'name' => 'required',
            'unit_price' => 'required',
            'discount' => 'required',
            'actual_price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'product_images.*' => 'mimes:jpeg,jpg,png|max:2000'
        ];
    }
}
