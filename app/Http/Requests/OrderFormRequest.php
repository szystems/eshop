<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
            'fname'=>'required|max:191',
            'lname'=>'required|max:191',
            'email'=>'required|max:191',
            'phone'=>'required|max:191',
            'address1'=>'required|max:191',
            'city'=>'required|max:191',
            'state'=>'required|max:191',
            'country'=>'required|max:191',
            'zipcode'=>'required|max:191',
        ];
    }
}
