<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico"/>

    <title>Project Management </title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <link href="../../build/css/clickable.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        .approvebox {
            width: auto;
            border: 5px solid gray;

            border-radius: 5px;
            font-size: 20px
        }

    </style>
</head>
<script type="text/javascript">
    var i = 20;

    function addMoresld() {
        i++;
        $('#singlelinediagram').append('<tr id="rowa' + i + '"><td><input type="hidden" name="sld_number[]" value="1"><input type="file" class="form-control-file" name="sld[]"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove_sld" ">X</button></td></tr> ');
    }

    function getsldData() {
        var sld = document.getElementById('existing_sld_id').value;
        $('#singlelinediagram').append('<input type="hidden" name="existing_sld_name[]" value="' + sld + '">');
    }

    $(document).ready(function () {
        $(document).on('click', '.btn_remove_sld', function () {
            var button_id = $(this).attr("id");
            if (button_id < 20) {
                getsldData();
            }
            $('#rowa' + button_id + '').remove();

        });
    });

    function addMorebom() {
        i++;
        $('#projectdesign').append('<tr id="rowb' + i + '"><td><input type="hidden" name="bom_number[]" value="1"><input type="file" class="form-control-file" name="bom[]" ></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove_bom" ">X</button></td></tr> ');

    }

    function getbomData() {
        var bom = document.getElementById('existing_bom_id').value;
        $('#projectdesign').append('<input type="hidden" name="existing_bom_name[]" value="' + bom + '">');
    }

    $(document).ready(function () {
        $(document).on('click', '.btn_remove_bom', function () {
            var button_id = $(this).attr("id");
            if (button_id < 20) {
                getbomData();
            }
            $('#rowb' + button_id + '').remove();
        });
    });

    function addMorelayout() {
        i++;
        $('#layout').append('<tr id="rowc' + i + '"><td><input type="hidden" name="layout_number[]" value="1"><input type="file" class="form-control-file" name="layout[]" ></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove_layout" ">X</button></td></tr> ');

    }

    function getlayoutData() {
        var layout = document.getElementById('existing_layout_id').value;
        $('#layout').append('<input type="hidden" name="existing_layout_name[]" value="' + layout + '">');
    }

    $(document).ready(function () {
        $(document).on('click', '.btn_remove_layout', function () {
            var button_id = $(this).attr("id");
            if (button_id < 20) {
                getlayoutData();
            }
            $('#rowc' + button_id + '').remove();
        });
    });
