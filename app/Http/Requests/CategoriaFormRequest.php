<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaFormRequest extends FormRequest
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
            'name'=>'required|max:191',
            'slug'=>'required|max:191',
            'description'=>'required|max:191',
            'meta_keywords'=>'required|max:191',
            'meta_title'=>'required|max:191',
            'meta_descrip'=>'required|max:191',
            'image'=>'mimes:jpg,jpeg,bmp,png|max:10000'
        ];
    }
}
