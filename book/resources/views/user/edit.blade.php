@extends('layout.index')
@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>用户编辑页 <small>form elements</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form id="demo-form2" action="{{ URL::asset('/') }}admin/user/update" data-parsley-validate="" method="get" class="form-horizontal form-label-left" novalidate="">
                {{csrf_field()}}
               <input type="hidden" value="{{$user->id}}" name="uid">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">用户名<span class="required red">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" value="{{$user->username}}" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12">
                        <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required"></li></ul>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nikename">昵称<span class="required red">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" value="{{$user->nikename}}" id="nikename" name="nikename" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">邮箱<span class="required red">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="email" value="{{$user->email}}" class="form-control col-md-7 col-xs-12" type="text" name="email" required="required email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">角色 <span class="required red">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_single form-control select2-hidden-accessible" name="role" tabindex="-1" aria-hidden="true">
                            <option>请选择</option>
                            <option value="AR" @if($user->role=='AR') selected @endif>Arkansas</option>
                            <option value="IL"@if($user->role=='IL') selected @endif >Illinois</option>
                            <option value="IA"@if($user->role=='IA') selected @endif>Iowa</option>
                            <option value="KS"@if($user->role=='KS') selected @endif>Kansas</option>
                            <option value="LA"@if($user->role=='LA') selected @endif>la</option>

                        </select>

                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {{--     // <button type="submit" class="btn btn-primary">Cancel</button>--}}
                        <button type="submit" id="submit" class="btn btn-success">Update</button>
                    </div>
                </div>

            </form>
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