</script>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title"> <img src="../../img/company_logo.png" width='70%' height='80%'></a>

                </div>
                <br/>
                <!-- sidebar menu -->

                @include('side_menu')

                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            @include('top_header')
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Approve Project Design</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <div class="container">
                                <div class="card uper">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br/>
                                        @endif
                                        @foreach($salesrequests as $salesrequest)
                                            <form method="post"
                                                  action="{{ action('ProjectController@approved_project',$salesrequest->sales_request_id)}}"
                                                  enctype="multipart/form-data" class="form-horizontal form-label-left">

                                                @csrf
                                                @if($salesrequest->reason_for_revision != null)
                                                    <div class="approvebox">
                                                        <div class="form-group" style="padding: 10px;">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 red"
                                                                   style="font-size: 18px" for="category">Reason For
                                                                Revision:</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea type="text" class="form-control"
                                                                          name="reason_for_revision" rows="6"
                                                                          readonly>{{$salesrequest->reason_for_revision}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                @endif
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="project_manager">Project Manager:</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control" name="project_manager"
                                                               value="{{ $salesrequest->username }}" disabled/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="sales_request_code">Sales Request Code:</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control"
                                                               name="sales_request_code"
                                                               value="{{ $salesrequest->sales_request_code }}"
                                                               disabled/>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="project_title">Project Title:</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control" name="project_title"
                                                               value="{{ $salesrequest->project_title }}" disabled/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="project_code">Project Code:</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control" name="project_code"
                                                               value="{{ $salesrequest->project_code }}" disabled/>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="project_status">Project Status:</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control" name="project_status"
                                                               value="{{ $salesrequest->status }}" disabled/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="category">Category:</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select name='category' class="form-control" disabled>
                                                            <option value="Small" {{ ($salesrequest->category=="Small")? "selected" : "" }}>
                                                                Small
                                                            </option>
                                                            <option value="Medium" {{ ($salesrequest->category=="Medium")? "selected" : "" }}>
                                                                Medium
                                                            </option>
                                                            <option value="Large" {{ ($salesrequest->category=="Large")? "selected" : "" }}>
                                                                Large
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="approvebox">
                                                    Single-Line Diagram
                                                    <div class="form-group">
                                                        <br>
                                                        <label class="control-label col-md-2 col-sm-2 col-xs-12"><input
                                                                    type="button"
                                                                    class="btn btn-round btn-primary btn-xs"
                                                                    name="add_item" id="add_item" value="Add More"
                                                                    onClick="addMoresld();"/></label>

                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <DIV class="table-responsive">
                                                                <table id="singlelinediagram"
                                                                       class="table table-bordered" width="100%">
                                                                    <?php $a = 0; ?>
                                                                    @foreach($slds as $sld)
                                                                        <?php $a = $a + 1; ?>
                                                                        <tr id="rowa<?php echo $a; ?>">
                                                                            <td>
                                                                                <a href="/storage/uploads/{{ $sld->sld_file }}"
                                                                                   target="_blank"
                                                                                   class="clickable">{{$sld->sld_file}}</a><input
                                                                                        type="hidden"
                                                                                        name="sld_number[]"
                                                                                        value="1"><input type="file"
                                                                                                         class="form-control-file"
                                                                                                         name="sld[]"><input
                                                                                        type="hidden"
                                                                                        id="existing_sld_id"
                                                                                        name="existing_sld[]"
                                                                                        value="{{$sld->sld_file}}"></td>
                                                                            <td>
                                                                                <button type="button" name="remove"
                                                                                        id="1"
                                                                                        class="btn btn-danger btn_remove_sld"
                                                                                >X</button></td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <?php if ($a == 0){ ?>
                                                                    <tr id="rowa1">
                                                                        <td><input type="hidden" name="sld_number[]"
                                                                                   value="1"><input type="file"
                                                                                                    class="form-control-file"
                                                                                                    name="sld[]"></td>
                                                                        <td>
                                                                            <button type="button" name="remove" id="1"
                                                                                    class="btn btn-danger btn_remove_sld"
                                                                            >X</button></td>
                                                                    </tr>
                                                                    <?php }?>
                                                                </table>
                                                            </DIV>
                                                            @if(count($slds) < 1 || $slds[0]->sld_file == null)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="layout_na" style="transform: scale(2);margin: 5px;" checked disabled>
                                                                <label class="form-check-label">
                                                                    Marked as N/A
                                                                </label>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <br>
                                                <div class="approvebox">
                                                    Bill of Quantities
                                                    <div class="form-group">
                                                        <br>
                                                        <label class="control-label col-md-2 col-sm-2 col-xs-12"><input
                                                                    type="button"
                                                                    class="btn btn-round btn-primary btn-xs"
                                                                    name="add_item" id="add_item" value="Add More"
                                                                    onClick="addMorebom();"/></label>

                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <DIV class="table-responsive">
                                                                <table id="projectdesign" class="table table-bordered"
                                                                       width="100%">

{{--                                                                    @dd($boms)--}}
                                                                    <?php $b = 0; ?>
                                                                    @foreach($boms as $bom)
                                                                        <?php $b = $b + 1; ?>
                                                                        <tr id="rowb<?php echo $b; ?>">
                                                                            <td>
                                                                                <a href="/storage/uploads/{{ $bom->bom_file }}"
                                                                                   target="_blank"
                                                                                   class="clickable">{{$bom->bom_file}}</a><input
                                                                                        type="hidden"
                                                                                        name="bom_number[]"
                                                                                        value="1"><input type="file"
                                                                                                         class="form-control-file"
                                                                                                         name="bom[]"><input
                                                                                        type="hidden"
                                                                                        id="existing_bom_id"
                                                                                        name="existing_bom[]"
                                                                                        value="{{$bom->bom_file}}"></td>

                                                                            <td>
                                                                                <button type="button" name="remove"
                                                                                        id="1"
                                                                                        class="btn btn-danger btn_remove_bom"
                                                                                >X</button></td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <?php if ($b == 0){ ?>
                                                                    <tr id="rowb1">
                                                                        <td><input type="hidden" name="bom_number[]"
                                                                                   value="1"><input type="file"
                                                                                                    class="form-control-file"
                                                                                                    name="bom[]"></td>
                                                                        <td>
                                                                            <button type="button" name="remove" id="1"
                                                                                    class="btn btn-danger btn_remove_bom"
                                                                            >X</button></td>
                                                                    </tr>
                                                                    <?php }?>
                                                                </table>
                                                            </DIV>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="approvebox">
                                                    Layout
                                                    <div class="form-group">
                                                        <br>
                                                        <label class="control-label col-md-2 col-sm-2 col-xs-12"><input
                                                                    type="button"
                                                                    class="btn btn-round btn-primary btn-xs"
                                                                    name="add_item" id="add_item" value="Add More"
                                                                    onClick="addMorelayout();"/></label>

                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <DIV class="table-responsive">
                                                                <table id="layout" class="table table-bordered"
                                                                       width="100%">

                                                                    <?php $c = 0; ?>
                                                                    @foreach($layouts as $layout)
                                                                        <?php $c = $c + 1; ?>
                                                                        <tr id="rowc<?php echo $c; ?>">
                                                                            <td>
                                                                                <a href="/storage/uploads/{{ $layout->layout_file }}"
                                                                                   target="_blank"
                                                                                   class="clickable">{{$layout->layout_file}}</a><input
                                                                                        type="hidden"
                                                                                        name="layout_number[]"
                                                                                        value="1"><input type="file"
                                                                                                         class="form-control-file"
                                                                                                         name="layout[]"><input
                                                                                        type="hidden"
                                                                                        id="existing_layout_id"
                                                                                        name="existing_layout[]"
                                                                                        value="{{$layout->layout_file}}">
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" name="remove"
                                                                                        id="1"
                                                                                        class="btn btn-danger btn_remove_layout"
                                                                                >X</button></td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <?php if ($c == 0){ ?>
                                                                    <tr id="rowc1">
                                                                        <td><input type="hidden" name="layout_number[]"
                                                                                   value="1"><input type="file"
                                                                                                    class="form-control-file"
                                                                                                    name="layout[]">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" name="remove" id="1"
                                                                                    class="btn btn-danger btn_remove_layout"
                                                                            >X</button></td>
                                                                    </tr>
                                                                    <?php }?>
                                                                </table>
                                                            </DIV>

                                                            @if(count($layouts) < 1 || $layouts[0]->layout_file == null)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="layout_na" style="transform: scale(2);margin: 5px;" checked disabled>
                                                                    <label class="form-check-label">
                                                                        Marked as N/A
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="approvebox">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="remarks">Approved:</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="radio" name="approved_status" value="Yes"
                                                                   onclick="yesnoCheck();" id="yesCheck"> Yes ||
                                                            <input type="radio" name="approved_status" value="No"
                                                                   onclick="yesnoCheck();" id="noCheck"> No
                                                        </div>
                                                    </div>
                                                    <div id="show_remark">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                   for="remarks">Remarks: </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea type="text" class="form-control"
                                                                          name="remarks" id="remarks" rows="3"
                                                                          required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" class="form-control" name="mall_id2"
                                                           value="{{ $salesrequest->mall_id }}"/>
                                                    <input type="hidden" class="form-control" name="sales_request_id2"
                                                           value="{{ $salesrequest->sales_request_id }}"/>
                                                    <input type="hidden" class="form-control" name="approver_id"
                                                           id="approver_id" value="{{ Auth::user()->id }}"/>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-primary">Submit
                                                            </button>
                                                            <a href="{{ action('ProjectController@index',Auth::user()->id) }}">
                                                                <button type="button" class="btn btn-primary">Cancel
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                            </form>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

    </div>
</div>

<!-- jQuery -->
<script src="../../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DateJS -->
<script src="../../vendors/DateJS/build/date.js"></script>


<!-- Custom Theme Scripts -->
<script src="../../build/js/custom.min.js"></script>

<script type="text/javascript">
    document.getElementById('show_remark').style.display = 'none';

    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('show_remark').style.display = 'block';
            document.getElementById('remarks').required = true;
        } else {
            document.getElementById('show_remark').style.display = 'block';
            document.getElementById('remarks').required = true;

        }

    }

</script>

</body>
</html>
