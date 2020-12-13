@extends('layouts.admin')
@section("title",'تعديل  الملف الشخصي')

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
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"><h3>{{$admin->name}} </h3> </div>
                            </div>


                            <!-- END MENU -->
                        </div>

                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{$title}}</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">البيانات الشخصيه</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">الصوره الشخصيه</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">تغير كلمه المرور</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                @include('dashboard.includes.alerts.success')
                                                @include('dashboard.includes.alerts.errors')
                                                <form class="form-horizontal form-bordered"
                                                      action="{{route('profile.update',$admin->id)}}"
                                                      method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label class="control-label">الاسم</label>
                                                        <input type="text" value="{{$admin -> name }}" name="name" placeholder="" class="form-control" />
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">البريد الاليكتروني </label>
                                                        <input type="text" name="email" value="{{$admin->email}}" placeholder="" class="form-control" />
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">العنوان</label>
                                                        <input type="text" name="address"  value="{{$admin->address}}" placeholder="" class="form-control" />
                                                        @error("address")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">التليفون</label>
                                                        <input type="text" name="phone" value="{{$admin->phone}}" placeholder="" class="form-control" />
                                                        @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$admin->id}}" />
                                                    <div class="form-group form-md-radios">
                                                        <label>الحاله</label>
                                                        <div class="md-radio-inline">

                                                            <div class="md-radio">
                                                                <input type="radio" id="radio7" value="1"  {{ ($admin->status == 1) ? "checked" : " " }} name="status" class="md-radiobtn" checked="">
                                                                <label for="radio7">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> مفعل</label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio8"  value="2"  {{ ($admin->status == 2) ? "checked" : " " }} name="status" class="md-radiobtn">
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
                                            <div class="tab-pane" id="tab_1_2">
                                                <p>
                                                    الصوره الشخصيه
                                                </p>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{route('profile.update_image',$admin->id)}}"
                                                      method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="{{asset('upload/'.$admin->image.'')}}"   data-toggle="modal"  data-id="{{$admin->id}}"  data-target="#update-img"  alt="" title="Edit Image" class=" img-edit imagenumber'.{{$admin->id}}.'" />
                                                            </div>

                                                        </div>

                                                    </div>

                                                </form>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <div id="updatePasswordResult"></div>
                                                <form id="EditPassword" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label class="control-label">كلمه المرور الجديده</label>
                                                        <input type="password" class="form-control"  id="password" name="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"> تاكيد كلمه المرور الجديده</label>
                                                        <input type="password" class="form-control" id="repassword" name="repassword">

                                                    </div>
                                                    <input type="hidden" name="id" value="{{$admin->id}}" />

                                                    <div class="form-actions  ">
                                                        <button type="button" class="btn purple" onclick="history.back()">
                                                            <i class="fa fa-times"></i>                                  تراجع
                                                        </button>
                                                        <button type="submit" name="editPass" class="btn blue">
                                                            <i class="fa fa-check"></i> حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->

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
    <div class="modal fade" id="update-img" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">تغير الصوره الشخصيه</h4>
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
                                    <label for="category-image"> الصوره الشخصيه</label>
                                    <input type="file" name="image" id="image-file">
                                    <p class="help-block">اختر الصوره.</p>
                                </div>
                                <input type="hidden" name="id" value="{{$admin->id}}" class="id" />
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


@stop
@section('script')
    <script >
        $(document).ready(function() {
            //start update password
            $("#EditPassword").submit(function(){
                var formData = $(this).serialize();
                var allData  = formData + "&action=editPass";
                $('#repassword_error').text('');
                $('#password_error').text('');
                $.ajax({
                    url: "{{url("admin/profile/update_password/{id}")}}",
                    type:"POST",
                    data: allData,
                    beforeSend:function(){
                        //alert(allData)
                    },
                    statusCode: {
                        404: function() {
                            alert( "page not found" );
                        },
                    },
                    success:function(valdata) {
                        //alert(valdata);
                        //alert("")
                        if(valdata.status == "success")
                        {
                            $("#updatePasswordResult").html(valdata.message);
                           // setTimeout(function(){$('#changepassword').modal('hide');}, 2000);
                        }else{
                            $("#updatePasswordResult").html(valdata.message);
                        }
                    },
                    error: function (reject) {
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    }

                });
                return false;
            });

            // start update image
            $("body").on( 'click', '.img-edit', function () {
                var self = this;
                $("#updateImageResult").html("");
                // get id for update
                var myId = $(self).attr("data-id");
                // get image
                var image = $(self).attr("src");
                // set image into model
                $(".old-image").attr("src",image);
                // set  id in hidden input
                $(".id").attr("value",myId);
                $("#updateImage").submit(function(){

                    $.ajax({
                        url: "{{url("admin/profile/update_image/{id}")}}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData:false,
                        beforeSend:function(){
                            $(".loadingImage").show();
                        },
                        statusCode: {
                            404: function() {
                                alert( "page not found" );
                            },
                        },
                        success:function(valdata) {

                            if(valdata.status == "success")
                            {
                                $("#updateImageResult").html('<div class="alert alert-success" role="alert"><strong>Success </strong> Image Updated Successfuly </div>');
                                $('#update-img').modal('hide');
                                // get image row id to change image when success
                                $(self).attr("src",'http://127.0.0.1:8000/upload/'+valdata.image);
                            }else{
                                $('#update-img').modal('show');
                                $("#updateImageResult").html('<div class="alert alert-danger" role="alert"><strong> Error ! </strong> Error Update Your Image (Not Allowed Image Extension Or You Did Not Choose Image)</div>');

                            }
                        }
                    });
                    return false;
                });
            });

        });
    </script>

@stop

