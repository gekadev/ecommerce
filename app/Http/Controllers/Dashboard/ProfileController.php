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
use Yajra\DataTables\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\AdminsExport;

class ProfileController extends Controller
{

    public function index()
    {
        $dataView['title'] = 'جميع الموظفين';
        return view('dashboard.profile.getall')->with($dataView);
    }

    public function create()
    {
        $dataView['title'] = 'اضافه  موظف';
        return view('dashboard.profile.create')->with($dataView);
    }
    // start add data
    public function store(ProfileRequest $request)
    {
        try{
            // prepare data
            $validatedData = array(
                'name'			  =>$request->name,
                'address'		  =>$request->address,
                'phone'		      =>$request->phone,
                'email'		      =>$request->email,
                'status'	      =>$request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'created_by'      => auth('admin')->user()->id,
                'created'         => time(),
                "image"           => UploadImage($request,"image"),
                'password'        => Hash::make($request->password)
            );

            // start add data
            $add = Admin::create($validatedData);
            return redirect()->back()->with('success','تم اضافه البيانات بنجاح');
        }catch ( \Exception $ex){
            return redirect()->back()->with('error','خطاء في اضافه البيانات برجاء المحاوله مره اخري');
       }

    }

    //start edit profile
    public function editProfile($id)
    {
        //start to get user data
        $dataView['admin'] = Admin::IsExist($id)->first();
        if(!$dataView['admin'])
            return view('layouts.error');
        $dataView['title'] = 'تعديل الملف الشخصي';
        return view('dashboard.profile.editprofile')->with($dataView);

    }

    public function updateprofile(ProfileRequest $request ,$id)
    {
        try {
            //prepare data
            $adminData = array(
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'last_updated_by' => auth('admin')->user()->id,
                'status' => $request->status,
            );
            DB::beginTransaction();
            unset($request['id']);

            $updateddata = Admin::where(['id' => $id, 'deleted' => 1])->update($adminData);
            DB::commit();;
            return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'خطاء في تحديث البيانات برجاء المحاوله مره اخري');
            DB::rollBack();
        }
    }
    public function Datatable()
    {
        $dataView['alladmins'] = Admin::where(['deleted' =>1])->get();
        return Datatables::of($dataView['alladmins'])
            ->addColumn('id', function (Admin $admin) {
                return $admin->id;
            })->addColumn('name', function (Admin $admin) {
                return $admin-> name;
            })->addColumn('email', function (Admin $admin) {
                return $admin-> email;
            })->addColumn('phone', function (Admin $admin) {
                return $admin-> phone;
            })->addColumn('image', function (Admin $admin) {
                return '<img src="/upload/'.$admin->image.'"  data-id="'.$admin->id.'" data-toggle="modal" data-target="#update-img"  alt="" title="Edit Image" class="img-rounded img-responsive center-block img-edit imagenumber'.$admin->id.'" />';

            })->addColumn('status', function (Admin $admin) {

                if ($admin->status == 1) {
                    return '<span data-id="' . $admin->id . '" title="update Status" data-target="on" class="status on ">' . $admin->getActive() . '</span>';
                } else {
                    return '<span data-id="' . $admin->id . '" title="update Status"  data-target="off" class="status off"> ' . $admin->getActive() . '</span>';
                }
            })->addColumn('action', function (Admin $admin) {
//                return '<ul class="actions">
//					<li><a href="' . route('category.edit', $category->id) . '"  class="" id="' . $category->id . '" ><i class="la la-edit "></i></a></li>
//					<li><a href=""  data-toggle="modal"  data-id="' . $category->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="la la-trash red"></i></li>
//				</ul>';
                return '<div class="btn-group">
                  <a class="btn btn-purple dropdown-toggle" href="javascript:;" data-toggle="dropdown"><i class="fa fa-angle-down"></i><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a> <div class="dropdown-menu pull-right">
                  <li><a href="' . route('profile.edit', $admin->id) . '"  class="" id="' . $admin->id . '" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i>تعديل</a></li>
                    <li><a href="' . route('profile.showdetails', $admin->id) . '"  class="" id="' . $admin->id . '" ><i class="fa fa-eye" aria-hidden="true"></i></i>عرض</a></li>
                   <li><a href=""  data-toggle="modal"  data-id="' . $admin->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>حذف</li>
                    </div></div>';
            })->rawColumns(['image', 'status', 'action'])->make(true);
    }
    public function showdetails($id)
    {
        //check if category is founf
        $dataView['admin'] = Admin::IsExist($id)->first();
        if(!$dataView['admin'])
            return view('layouts.error');
        else
        $dataView['title'] = 'تفاصيل الموظف';
        return  view('dashboard.profile.showdetails')->with($dataView);

    }
    //start create pdf
    public function pdf()
    {
        $title = 'جميع الموظفين';
        $alladmins = Admin::where(['deleted' =>1])->get();
        $pdf = PDF::loadView('dashboard.profile.pdf',compact('title','alladmins'));
        $pdf->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('جميع الموظفين');
    }
    //export to csv
    public function CSV()
    {
        return Excel::download(new AdminsExport, 'admins.xlsx');
        redirect(Request::url('admins.index'));
    }

    public function updateStatus(Request $request,$id)
    {

        if ($request->ajax()) {
            try {
                $id = (int)$request->get('id');
                if ($id == 0)
                    return response(['status' => 'error', "invalid id ", "res" => $id]);
                else
                    // get user id from session
                    $user_id = auth('admin')->user()->id;
                // get current status
                $currentStatus = $request->input('status');
                // if current status = on set it off
                if ($currentStatus == "on") {
                    $setStatus = 2;
                } else {
                    $setStatus = 1;
                }
                //prepare data for delete
                $updatedData = [
                    "last_updated_by" => $user_id,
                    "status" => $setStatus
                ];
                $admin = Admin::IsExist($id)->first();
                if (!$admin)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                $admin->update($updatedData);

                return response(['status' => 'success', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"id="type-error">تم تحديث البيانات بنجاح </button></div>']);
            }catch (\Exception $ex)
            {
                return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);

            }


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
    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                // get User id
                $id = (int)$request->get('id');
                if ($id == 0)
                    return response(['status' => 'error', "invalid id ", "res" => $id]);
                else
                    // get user id from session
                    $user_id = auth('admin')->user()->id;
                //prepare data for delete
                $categoryData = [
                    "last_updated_by" => $user_id,
                    "deleted" => 2
                ];
                $admin = Admin::IsExist($id)->first();
                if (!$admin)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                $admin->update($categoryData);
                return response(['status' => 'success', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"id="type-error">تم تحديث البيانات بنجاح </button></div>']);
            } catch (\Exception $ex) {
                return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
            }
        }
    }



}
