<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'seller_id' => 'sometimes|integer',
            'brand_id' => 'sometimes|integer',
            'segment_id' => 'sometimes|integer',
            'category_id' => 'sometimes|integer',
            'sub_category_id' => 'sometimes|integer',
            'sku' => 'required|unique:products,name,'.$this->product->id,
            'name' => 'required',
            'unit_price' => 'required',
            'discount' => 'required',
            'actual_price' => 'required',
            'stock' => 'required',
            'description' => 'required'
        ];
    }
}
