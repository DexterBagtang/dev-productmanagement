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
    <style>
.approvebox {
  width: auto;
  border: 5px solid gray;

  border-radius: 5px;
  font-size: 20px
}

</style>
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
                    <h2>Upload Bidders</h2>
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
                            <form method="get" action="{{ action('ProjectController@approved_project',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                              @method('PATCH')
                              @csrf
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_manager">Project Manager:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_manager" value="{{ $salesrequest->username }}" disabled/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_request_code">Sales Request Code:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="sales_request_code" value="{{ $salesrequest->sales_request_code }}" disabled/>
                                </div>
                              </div>


                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_title">Project Title:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" disabled/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_code">Project Code:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_code" value="{{ $salesrequest->project_code }}" disabled/>
                                </div>
                              </div>


                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_status">Project Status:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_status" value="{{ $salesrequest->status }}" disabled/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name='category' class="form-control" disabled>
                                  <option value="Small" {{ ($salesrequest->category=="Small")? "selected" : "" }}>Small</option>
                                  <option value="Medium" {{ ($salesrequest->category=="Medium")? "selected" : "" }}>Medium</option>
                                  <option value="Large" {{ ($salesrequest->category=="Large")? "selected" : "" }}>Large</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Single-Line Diagram:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                              <DIV class="table-responsive">
                                  <table id="projectdesign" class="table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                          <td>Single Line Digram</td>
                                        </tr>
                                    </thead>
                                    @foreach($slds as $sld)
                                    <tr><td><a href="/storage/uploads/{{ $sld->sld_file }}" target="_blank" class="red">{{$sld->sld_file}}</a></td>
                                    @endforeach
                                  </table>
                              </DIV>
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Project Design:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                          <DIV class="table-responsive">
                              <table id="projectdesign" class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                      <td>Bill of Materials</td>
                                    </tr>
                                </thead>
                                @foreach($boms as $bom)
                                <tr><td><a href="/storage/uploads/{{ $bom->bom_file }}" target="_blank" class="red">{{$bom->bom_file}}</a></td></tr>
                                @endforeach
                              </table>
                          </DIV>
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Layout:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                      <DIV class="table-responsive">
                          <table id="projectdesign" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                  <td>Layout File</td>
                                </tr>
                            </thead>
                            @foreach($layouts as $layout)
                            <tr><td><a href="/storage/uploads/{{ $layout->layout_file }}" target="_blank" class="red">{{$layout->layout_file}}</a></td>
                            @endforeach
                          </table>
                      </DIV>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a href="{{ action('BiddingController@index',Auth::user()->id) }}"><button type="button" class="btn btn-primary">Back</button></a>
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
