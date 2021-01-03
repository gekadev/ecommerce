<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title></title>

    <!-- Bootstrap core CSS -->
    <style type="text/css">
        .page {
            overflow: hidden;
            page-break-after: always;
        }
        .page:last-of-type {
            page-break-after: auto
        }
    </style>
    <style>
        tr{
            background-color: #f1f1f1;
        }


        .table {
            display: table;
            border-collapse: separate;
            box-sizing: border-box;
            text-indent: initial;
            white-space: normal;
            line-height: normal;
            font-weight: normal;
            font-size: medium;
            font-style: normal;
            color: -internal-quirk-inherit;
            text-align: start;
            border-spacing: 0px;
            border-color: black;
            font-variant: normal;
            background-color: #f1f1f1;
            text-align: center;
        }
        .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid black;
        }
        .img-responsive, .img-thumbnail, .table, label {
            max-width: 100%;
        }
        img{
            width: 70px;
            height: 70px;

        }
    </style>

</head>
<body class="login-page" style="background: white ">

<div class="page-break">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title ">{{$title}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="adminform">
                            <!-- form start -->
                            <table id="all_data"
                                   class="table table_for_data  table-bordered dt-responsive nowrap tableData tableForAllData"
                                   cellspacing="0" width="100%">
                                <thead style="background: #F5F5F5; border: 10px">
                                <tr>
                                    <th>م</th>
                                    <th>الاسم</th>
{{--                                    <th>الصوره</th>--}}
{{--                                    <th>الاسم بالرابط</th>--}}
                                    <th>الحاله</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($allBrands as $key=>$value)
                                    <tr>

                                        <td>{{$value->id}}</td>
                                        <td>{{$value->translate('ar')-> name }} </td>
{{--                                        <td><img src="{{asset('/upload/'.$value->image)}}"></td>--}}
{{--                                        <td>{{$value->slug}}</td>--}}
                                        <td>
                                                <span data-id="{{$value->id}}" title="update Status" data-target="on"
                                                      class="status on ">{{$value->getActive()}}</span>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse





                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


</div>


</body>
</html>
