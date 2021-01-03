<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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

//    public function rules()
//    {
//        return [
//            'name_en'       => 'min:2|required|max:100|',
//            'name_ar'       => 'min:2|required|max:100|',
//            'description_ar' => 'min:2|required|max:500|',
//            'description_en' => 'min:2|required|max:500|',
//            'slug'        => 'required|unique:categories,slug,'.$this->id,
//            'url'         => 'required|url',
//            'status'      => 'integer',
//            'category_id' => 'integer',
//            'sub'         => 'integer',
//           // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048,
//
//
//        ];
//    }
    public function rules()
    {
        switch($this->method())
        {

            case 'POST'://add data
            {
                return [ //
                    'name_en'       => 'min:2|required|max:100|',
                    'name_ar'       => 'min:2|required|max:100|',
                    'link_name'        => 'required|unique:tags,link_name',
                    'status'      => 'integer',
                ];
            }
            case 'PUT': //edit data
            {
                return [
                    'name_en'       => 'min:2|required|max:100|',
                    'name_ar'       => 'min:2|required|max:100|',
                    'link_name'     => 'required|unique:tags,link_name,'.$this->id,
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
