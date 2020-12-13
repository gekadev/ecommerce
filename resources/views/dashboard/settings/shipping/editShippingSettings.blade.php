@extends('layouts.admin')
@section("title",trans('تعديل وسيله الشحن'))

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>تعديل وسيله الشحن</h1>

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
                    <span class="active">تعديل وسيله الشحن</span>
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
                            <span class="caption-subject font-blue-hoki bold uppercase">{{trans('dashboard\shipping.title')}}</span>
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
                              action ="{{route('settings.updateShippingMethods',$shippingMethode -> id)}}"
                              class  ="horizontal-form" >
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6  ">
                                        <div class="form-group ">
                                            <label  class="control-label "> الاسم</label>
                                            <input type="text"  value="{{$shippingMethode ->translate('ar')-> value }}" name="value_ar" class="form-control" placeholder="">
                                            @error("value_ar")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label">قيمه التوصيل</label>
                                            <input type="number" name="plain_value"  value="{{$shippingMethode ->plain_value}}"  class="form-control" placeholder="">
                                            @error("plain_value")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <input type="hidden" name="id" value="{{$shippingMethode -> id}}">
                                    <!--/span-->
                                    <div class="col-md-6 en"  >
                                        <div class="form-group ">
                                            <label  class="control-label"> Name</label>
                                            <input   type="text"  value="{{$shippingMethode ->translate('en')-> value }}" name="value_en" class="form-control" placeholder="">
                                            @error("value_en")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>


                                    </div>


                                    <!--/span-->
                                </div>
                            <!--    <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label class="control-label">قيمه التوصيل</label>
                                            <input type="number" name="plain_value"  value="{{$shippingMethode ->plain_value}}"  class="form-control" placeholder="">
                                            @error("plain_value")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div> -->

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

