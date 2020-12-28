<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\BrandsReports;
use App\Http\Requests\BrandRequest   ;
use App\Models\BrandsTranslation;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\BrandsExport;



class BrandController extends Controller
{

    public function index()
    {
        $dataView['title'] = 'جميع الماركات';

        return view('dashboard.brand.getall')->with($dataView);
    }
    public function create()
    {
        $dataView['title'] = 'اضافه براند';
        return view('dashboard.brand.create')->with($dataView);
    }

    // start add data
    public function store(BrandRequest $request)
    {
        try{
            // prepare data
            $validatedData = array(
                'status' => $request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'created_by'      => auth('admin')->user()->id,
                'created'         => time(),
                "image"           => UploadImage($request,"image"),
                'en' => [
                    'name'       => $request->name_en,
                ],
                'ar' => [
                    'name'       => $request->name_ar,
                ],
            );

            // start add data
            DB::beginTransaction();
            $add = Brands::create($validatedData);
            $id = $add->id;
        //add data in brand report
            $brandReport = BrandsReports::create(
                ['status'           =>$validatedData['status'],
                 'brand_id'         =>$id,
                 'created_by'       =>$validatedData['created_by']
                 ,'last_updated_by' =>$validatedData['last_updated_by']

                ]);
        DB::commit();
            return redirect()->back()->with('success','تم اضافه البيانات بنجاح');
        }catch ( \Exception $ex){
            return redirect()->back()->with('error','خطاء في اضافه البيانات برجاء المحاوله مره اخري');
            DB::rollBack();
        }

    }

    // start edit  brand
    public function edit($id)
    {
        //check if brand is founf
        $dataView['brand'] = Brands::IsExist($id)->first();
        if(!$dataView['brand'])
            return view('layouts.error');
        else
        $dataView['brand'] ->makeVisible(['translations']);
        $dataView['title'] = 'تعديل  البراند';
        return  view('dashboard.brand.edit')->with($dataView);

    }

    public function update(BrandRequest $request,$id)
    {
//        try{
            // prepare data
            $validatedData = array(
                'status' => $request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'en' => [
                    'name'       => $request->name_en,
                ],
                'ar' => [
                    'name'       => $request->name_ar,
                ],
            );

            // check is brand id found
            $brand = Brands::IsExist($id)->first();
            if(!$brand)
                return view('layouts.error');
            DB::beginTransaction();
             $brand->update($validatedData);
            // strat update  brand report
            $brandReport = BrandsReports::where(['deleted'=>1,'id'=>$id])->update(['status'=>$validatedData['status']]);
            DB::commit();
            return redirect()->back()->with('success','تم تحديث البيانات بنجاح');
//        }catch ( \Exception $ex){
//            return redirect()->back()->with('error','خطاء في تحديث البيانات برجاء المحاوله مره اخري');
//            DB::rollBack();
//        }
    }
    public function Datatable()
    {
        $dataView['allBrands'] = Brands::allBrands()->get();
        return Datatables::of($dataView['allBrands'])
            ->addColumn('id', function (Brands $brand) {
                return $brand->id;
            })->addColumn('name', function (Brands $brand) {
                return $brand->translate('ar')-> name;
            })->addColumn('image', function (Brands $brand) {
                return '<img src="'.$brand->image.'"  data-id="'.$brand->id.'" data-toggle="modal" data-target="#update-img"  alt="" title="Edit Image" class="img-rounded img-responsive center-block img-edit imagenumber'.$brand->id.'" />';
            })->addColumn('totalproduct', function (Brands $brand) {
                return 0;
            })->addColumn('status', function (Brands $brand) {

                if ($brand->status == 1) {
                    return '<span data-id="' . $brand->id . '" title="update Status" data-target="on" class="status on ">' . $brand->getActive() . '</span>';
                } else {
                    return '<span data-id="' . $brand->id . '" title="update Status"  data-target="off" class="status off"> ' . $brand->getActive() . '</span>';
                }
            })->addColumn('action', function (Brands $brand) {
//                return '<ul class="actions">
//					<li><a href="' . route('category.edit', $category->id) . '"  class="" id="' . $category->id . '" ><i class="la la-edit "></i></a></li>
//					<li><a href=""  data-toggle="modal"  data-id="' . $category->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="la la-trash red"></i></li>
//				</ul>';
                return '<div class="btn-group">
                  <a class="btn btn-purple dropdown-toggle" href="javascript:;" data-toggle="dropdown"><i class="fa fa-angle-down"></i><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a> <div class="dropdown-menu pull-right">
                  <li><a href="' . route('brand.edit', $brand->id) . '"  class="" id="' . $brand->id . '" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i>تعديل</a></li>
                    <li><a href="' . route('brand.showdetails', $brand->id) . '"  class="" id="' . $brand->id . '" ><i class="fa fa-eye" aria-hidden="true"></i></i>عرض</a></li>
                   <li><a href=""  data-toggle="modal"  data-id="' . $brand->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>خذف</li>
                    </div></div>';
            })->rawColumns(['image', 'status', 'action'])->make(true);
    }
    public function showdetails($id)
    {
        //check if brand is founf
        $dataView['brand'] = Brands::IsExist($id)->first();
        if(!$dataView['brand'])
            return view('layouts.error');
        else
            $dataView['brand'] ->makeVisible(['translations']);
        $dataView['title'] = 'تفاصيل البراند';
        return  view('dashboard.brand.showdetails')->with($dataView);

    }
    //start create pdf
    public function pdf()
    {
        $title = 'جميع البراندات';
        $allBrands = Brands::Allbrands()->get();
        $allBrands ->makeVisible(['translations']);
        $pdf = PDF::loadView('dashboard.brand.pdf',compact('title','allBrands'));
        $pdf->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('جميع البراندات');
    }
    //export to csv
    public function CSV()
    {

        return Excel::download(new BrandsExport, 'brands.xlsx');
        redirect(Request::url('brand.index'));
    }
    //start update image
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
                $Data = Brands::where(['deleted'=>1,'id'=>$id])->update($updatedData);
                if(false != $Data)
                {
                    return response(['status'=>'success',"message"=>"تم تعديل البيانات بنجاح","image"=>$updatedData['image']]);

                }else{
                    return response(['status'=>'error',"message"=>"خطاء في تحديث البيانات برجاء المحاوله مره اخري"]);
                }

            }
        }
    }
    // strat update status
    // start delete category
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
                $Data = [
                    "last_updated_by" => $user_id,
                    "deleted" => 2
                ];
                $brand = Brands::IsExist($id)->first();
                if (!$brand)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                    DB::beginTransaction();
                $brand->update($Data);
                $brandReport = BrandsReports ::where(['deleted'=>1,'id'=>$id])->update($Data);
                DB::commit();
                return response(['status' => 'success', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"id="type-error">تم تحديث البيانات بنجاح </button></div>']);
            } catch (\Exception $ex) {
                return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                DB::rollBack();
            }
        }
    }

    // start update status
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
                $brand = Brands::IsExist($id)->first();
                if (!$brand)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                    DB::beginTransaction();
                $brand->update($updatedData);
                $categoryReport = BrandsReports::where(['deleted'=>1,'id'=>$id])->update($updatedData);
                DB::commit();
                return response(['status' => 'success', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"id="type-error">تم تحديث البيانات بنجاح </button></div>']);
            }catch (\Exception $ex)
            {
                return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                DB::rollBack();
            }


        }
    }



}

