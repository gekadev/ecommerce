<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\CategoryReport;
use App\Http\Requests\CategoryRequest   ;
Use App\Traites\helperTrait;
use App\Models\CategoryTranslation;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\CategoryExport;



class CategoryController extends Controller
{
    use helperTrait;
    public function index()
    {
        $dataView['title'] = 'جميع الاقسام';
        return view('dashboard.category.getall')->with($dataView);
    }
    public function create()
    {
        $dataView['title'] = 'اضافه قسم';
        $dataView['allCategories'] = Category::Allcategories()->get();
        $dataView['allCategories'] ->makeVisible(['translations']);
        return view('dashboard.category.create')->with($dataView);

    }

    // start add data
    public function store(CategoryRequest $request)
    {
        try{
            // prepare data
            $validatedData = array(
                'url' => $request->url,
                'slug' => $request->slug,
                'status' => $request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'created_by'      => auth('admin')->user()->id,
                'created'         => time(),
                "image"           => UploadImage($request,"image"),
                'en' => [
                    'name'       => $request->name_en,
                    'description' => $request->description_en,
                ],
                'ar' => [
                    'name'       => $request->name_ar,
                    'description' => $request->description_ar,
                ],
            );

            //start define categoru is sub or main
            $request ->sub ==1 ?  $validatedData['parent_id'] = $request ->category_id: $validatedData['parent_id']=null;
            // start add data
            DB::beginTransaction();
        $add = Category::create($validatedData);
        $id = $add->id;
        //add data in category report
            $categoryReport = CategoryReport::create(
                ['status'           =>$validatedData['status'],
                 'category_id'      =>$id,
                 'created_by'       =>$validatedData['created_by']
                 ,'last_updated_by' =>$validatedData['last_updated_by']]);
        DB::commit();
            return redirect()->back()->with('success','تم اضافه البيانات بنجاح');
        }catch ( \Exception $ex){
            return redirect()->back()->with('error','خطاء في اضافه البيانات برجاء المحاوله مره اخري');
            DB::rollBack();
        }

    }

    // start edit  category
    public function edit($id)
    {
        //check if category is founf
        $dataView['category'] = Category::IsExist($id)->first();
        if(!$dataView['category'])
            return view('layouts.error');
        else
        $dataView['category'] ->makeVisible(['translations']);
        $dataView['title'] = 'تعديل  القسم';
        $dataView['allCategories'] = Category::Allcategories()->get();
        $dataView['allCategories'] ->makeVisible(['translations']);
        return  view('dashboard.category.edit')->with($dataView);

    }

    public function update(CategoryRequest $request,$id)
    {
        try{
            // prepare data
            $validatedData = array(
                'url' => $request->url,
                'slug' => $request->slug,
                'status' => $request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'created_by'      => auth('admin')->user()->id,
                'created'         => time(),
                'en' => [
                    'name'       => $request->name_en,
                    'description' => $request->description_en,
                ],
                'ar' => [
                    'name'       => $request->name_ar,
                    'description' => $request->description_ar,
                ],
            );

            // check is category id found
            $category = Category::IsExist($id)->first();
            if(!$category)
                return view('layouts.error');
            //start define categoru is sub or main
            $request ->sub ==1 ?  $validatedData['parent_id'] = $request ->category_id: $validatedData['parent_id']=null;
            // start update data
            DB::beginTransaction();
             $category->update($validatedData);
            // strat update category report
            $categoryReport = CategoryReport::where(['deleted'=>1,'id'=>$id])->update(['status'=>$validatedData['status']]);
            DB::commit();
            return redirect()->back()->with('success','تم تحديث البيانات بنجاح');
        }catch ( \Exception $ex){
            return redirect()->back()->with('error','خطاء في تحديث البيانات برجاء المحاوله مره اخري');
            DB::rollBack();
        }
    }
    public function Datatable()
    {
        $dataView['allcategories'] = Category::Allcategories()->get();
        return Datatables::of($dataView['allcategories'])
            ->addColumn('id', function (Category $category) {
                return $category->id;
            })->addColumn('name', function (Category $category) {
                //return $category->translate('ar')-> name.'-' . $category->translate('en')-> name;
                return $category->translate('ar')-> name;
            })->addColumn('image', function (Category $category) {
                return '<img src="/upload/'.$category->image.'"  data-id="'.$category->id.'" data-toggle="modal" data-target="#update-img"  alt="" title="Edit Image" class="img-rounded img-responsive center-block img-edit imagenumber'.$category->id.'" />';

            })->addColumn('status', function (Category $category) {

                if ($category->status == 1) {
                    return '<span data-id="' . $category->id . '" title="update Status" data-target="on" class="status on ">' . $category->getActive() . '</span>';
                } else {
                    return '<span data-id="' . $category->id . '" title="update Status"  data-target="off" class="status off"> ' . $category->getActive() . '</span>';
                }
            })->addColumn('action', function (Category $category) {
//                return '<ul class="actions">
//					<li><a href="' . route('category.edit', $category->id) . '"  class="" id="' . $category->id . '" ><i class="la la-edit "></i></a></li>
//					<li><a href=""  data-toggle="modal"  data-id="' . $category->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="la la-trash red"></i></li>
//				</ul>';
                return '<div class="btn-group">
                  <a class="btn btn-purple dropdown-toggle" href="javascript:;" data-toggle="dropdown"><i class="fa fa-angle-down"></i><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a> <div class="dropdown-menu pull-right">
                  <li><a href="' . route('category.edit', $category->id) . '"  class="" id="' . $category->id . '" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i>تعديل</a></li>
                    <li><a href="' . route('category.showdetails', $category->id) . '"  class="" id="' . $category->id . '" ><i class="fa fa-eye" aria-hidden="true"></i></i>عرض</a></li>
                   <li><a href=""  data-toggle="modal"  data-id="' . $category->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>خذف</li>
                    </div></div>';
            })->rawColumns(['image', 'status', 'action'])->make(true);
    }
    public function showdetails($id)
    {
        //check if category is founf
        $dataView['category'] = Category::IsExist($id)->first();
        if(!$dataView['category'])
            return view('layouts.error');
        else
            $dataView['category'] ->makeVisible(['translations']);
        $dataView['title'] = 'تفاصيل القسم';
        return  view('dashboard.category.showdetails')->with($dataView);

    }
    //start create pdf
    public function pdf()
    {
        $title = 'جميع الاقسام';
        $allCategories = Category::Allcategories()->get();
        $allCategories ->makeVisible(['translations']);
        $pdf = PDF::loadView('dashboard.category.pdf',compact('title','allCategories'));
        $pdf->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('جميع الاقسام');
    }
    //export to csv
    public function CSV()
    {

        return Excel::download(new CategoryExport, 'category.xlsx');
        redirect(Request::url('category.index'));
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
                $Data = Category::where(['deleted'=>1,'id'=>$id])->update($updatedData);
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
                $categoryData = [
                    "last_updated_by" => $user_id,
                    "deleted" => 2
                ];
                $category = Category::IsExist($id)->first();
                if (!$category)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                    DB::beginTransaction();
                $category->update($categoryData);
                $categoryReport = CategoryReport ::where(['deleted'=>1,'id'=>$id])->update($categoryData);
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
                $category = Category::IsExist($id)->first();
                if (!$category)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                    DB::beginTransaction();
                $category->update($updatedData);
                $categoryReport = CategoryReport::where(['deleted'=>1,'id'=>$id])->update($updatedData);
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

