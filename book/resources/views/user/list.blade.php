@extends('layout.index')
@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2><font><font>用户列表 </font></font><small><font><font>管理员</font></font></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><font><font>设置1</font></font></a> </li>
                        <li><a href="#"><font><font>设置2</font></font></a> </li>
                    </ul> </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <p class="text-muted font-13 m-b-30"><font><font> 此示例显示FixedHeader通过Bootstrap CSS框架设置样式。 </font></font></p>
           <form action="" method="get" id="">
            <div id="datatable-fixed-header_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_length" id="datatable-fixed-header_length">
                            <label><font><font>显示 </font></font>
                                <select name="prepage" aria-controls="datatable-fixed-header" class="form-control input-sm">
                                    <option value="10" @if($prepage==10) selected @endif>10</option>
                                    <option value="25"@if($prepage==25) selected @endif>25</option>
                                    <option value="50"@if($prepage==50) selected @endif>50</option>
                                    <option value="100"@if($prepage==100) selected @endif>100</option>
                                </select>
                                <font><font> 条目</font></font>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="datatable-fixed-header_filter" class="dataTables_filter">
                            <label><font><font><input class="btn btn-success" type="submit" value="搜索" ></font></font><input type="text" name="keyword" value="{{$keyword}}" class="form-control input-sm" placeholder="" aria-controls="datatable-fixed-header" /></label>
                        </div>
                    </div>
                </div>
           </form>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatable-fixed-header" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable-fixed-header_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 220px;"><font><font>用户名</font></font></th>
                                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 200px;"><font><font>昵称</font></font></th>
                                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 202px;"><font><font>邮箱</font></font></th>
                                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 195px;"><font><font>创建日期</font></font></th>
                                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 195px;"><font><font>更新日期</font></font></th>
                                <th class="sorting" tabindex="0" aria-controls="datatable-fixed-header" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 159px;"><font><font>操作</font></font></th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($user as  $k=>$value)
                            <tr role="row" class="odd">
                                <td class="sorting_1"><font><font>{{$value->username}}</font></font></td>
                                <td><font><font>{{$value->nikename}}</font></font></td>
                                <td><font><font>{{$value->email}}</font></font></td>
                                <td><font><font>{{$value->created_at}}</font></font></td>
                                <td><font><font>{{$value->updated_at}}</font></font></td>
                                <td><font><font>
                                  <a class="btn btn-app" href="edit/{{$value->id}}"><i class="fa fa-edit"></i><font><font> 编辑</font></font></a>
                                  <a class="btn btn-app" href="delete/{{$value->id}}"><span class="badge bg-red"><font></font></span><i class="fa fa-remove"></i><font><font>删除</font></font></a>
                                  </font></font></td>
                            </tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="datatable-fixed-header_info" role="status" aria-live="polite">
                            <font><font>显示1到{{$prepage}}的{{$prepage}}条目</font></font>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="datatable-fixed-header_paginate">
                            {!! $user->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('#datatable-scroller').DataTable({
                ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                    { orderable: false, targets: [0] }
                ]
            });
            $datatable.on('draw.dt', function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });
    </script>

@endsection

