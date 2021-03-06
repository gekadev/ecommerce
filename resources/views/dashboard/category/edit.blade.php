@extends('layouts.admin')
@section("title",'تعديل  القسم')

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>{{$title}}</h1>

                </div>
                <!-- END PAGE TITLE -->

            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">الرئيسيه</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{$title}}</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="tab-pane" id="tab_1">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-blue-hoki"></i>
                            <span class="caption-subject font-blue-hoki bold uppercase">{{$title}}</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse"> </a>
                            <a href="" class="reload"> </a>
                            <a href="" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        @include('dashboard.includes.alerts.success')
                        @include('dashboard.includes.alerts.errors')
                        <form method="post"
                              enctype="multipart/form-data"
                              action ="{{route('category.update',$category -> id)}}"
                              class  ="horizontal-form" >
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6  ">
                                        <div class="form-group ">
                                            <label  class="control-label "> الاسم</label>
                                            <input type="text"  value="{{$category ->translate('ar')-> name }}" name="name_ar" class="form-control" placeholder="">
                                            @error("name_ar")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class=" control-label">الوصف</label>
                                            <div class="">


                                                <textarea name="description_ar" id="adr_description" class="form-control" rows="3">{{$category ->translate('ar')-> description }}</textarea>
                                            </div>
{{--                                            <script>--}}
{{--                                                CKEDITOR.replace( 'description_ar' );--}}
{{--                                            </script>--}}
                                            @error("ar_description")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label class="control-label">الرابط</label>
                                            <input type="texte" name="url"  value="{{$category ->url}}"  class="form-control" placeholder="">
                                            @error("url")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>



                                        <div class="form-group form-md-radios ">
                                            <label>نوع القسم</label>
                                            <div class="md-radio-inline">

                                                <div class="md-radio">
                                                    <input type="radio" id="radio71"  value="1"   name="sub" class="md-radiobtn sub" {{!is_null($category ->parent_id )? "checked" :""}}>
                                                    <label for="radio71">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> قسم فرعي</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="radio81"  value="2"   name="sub" class="md-radiobtn sub" {{is_null($category ->parent_id) ?"checked" :"" }}>
                                                    <label for="radio81">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> قسم رئيسي </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-md-radios">
                                            <label>الحاله</label>
                                            <div class="md-radio-inline">

                                                <div class="md-radio">
                                                    <input type="radio" id="radio7" value="1"  {{ ($category->status == 1) ? "checked" : " " }} name="status" class="md-radiobtn" checked="">
                                                    <label for="radio7">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> مفعل</label>
                                                </div>
                                                <div class="md-radio">
                                                    <input type="radio" id="radio8"  value="2"  {{ ($category->status == 2) ? "checked" : " " }} name="status" class="md-radiobtn">
                                                    <label for="radio8">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> غير مفعل </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" name="id" value="{{$category -> id}}">

                                    <!--/span-->
                                    <div class="col-md-6 en"  >
                                        <div class="form-group ">
                                            <label  class="control-label"> Name</label>
                                            <input   type="text"  value="{{$category ->translate('en')-> name }}" name="name_en" class="form-control" placeholder="">
                                            @error("name_en")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class=" control-label">Description</label>
                                            <div class="">
                                                <textarea name="description_en"  class="form-control" rows="3">{{$category ->translate('en')-> description }}</textarea>
                                            </div>
{{--                                            <script>--}}
{{--                                                CKEDITOR.replace( 'description_en' );--}}
{{--                                            </script>--}}
                                            @error("en_description")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label class="control-label">Link Name</label>
                                            <input type="text" name="slug"  value="{{$category ->slug}}"  class="form-control" placeholder="">
                                            @error("slug")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group main_category" <?php if($category->parent_id != NULL ) echo "style='display:block !important'"; ?>>
                                            <label for="exampleInputEmail1">Main Category</label>
                                            <select name="category_id"  class="form-control chosen">
                                            @isset($allCategories)
                                                @forelse($allCategories as $key => $data)
                                                    @if($category ->parent_id == $data->id)

                                                            <option selected="selected" value='{{$data->id}}' >{{$data->translate('en')->name.' -' .$data->translate('ar')->name }}</option>
                                                        @else


                                                            <option  value='{{$data->id}}' >{{$data->translate('en')->name.' -' .$data->translate('ar')->name }}</option>
                                                        @endif
                                                    @empty
                                                        <option value="0">No Data Found</option>

                                                            @endforelse
                                                @endisset

                                            </select>
                                            <p class="help-block">Select Main Category<p>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                                <!--/row-->
                            </div>
                            <div class="form-actions  ">
                                <button type="button" class="btn purple" onclick="history.back()">
                                    <i class="fa fa-times"></i>                                  تراجع
                                </button>
                                <button type="submit" class="btn blue">
                                    <i class="fa fa-check"></i> حفظ</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>

                </div>
            </div>




            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->

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

@stop
@section('script')

    <script >
        $(document).ready(function() {
            $(".chosen").chosen();

            // start show and hidden main category
            $(".sub").change(function(){
                var value = $(this).val();
                if(value == 1)
                {
                    $(".main_category").show();
                }else{
                    $(".main_category").hide();

                }
            });
            // end show and hidden main category


        });
    </script>

@stop
