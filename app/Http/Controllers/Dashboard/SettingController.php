<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public  function editShippingMethods($type)
    {
        //free ,inner, outer for shipping
        if ($type === 'free')
        {
            $dataView['shippingMethode'] = Setting::where(['key' =>'free_shipping_label'])->first();
        }elseif ($type === 'inner')
        {
            $dataView['shippingMethode'] = Setting::where(['key' =>'local_label'])->first();
        }elseif ($type === 'outer')
        {
            $dataView['shippingMethode'] = Setting::where(['key' =>'outer_label'])->first();
        }else{
            $dataView['shippingMethode'] = Setting::where(['key' =>'free_shipping_label'])->first();
        }

      //return view('dashboard.settings.shipping.editShippingSettings')->with($dataView);


    }

    public  function updateShippingMethods()
    {

    }
}
