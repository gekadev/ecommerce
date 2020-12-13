<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class updatePasswordValidation extends FormRequest
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
            'password'   => 'min:6|required',
            'repassword' => 'required|same:password',


        ];
    }

    // validation messages
//    public function messages()
//    {
//        return [
//            'id.required'=>trans('dashboard\validate.required'),
//            'id.integer'=>trans('dashboard\validate.integer'),
//            'id.exists'=>trans('dashboard\validate.exists'),
//            'password.required'=>trans('dashboard\validate.required'),
//            'password.min'=>trans('dashboard\validate.min'),
//            'password.same'=>trans('dashboard\validate.same'),
//            'value.max'=>trans('dashboard\validate.max'),
//            'repassword.required'=>trans('dashboard\validate.required'),
//
//        ];
//    }
}
