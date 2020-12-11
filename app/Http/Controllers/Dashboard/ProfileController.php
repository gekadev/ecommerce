<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\updatePasswordValidation;
use App\Models\Admin;
use App\Traites\GeneralTrait;
use Illuminate\Http\Request;
use App\Helpers\dBHelper;
use Validator;
Use Hash;
use DB;
class ProfileController extends Controller
{

    //start edit profile
    public function editProfile()
    {
        //start to get user data
        $dataView['admin']=Admin::where(['deleted' =>1,'id'=>auth('admin')->user()->id])->firstOrfail();
        return view('dashboard.profile.editprofile')->with($dataView);

    }

    public function updateprofile(ProfileRequest $request ,$id)
    {

            $adminData=array(
                'name'			  =>$request->name,
                'address'		  =>$request->address,
                'phone'		      =>$request->phone,
                'email'		      =>$request->email,
                'last_updated_by' =>auth('admin')->user()->id,
                'status'	      =>$request->status,
            );

            $updateddata=Admin::where(['id'=>$id,'deleted'=>1])->update($adminData);
            return redirect()->back()->with('success',trans('dashboard\messages.edit'));

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
                return response(['status'=>'success',"message"=>' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"id="type-error">'.trans('dashboard\messages.edit').' </button></div>']);
            }
            catch (\Exception $ex)
            {
                return response(['status'=>'error',"message"=>' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">'.trans('dashboard\messages.edit').' </button></div>']);
                DB::rollBack();
            }
        }
    }


}
