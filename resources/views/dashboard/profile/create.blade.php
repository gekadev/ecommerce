@extends('layouts.admin')
@section("title",' اضافه موظف ')

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
                    <span class="active">{{$title}}</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
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
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                @include('dashboard.includes.alerts.success')
                                                @include('dashboard.includes.alerts.errors')
                                                <form class="form-horizontal form-bordered"
                                                      action="{{route('profile.store')}}"
                                                      method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label class="control-label">الاسم</label>
                                                        <input type="text" value="{{old('name')}}" name="name" placeholder="" class="form-control" />
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">البريد الاليكتروني </label>
                                                        <input type="text" name="email" value="{{old('email')}}" placeholder="" class="form-control" />
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">العنوان</label>
                                                        <input type="text" name="address"  value="{{old('address')}}" placeholder="" class="form-control" />
                                                        @error("address")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">التليفون</label>
                                                        <input type="text" name="phone"  value="{{old('phone')}}" placeholder="" class="form-control" />
                                                        @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">كلمه المرور</label>
                                                        <input type="password" name="password" value="" placeholder="" class="form-control" />
                                                        @error("password")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">تاكيد كلمه المرور</label>
                                                        <input type="password" name="repassword" value="" placeholder="" class="form-control" />
                                                        @error("repassword")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group ">
                                                        <label class="control-label">الرابط</label>
                                                        <input type="file" id="file" name="image">
                                                        @error("image")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group form-md-radios">
                                                        <label>الحاله</label>
                                                        <div class="md-radio-inline">

                                                            <div class="md-radio">
                                                                <input type="radio" id="radio7" value="1"   name="status" class="md-radiobtn" checked="checked">
                                                                <label for="radio7">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> مفعل</label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio8"  value="2"   name="status" class="md-radiobtn">
                                                                <label for="radio8">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> غير مفعل </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions  ">
                                                        <button type="button" class="btn purple" onclick="history.back()">
                                                            <i class="fa fa-times"></i>                                  تراجع
                                                        </button>
                                                        <button type="submit" class="btn blue">
                                                            <i class="fa fa-check"></i> حفظ</button>
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
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


@stop


