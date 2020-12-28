<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     */            //'name'       => 'min:2|required|max:50|',

    public function rules()
    {
        switch($this->method())
        {

            case 'POST'://add data
            {
                return [ //
                    'name_en'       => 'min:2|required|max:100|',
                    'name_ar'       => 'min:2|required|max:100|',
                    'status'      => 'integer',
                    'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ];
            }
            case 'PUT': //edit data
            {
                return [
                    'name_en'       => 'min:2|required|max:100|',
                    'name_ar'       => 'min:2|required|max:100|',
                    'status'      => 'integer',
                ];
            }
            case 'PATCH':
            {
                return [];
            }

            default:break;
        }
    }

}
