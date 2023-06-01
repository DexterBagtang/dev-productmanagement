<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Philcom</title>
    <link rel="icon" href="images/philcom_logo.png" type="image/ico"/>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <style>
        .red_td {
            background-color: #FF0000;
        }

        .green_td {
            background-color: #008000;
            color: red;
        }

        .green_tds {
            color: black;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title"> <img src="img/company_logo.png" width='70%' height='80%'></a>

                </div>


                <!-- sidebar menu -->
                @include('side_menu')
                <!-- /sidebar menu -->


            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                @include('top_header')
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

            <div class="page-title">
                <div class="title_left">
                    <h3>Project Files</h3>
                    <!--  {{  Helper::auto_generate_sr() }} -->
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
{{--                            <form method="get" action="{{ action('SalesrequestController@viewdocs_usr')}}"--}}
{{--                                  enctype="multipart/form-data">--}}
{{--                                <input type="submit" name="btn_search" value="SEARCH" class="btn btn-round btn-primary">--}}
{{--                                Search Option : <select name='search_opt' required>--}}
{{--                                    <option value="sales_request_code">Sales Request Code</option>--}}
{{--                                    <option value="mall_name">Mall Name</option>--}}
{{--                                    <option value="project_title">Project Title</option>--}}
{{--                                </select>--}}
{{--                                <input type="text" name="usr_search">--}}
{{--                            </form>--}}
                            <form method="get" action="{{ action('SalesrequestController@viewdocs_usr')}}" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label" for="search_opt">Search Option:</label>
                                    <div class="col-sm-2">
                                        <select id="search_opt" name="search_opt" class="form-control" required>
                                            <option value="sales_request_code">Sales Request Code</option>
                                            <option value="mall_name">Mall Name</option>
                                            <option value="project_title">Project Title</option>
                                            <option value="status">Project Status</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="usr_search" name="usr_search" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" name="btn_search" class="btn btn-primary btn-round">SEARCH</button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div><br/>
                            @endif
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <td>Mall Name</td>
                                    <td>Project Title</td>
                                    <td>Sales Request Code</td>
                                    <td>Contractor NTP</td>
                                    <td>CER</td>
                                    <td>Contractor PO</td>
                                    <td>CARI</td>
                                    <td>1st COPA</td>
                                    <td>2nd COPA</td>
                                    <td>COCA</td>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($salesrequests as $salesrequest)
                                    <tr>
                                        <td>{{$salesrequest->mall_name}}</td>
                                        <td>{{$salesrequest->project_title}}</td>

                                        @if (Auth::user()->role == '4' || Auth::user()->role == '8')
                                            <td>
                                                <a href="{{ action('SalesrequestController@uploadfiles_details',$salesrequest->sales_request_id)}}">
                                                    <b>{{$salesrequest->sales_request_code}}</b><br>
                                                    <div class="btn btn-success">Upload</div>
                                                </a>
                                            </td>
                                        @else
                                            <td>{{$salesrequest->sales_request_code}}</td>
                                        @endif

                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div class="{{ $salesrequest->contractor_ntp == '' ? 'red_td' : 'green_td' }}"
                                                             style="width:15px;height:15px;border:1px solid #000;">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($salesrequest->contractor_ntp)
                                                            <a href="{{ asset('storage/uploads/' . $salesrequest->contractor_ntp) }}"
                                                               target="_blank">
                                                                <b>{{ $salesrequest->contractor_ntp }}</b>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div class="{{ $salesrequest->cer_files == '' ? 'red_td' : 'green_td' }}"
                                                             style="width:15px;height:15px;border:1px solid #000;">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="/storage/uploads/{{ $salesrequest->cer_files }}"
                                                           target="_blank"><b>{{$salesrequest->cer_files}}</b>
                                                        </a>
                                                    <td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div <?php if ($salesrequest->contractor_po == '') {
                                                            echo 'class="red_td"';
                                                        } else {
                                                            echo 'class="green_td"';
                                                        }  ?> style="width:15px;height:15px;border:1px solid #000;"></div>
                                                    </td>
                                                    <td><a href="/storage/uploads/{{ $salesrequest->contractor_po }}"
                                                           target="_blank"><b>{{$salesrequest->contractor_po}}</b></a>
                                                    <td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div <?php if ($salesrequest->cari == '') {
                                                            echo 'class="red_td"';
                                                        } else {
                                                            echo 'class="green_td"';
                                                        }  ?> style="width:15px;height:15px;border:1px solid #000;"></div>
                                                    </td>
                                                    <td><a href="/storage/uploads/{{ $salesrequest->cari }}"
                                                           target="_blank"><b>{{$salesrequest->cari}}</b></a>
                                                    <td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div <?php if ($salesrequest->first_copa == '') {
                                                            echo 'class="red_td"';
                                                        } else {
                                                            echo 'class="green_td"';
                                                        }  ?> style="width:15px;height:15px;border:1px solid #000;"></div>
                                                    </td>
                                                    <td><a href="/storage/uploads/{{ $salesrequest->first_copa }}"
                                                           target="_blank"><b>{{$salesrequest->first_copa}}</b></a>
                                                    <td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div <?php if ($salesrequest->second_copa == '') {
                                                            echo 'class="red_td"';
                                                        } else {
                                                            echo 'class="green_td"';
                                                        }  ?> style="width:15px;height:15px;border:1px solid #000;"></div>
                                                    </td>
                                                    <td><a href="/storage/uploads/{{ $salesrequest->second_copa }}"
                                                           target="_blank"><b>{{$salesrequest->second_copa}}</b></a>
                                                    <td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding: 7px;">
                                                        <div <?php if ($salesrequest->coca == '') {
                                                            echo 'class="red_td"';
                                                        } else {
                                                            echo 'class="green_td"';
                                                        }  ?> style="width:15px;height:15px;border:1px solid #000;"></div>
                                                    </td>
                                                    <td><a href="/storage/uploads/{{ $salesrequest->coca }}"
                                                           target="_blank"><b>{{$salesrequest->coca}}</b></a>
                                                    <td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- /page content -->


    </div>
</div>

<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>
<?php require_once 'vendors/datatables.net/js/noinitial.js';?>
        <!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>
<script type="text/javascript">
    $('.modal-global').click(function (event) {
        event.preventDefault();

        var url = $(this).attr('href');

        $("#modal-global").modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
        })
            .done(function (response) {
                $("#modal-global").find('.modal-body').html(response);
            });

    });
</script>

<div class="modal fade" id="modal-global">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-3x fa-refresh fa-spin"></i>
                    <div>Please wait...</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
