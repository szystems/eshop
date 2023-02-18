<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'cate_id'=>'required',
            'name'=>'required|max:191',
            'small_description'=>'required',
            'description'=>'required',
            'original_price'=>'required|max:191',
            'selling_price'=>'required|max:191',
            'qty'=>'required',
            'image'=>'mimes:jpg,jpeg,bmp,png|max:10000'
        ];
    }
}
