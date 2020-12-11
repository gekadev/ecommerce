<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginValidation extends FormRequest
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
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }
    // get messages
    /*
    public  function messages()
    {
        /
        return [
            'email.required' =>' البريد الاليكتروني مطلوب' ,
            'email.email' =>trans('dashboard\validate.email'),
            'password.required' =>trans('dashboard\validate.password')
        ];


    }
    */

}
