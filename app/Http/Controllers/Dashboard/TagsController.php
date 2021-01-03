<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Http\Requests\TagRequest   ;
Use App\Traites\helperTrait;
use App\Models\TagsTranslation;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\TagExport;



class TagsController extends Controller
{
    use helperTrait;
    public function index()
    {
        $dataView['title'] = 'جميع  التاجات ';
        return view('dashboard.tags.getall')->with($dataView);
    }
    public function create()
    {
        $dataView['title'] = 'اضافه تاج المنتج';
        return view('dashboard.tags.create')->with($dataView);

    }

    // start add data
    public function store(TagRequest $request)
    {
//        try{
            // prepare data
            $validatedData = array(
                'link_name'       => $request->link_name,
                'status'          => $request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'created_by'      => auth('admin')->user()->id,
                'created'         => time(),
                'en' => [
                    'name'        => $request->name_en,
                ],
                'ar' => [
                    'name'       => $request->name_ar,
                ],
            );

            // start add data
            DB::beginTransaction();
        $add = Tags::create($validatedData);
        DB::commit();
            return redirect()->back()->with('success','تم اضافه البيانات بنجاح');
//        }catch ( \Exception $ex){
//            return redirect()->back()->with('error','خطاء في اضافه البيانات برجاء المحاوله مره اخري');
//            DB::rollBack();
//        }

    }

    // start edit  category
    public function edit($id)
    {
        //check if category is founf
        $dataView['tag'] = Tags::IsExist($id)->first();
        if(!$dataView['tag'])
            return view('layouts.error');
        else
        $dataView['tag'] ->makeVisible(['translations']);
        $dataView['title'] = 'تعديل  التاج';
        return  view('dashboard.tags.edit')->with($dataView);

    }

    public function update(TagRequest $request,$id)
    {

//        try{
            // prepare data
            $validatedData = array(
                'link_name'       => $request->link_name,
                'status'          => $request->status,
                'last_updated_by' => auth('admin')->user()->id,
                'en' => [
                    'name'        => $request->name_en,
                ],
                'ar' => [
                    'name'       => $request->name_ar,
                ],
            );

            // check is brand id found
            $tag = Tags::IsExist($id)->first();
            if(!$tag)
                return view('layouts.error');
            DB::beginTransaction();
            $tag->update($validatedData);
            DB::commit();
            return redirect()->back()->with('success','تم تحديث البيانات بنجاح');
//        }catch ( \Exception $ex){
//            return redirect()->back()->with('error','خطاء في تحديث البيانات برجاء المحاوله مره اخري');
//            DB::rollBack();
//        }

    }
    public function Datatable()
    {
        $dataView['allTags'] = Tags::AllTags()->get();
        return Datatables::of($dataView['allTags'])
            ->addColumn('id', function (Tags $tag) {
                return $tag->id;
            })->addColumn('name', function (Tags $tag) {
                //return $category->translate('ar')-> name.'-' . $category->translate('en')-> name;
                return $tag->translate('ar')-> name;
            })->addColumn('link_name', function (Tags $tag) {
                return $tag-> link_name;
            })->addColumn('status', function (Tags $tag) {

                if ($tag->status == 1) {
                    return '<span data-id="' . $tag->id . '" title="update Status" data-target="on" class="status on ">' . $tag->getActive() . '</span>';
                } else {
                    return '<span data-id="' . $tag->id . '" title="update Status"  data-target="off" class="status off"> ' . $tag->getActive() . '</span>';
                }
            })->addColumn('action', function (Tags $tag) {
//                return '<ul class="actions">
//					<li><a href="' . route('category.edit', $category->id) . '"  class="" id="' . $category->id . '" ><i class="la la-edit "></i></a></li>
//					<li><a href=""  data-toggle="modal"  data-id="' . $category->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="la la-trash red"></i></li>
//				</ul>';
                return '<div class="btn-group">
                  <a class="btn btn-purple dropdown-toggle" href="javascript:;" data-toggle="dropdown"><i class="fa fa-angle-down"></i><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a> <div class="dropdown-menu pull-right">
                  <li><a href="' . route('tags.edit', $tag->id) . '"  class="" id="' . $tag->id . '" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i>تعديل</a></li>
                    <li><a href="' . route('tags.showdetails', $tag->id) . '"  class="" id="' . $tag->id . '" ><i class="fa fa-eye" aria-hidden="true"></i></i>عرض</a></li>
                   <li><a href=""  data-toggle="modal"  data-id="' . $tag->id . '" data-target="#deleteModal" class="deleteIcon" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>حذف</li>
                    </div></div>';
            })->rawColumns(['image', 'status', 'action'])->make(true);
    }
    public function showdetails($id)
    {
        //check if tag is founf
        $dataView['tag'] = Tags::IsExist($id)->first();
        if(!$dataView['tag'])
            return view('layouts.error');
        else
            $dataView['tag'] ->makeVisible(['translations']);
        $dataView['title'] = 'تفاصيل التاج';
        return  view('dashboard.tags.showdetails')->with($dataView);

    }
    //start create pdf
    public function pdf()
    {
        $title = 'جميع التاجات';
        $allTags = Tags::AllTags()->get();
        $allTags ->makeVisible(['translations']);
        $pdf = PDF::loadView('dashboard.tags.pdf',compact('title','allTags'));
        $pdf->setPaper('a4')->setOrientation('landscape');
        return $pdf->stream('جميع التاجات');
    }
    //export to csv
    public function CSV()
    {

        return Excel::download(new TagExport, 'tags.xlsx');
        redirect(Request::url('tags.index'));
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
                $tagData = [
                    "last_updated_by" => $user_id,
                    "deleted" => 2
                ];
                $tag = Tags::IsExist($id)->first();
                if (!$tag)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                    DB::beginTransaction();
                $tag->update($tagData);
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
                $tag = Tags::IsExist($id)->first();
                if (!$tag)
                    return response(['status' => 'error', "message" => ' <div class="row mr-2 ml-2"><button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"id="type-error">خطاء في تحديث  البانات </button></div>']);
                else
                    DB::beginTransaction();
                $tag->update($updatedData);
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

