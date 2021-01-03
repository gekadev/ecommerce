@extends('layouts.admin')
@section("title",'تفاصيل القسم')

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>{{$title}}

                    </h1>
                </div>

            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">الرئيسيه</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{$title}} </span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">

                    </div>
                </div>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">{{$title}}</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">


                            <table class="table  table-striped table-bordered " id="sample_1">
                                <tr>

                                    <td><strong> الرقم </strong></td>

                                    <td><strong>{{$category ->id}}</strong></td>

                                </tr>
                                <tr>

                                    <td><strong>نوع القسم</strong></td>

                                    <td><strong>{{$category ->CategoryType()}}</strong></td>

                                </tr>

                                <tr>

                                    <td><strong>الاسم باللغه العربيه </strong></td>

                                    <td><strong>{{$category ->translate("ar")->name}}</strong></td>

                                </tr>

                                <tr>

                                    <td><strong> الاسم باللغه الانجليزيه</strong></td>

                                    <td><strong>{{$category ->translate("en")->name}}</strong></td>

                                </tr>

                                <tr>

                                    <td><strong> الوصف باللغه العربيه</strong></td>

                                    <td><strong>{{$category ->translate("ar")->description}}</strong></td>

                                </tr>



                                <tr>

                                    <td><strong> الوصف باللغه الانجليزيه</strong></td>

                                    <td><strong>{{$category ->translate("en")->description}}</strong></td>

                                </tr>

                                <tr>

                                    <td><strong>الاسم بالرابط</strong></td>

                                    <td><strong>{{$category ->slug}}</strong></td>

                                </tr>
                                <tr>

                                    <td><strong>الحاله</strong></td>

                                    <td><strong>{{$category ->getActive()}}</strong></td>

                                </tr>


                                <tr>

                                    <td><strong> تاريخ الانشاء</strong></td>

{{--                                    <td><strong><?php echo date("Y/m/d h:i:s A",$reservation['created']); ?></strong></td>--}}
                                    <td><strong>{{date("Y/m/d h:i:s A",$category ->created)}}</strong></td>

                                </tr>

                            </table>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->

                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler">
        <i class="icon-login"></i>
    </a>
    <!-- END QUICK SIDEBAR -->
    </div>

    <!-- END CONTAINER -->
    <div class="modal fade" id="update-img" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">تعديل الصوره</h4>
                </div>
                <div class="modal-body">
                    <div id="updateImageResult"></div>
                    <div class="row">
                        <div  class="col-lg-9 pull-left">
                            <form id="updateImage"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                {{--                                @method('PUT')--}}
                                <div class="form-group">
                                    <label for="category-image"> الصوره </label>
                                    <input type="file" name="image" id="image-file">
                                    <p class="help-block">اختر الصوره.</p>
                                </div>
                                <input type="hidden" name="id" value="" class="id" />
                                <input type="submit" class="btn btn-primary updatebtn" name="editImage" value="حفظ" />
                                <span class="loadingImage">
					            	<img src="customize\backend\images\Preloader_61.gif" />
					             </span>
                            </form>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <img src="" alt="" title="Edit Image" class="img-responsive old-image" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Delete Modal -->
    <div class="modal fade" id="deleteModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">هل تريد حذف البيانات</h4>
                </div>
                <div class="modal-body">
                    <div id="deleteResult"></div>

                    <input type="submit"  class="btn btn-primary del" name="delete" value="حذف" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Delete Modal-->



@stop


