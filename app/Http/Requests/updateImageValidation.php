<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class updateImageValidation extends FormRequest
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

            'id'            => 'integer|required|',
            'image.required'=>trans('dashboard\validate.required'),
            'image.image'   =>trans('dashboard\validate.image'),
            'image.mimes    '=>trans('dashboard\validate.mimes'),
            'image.max'      =>trans('dashboard\validate.max'),



        ];
    }

    // validation messages
    public function messages()
    {
        return [
            'id.required'=>trans('dashboard\validate.required'),
            'id.integer'=>trans('dashboard\validate.integer'),
            'repassword.required'=>trans('dashboard\validate.required'),
            'image.required'=>trans('dashboard\validate.required'),
            'image.image'=>trans('dashboard\validate.image'),
            'image.mimes'=>trans('dashboard\validate.mimes'),
            'image.max'=>trans('dashboard\validate.max'),


        ];
    }
}
