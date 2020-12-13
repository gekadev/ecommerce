<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\updatePasswordValidation;
use App\Models\Admin;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{

    //start edit profile
    public function editProfile($id)
    {
        //start to get user data
        $dataView['admin'] = Admin::where(['deleted' =>1,'id'=>$id])->firstOrfail();
        $dataView['title'] = 'تعديل الملف الشخصي';
        return view('dashboard.profile.editprofile')->with($dataView);

    }

    public function updateprofile(ProfileRequest $request ,$id)
    {
        try {
            //prepare data
            $adminData=array(
                'name'			  =>$request->name,
                'address'		  =>$request->address,
                'phone'		      =>$request->phone,
                'email'		      =>$request->email,
                'last_updated_by' =>auth('admin')->user()->id,
                'status'	      =>$request->status,
            );
            DB::beginTransaction();
            unset($request['id']);
            $updateddata=Admin::where(['id'=>$id,'deleted'=>1])->update($adminData);
            DB::commit();
            ;
          return redirect()->back()->with('success','تم تعديل البيانات بنجاح');
        }
        catch (\Exception $ex)
        {
            return redirect()->back()->with('error','خطاء في تحديث البيانات برجاء المحاوله مره اخري');
            DB::rollBack();
        }
    }

    // start update image
    public function update_password(updatePasswordValidation $request,$id)
    {

        if($request->ajax())
        {
            try
            {
                $id = (int)$request->get('id');
                // get user id from session
                $user_id = auth('admin')->user()->id;
                //prepare data for delete
                $updatedData=[
                    "last_updated_by"   =>$user_id,
                    'password'          => Hash::make($request->password)
                ];
                DB::beginTransaction();
                $adminData= Admin::where(['deleted'=>1,'id'=>$id])->update($updatedData);
                DB::commit();
                return response(['status'=>'success',"message"=>' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-success mb-2"id="type-error">تم تعديل البيانات بنجاح </button></div>']);
            }
            catch (\Exception $ex)
            {
                return response(['status'=>'error',"message"=>' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-danger mb-2"id="type-error">خطاء في تحديث البيانات برجاء المحاوله مره اخري </button></div>']);
                DB::rollBack();
            }
        }
    }
    public function update_images(Request $request , $id)
    {
        if($request->ajax())
        {

            //start validation
            $validationArray = [
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'id'    => 'required|integer',
            ];

            $validate = Validator::make(
                $request->all(),
                $validationArray
            );
            if($validate->fails())
            {
                    $id = (int)$request->get('id');

                return response(["status"=>"error","message"=>$validate->errors()->all()]);
            }

            // get brand id
              $id = (int)$request->get('id');
            if($id == 0)
            {
                return response(['status'=>'error',"message"=>"invalid Id"]);
            }else{
                // get user id from session
                $user_id = auth('admin')->user()->id;
                //prepare data for delete
                $updatedData=[
                    "last_updated_by" => $user_id,
                    "image" => UploadImage($request,"image")
                ];
                $brandData = Admin::where(['deleted'=>1,'id'=>$id])->update($updatedData);
                if(false != $brandData)
                {
                    return response(['status'=>'success',"message"=>"تم تعديل البيانات بنجاح","image"=>$updatedData['image']]);

                }else{
                    return response(['status'=>'error',"message"=>"خطاء في تحديث البيانات برجاء المحاوله مره اخري"]);
                }

            }
        }
    }


}
