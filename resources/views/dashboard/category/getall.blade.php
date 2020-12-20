@extends('layouts.admin')
@section("title",'جميع الاقسام')

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
                        <div class="col-md-12 ">
                            <div class="dt-buttons but">

                                <a href="{{route('category.create')}}" class="dt-button buttons-pdf buttons-html5 btn red btn-outline" tabindex="0" aria-controls="sample_1"> <i class="fa fa-plus fa "></i><span> اضافه قسم</span></a>
                                <a  href="{{route('category.pdf')}}" target="_blank" class="dt-button buttons-pdf buttons-html5 btn purple  btn-outline" tabindex="0" aria-controls="sample_1"><span>تصدير pdf</span></a>
                                <a  href="{{route('category.CSV')}}" class="dt-button buttons-csv buttons-html5 btn green btn-outline" tabindex="0" aria-controls="sample_1"><span>تصدير CSV</span></a>
                            </div>
                        </div>
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">{{$title}}</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table  table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> م </th>
                                    <th> الاسم </th>
                                    <th> الاسم بالرابط </th>
                                    <th> الصوره</th>
                                    <th> الحاله </th>
                                    <th> القرار </th>


                                </tr>
                                </thead>
                                <tbody>


                                </tbody>
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
@section('script')
    <script >
        $(document).ready(function() {
            $(document).ready( function () {
                $('#sample_1').DataTable();
            } );
            //datatables
            $('#sample_1').DataTable({
                "pagingType": "full_numbers",
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{!!route('category.DataTabel')!!}",
                    "type": "PUT",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },},
                "columns": [
                    {data: 'id',             name: 'id'},
                    {data: 'name',           name: 'name'},
                    {data: 'slug',           name: 'slug'},
                    {data: 'image',          name: 'image'},
                    {data: 'status',         name: 'status'},
                    {data: 'action',         name: 'action'},

                ]
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
                        url: "{{url("admin/category/update_image/{id}")}}",
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
            //start update status
            $("body").on( 'click', '.status', function () {
                var self = this;
                var myId = $(self).attr("data-id");
                var myaction = "updateStatus";
                var mystatus = $(self).attr("data-target");
                var allData = {"action":myaction,"id":myId,"status":mystatus,"_token":'{{csrf_token()}}'};
                $.ajax({
                    url: "{{url("admin/category/updateStatus/{id}")}}",
                    type:"PUT",
                    dataType:"json",
                    data: allData,
                    beforeSend:function(){
                    },
                    statusCode: {
                        404: function() {
                            alert( "page not found" );
                        },
                    },
                    success:function(valdata) {
                        if(valdata.status == "success")
                        {
                            if(mystatus == "on")
                            {
                                $(self).removeClass("on").html("غ.مفعل").addClass("off").attr("data-target","off");
                            }else{
                                $(self).removeClass("off").html("مفعل").addClass("on").attr("data-target","on") ;
                            }
                        }else{
                            alert("faild");
                        }
                    }
                });
                return false;
            });
            // start delete
            $("body").on( 'click', '.deleteIcon', function () {
                var self = this;
                $("#deleteResult").html("");
                var myId = $(this).attr("data-id");
                var myaction = "deleteData";
                var allData = {"action":myaction,"id":myId,"_token":'{{csrf_token()}}'};
                $(".del").click(function(){
                    $.ajax({
                        url: "{{url("admin/category/delete/{id}")}}",
                        type:"put",
                        data: allData,
                        beforeSend:function(){
                        },
                        statusCode: {
                            404: function() {
                                alert( "page not found" );
                            },
                        },
                        success:function(valdata) {
                            if(valdata.status == "success")
                            {
                                $("#deleteResult").html(valdata.message);
                                $('#deleteModal').modal('hide');
                                // $("#row"+myId).fadeOut(1000);
                                $(self).closest("tr").fadeOut(1000);
                                $('#all_data').DataTable().ajax.reload()
                            }else{
                                $("#deleteResult").html(valdata.message);
                            }
                        }
                    });
                    return false;
                });
            });



        });
    </script>

@stop

