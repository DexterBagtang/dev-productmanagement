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

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/jquery.inputmask.bundle.min.js"></script>
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

    <script type="text/javascript">

$(function() {
    $("input[id^='currency']").inputmask({
        alias : "currency", prefix: ''
    });
});

  var i=30;

  function addMorebid() {
    i++;
  $('#bidders').append('<tr id="rowb'+i+'"><td><input type="text" class="form-control" name="bid_trade[]"/></td><td><input type="text" class="form-control" name="contractor_name[]"/></td><td><input type="text" id="currency'+i+'"  class="form-control" name="total_cost[]"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_bid" ">X</button></td></tr> ');

  $("input[id^='currency']").inputmask({
      alias : "currency", prefix: ''
  });
  }

  $(document).ready(function(){
    $(document).on('click', '.btn_remove_bid', function(){
         var button_id = $(this).attr("id");
         $('#rowb'+button_id+'').remove();
    });
    });



  </script>
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
                            <form method="post" action="{{ route('biddings.update', $salesrequest->sales_request_id) }}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                              @method('PATCH')
                              @csrf
                                @if($salesrequest->reason_for_revision != null)
                                    <div class="approvebox">
                                        <div class="form-group" style="padding: 10px;">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 red" style="font-size: 18px" for="category">Reason For Revision:</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea type="text" class="form-control" name="reason_for_revision" rows="6" readonly >{{$salesrequest->reason_for_revision}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endif
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
                                    <tr><td><a href="/storage/uploads/{{ $sld->sld_file }}" target="_blank" class="clickable">{{$sld->sld_file}}</a></td>
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
                                <tr><td><a href="/storage/uploads/{{ $bom->bom_file }}" target="_blank" class="clickable">{{$bom->bom_file}}</a></td>
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
                            <tr><td><a href="/storage/uploads/{{ $layout->layout_file }}" target="_blank" class="clickable">{{$layout->layout_file}}</a></td>
                            @endforeach
                          </table>
                      </DIV>
                    </div>
                  </div>

                              <br>
                              <div class="approvebox">
                                Bidders

                                <div class="form-group">
                                  <br>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-12"><input type="button" class="btn btn-round btn-primary btn-xs" name="add_item" id="add_item" value="Add More" onClick="addMorebid();"  /></label>

                                  <div class="col-md-8 col-sm-8 col-xs-12">
                          <DIV class="table-responsive">
                              <table id="bidders" class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                      <td>Trade</td>
                                      <td>Contractor Name</td>
                                      <td>Total Cost</td>
                                      <td></td>
                                    </tr>
                                </thead>
                                <?php $b = 0; ?>
                                @foreach($biddings as $bidding)
                                <?php $b = $b + 1; ?>
                                <tr id="rowb<?php echo $b; ?>">
                                <td><input type="text" class="form-control" name="bid_trade[]" value="{{ $bidding->bid_trade }}"/></td>
                                <td><input type="text" class="form-control" name="contractor_name[]" value="{{ $bidding->contractor_name }}"/></td>
                                <td><input type="text" id="currency{{$b}}" class="form-control" name="total_cost[]" value="{{ $bidding->total_cost }}"/></td>

                                <td><button type="button" name="remove" id="{{ $b}}" class="btn btn-danger btn_remove_bid">X</button></td></tr>
                                @endforeach
                                <?php if ($b == 0){ ?>
                                  <tr id="rowb1">
                                    <td><input type="text" class="form-control" name="bid_trade[]"/></td>
                                    <td><input type="text" class="form-control" name="contractor_name[]"/></td>
                                    <td><input type="text" id="currency{{$b}}" class="form-control" name="total_cost[]"/></td>
                                  <td><button type="button" name="remove" id="1" class="btn btn-danger btn_remove_bid">X</button></td></tr>
                                <?php }?>
                              </table>
                          </DIV>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_request_code">Bid File:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="/storage/uploads/{{ $salesrequest->bid_file }}" target="_blank" class="clickable">{{$salesrequest->bid_file}}</a><input type="file" class="form-control-file" name="bid_file" ><input type="hidden" name="existing_bid_file" value="{{$salesrequest->bid_file}}">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                  <a href="{{ action('BiddingController@index',Auth::user()->id) }}"><button type="button" class="btn btn-primary">Cancel</button></a>

                                </div>
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


    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../../vendors/Flot/jquery.flot.js"></script>
    <script src="../../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>


  </body>
</html>
