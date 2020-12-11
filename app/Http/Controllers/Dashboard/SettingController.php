<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\ShippingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

      return view('dashboard.settings.shipping.editShippingSettings')->with($dataView);


    }

    public  function updateShippingMethods( ShippingRequest  $request, $id)
    {
        try {
            // get data
            $dataView['shippingMethode'] = Setting::where(['id' =>$id])->firstOrfail();
            //startpreparedata o be updated
            DB::beginTransaction();
            $shippingData = array('plain_value'	=>$request->plain_value);
            //start update data
            $updatedata = Setting::where(['id'=>$id])->update($shippingData);
            $dataView['shippingMethode'] ->translate('en')->value = $request->value_en ;
            $dataView['shippingMethode'] ->translate('ar')->value = $request->value_ar ;
            $dataView['shippingMethode'] ->save();
            DB::commit();
            return redirect()->back()->with('success','تم تحديث البيانات بنجاح');
        }catch ( \Exception $ex){
            return redirect()->back()->with('error','خطاء في تحديث البيانات برجاء المحاوله مره اخري');
            DB::rollBack();
        }




    }
}
