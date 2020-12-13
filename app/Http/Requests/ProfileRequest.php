<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'id'         => 'integer|required|exists:admins',
            'name'       => 'min:2|required|max:50',
            'email'      => 'required|email|unique:admins,email,'.$this->id,
            'address'    => 'required|min:6|max:50',
            'phone'      => 'required|integer',
            'status'     => 'integer'

        ];
    }
    // validation messages
//    public function messages()
//    {
//        return [
//            'id.required'=>trans('dashboard\validate.required'),
//            'id.integer'=>trans('dashboard\validate.integer'),
//            'id.exists'=>trans('dashboard\validate.exists'),
//            'name.required'=>trans('dashboard\validate.required'),
//            'name.min'=>trans('dashboard\validate.min'),
//            'name.max'=>trans('dashboard\validate.max'),
//            'name.unique'=>trans('dashboard\validate.unique'),
//            'address.required'=>trans('dashboard\validate.required'),
//            'address.min'=>trans('dashboard\validate.min'),
//            'address.max'=>trans('dashboard\validate.max'),
//            'email.required'=>trans('dashboard\validate.required'),
//            'email.email'=>trans('dashboard\validate.email'),
//            'phone.integer'=>trans('dashboard\validate.integer'),
//            'phone.required'=>trans('dashboard\validate.required'),
//            'status.integer'=>trans('dashboard\validate.integer'),
//
//        ];
//    }
}
