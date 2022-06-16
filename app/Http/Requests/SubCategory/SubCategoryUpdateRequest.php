<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryUpdateRequest extends FormRequest
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
            'user_id' => 'sometimes|integer',
            'category_id' => 'sometimes|integer',
            'name' => 'required|string|unique:sub_categories,name,'.$this->sub_category->id
        ];
    }
}
