<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Project Management </title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/home" class="site_title"> <img src="../../img/company_logo.png" width = '70%' height = '80%'></a>

            </div>
            <br />
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
                    <h2>Upload Documents</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
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
                            </div><br />
                          @endif
                          @foreach($salesrequests as $salesrequest)
                            <form method="post" action="{{ action('SalesrequestController@uploadfiles',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                              @csrf


                              <?php if (Auth::user()->role == '4') { ?>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contractor_ntp">Contractor NTP:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="contractor_ntp" >
                                  <a href="/storage/uploads/{{ $salesrequest->contractor_ntp }}" download>{{ $salesrequest->contractor_ntp }}</a>
                                  <input type="hidden" name="existing_contractor_ntp" value="{{$salesrequest->contractor_ntp}}">
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contractor_po">Contractor PO:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="contractor_po" >
                                  <a href="/storage/uploads/{{ $salesrequest->contractor_po }}" download>{{ $salesrequest->contractor_po }}</a>
                                  <input type="hidden" name="existing_contractor_po" value="{{$salesrequest->contractor_po}}">
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cari">CARI:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="cari" >
                                  <a href="/storage/uploads/{{ $salesrequest->cari }}" download>{{ $salesrequest->cari }}</a>
                                  <input type="hidden" name="existing_cari" value="{{$salesrequest->cari}}">
                                </div>
                              </div>
                            <?php } else if (Auth::user()->role == '2') {?>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cer_files">CER:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="cer_files" >
                                  <a href="/storage/uploads/{{ $salesrequest->cer_files }}" download>{{ $salesrequest->cer_files }}</a>
                                  <input type="hidden" name="existing_cer_files" value="{{$salesrequest->cer_files}}">
                                </div>
                              </div>



                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_copa">First COPA:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="first_copa" >
                                  <a href="/storage/uploads/{{ $salesrequest->first_copa }}" download>{{ $salesrequest->first_copa }}</a>
                                  <input type="hidden" name="existing_first_copa" value="{{$salesrequest->first_copa}}">
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="second_copa">Second COPA:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="second_copa" >
                                  <a href="/storage/uploads/{{ $salesrequest->second_copa }}" download>{{ $salesrequest->second_copa }}</a>
                                  <input type="hidden" name="existing_second_copa" value="{{$salesrequest->second_copa}}">
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coca">COCA:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="coca" >
                                  <a href="/storage/uploads/{{ $salesrequest->coca }}" download>{{ $salesrequest->coca }}</a>
                                  <input type="hidden" name="existing_coca" value="{{$salesrequest->coca}}">
                                </div>
                              </div>
                            <?php }?>


                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <a href="{{ action('SalesrequestController@viewdocs') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
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

  </body>
</html>
