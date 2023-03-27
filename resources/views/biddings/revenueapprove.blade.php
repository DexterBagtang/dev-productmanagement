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
    <link href="../../build/css/clickable.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                            <form method="post" action="{{ action('BiddingController@revenue_approved_bidding',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">

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
                              <div class="approvebox"><br>
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
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files">Project Requirements 1:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}" download class="clickable"> {{ $salesrequest->project_requirements_files }} </a>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_2">Project Requirements 2:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_2 }}" download class="clickable"> {{ $salesrequest->project_requirements_files_2 }} </a>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_3">Project Requirements 3:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_3 }}" download class="clickable"> {{ $salesrequest->project_requirements_files_3 }} </a>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_4">Project Requirements 4:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_4 }}" download class="clickable"> {{ $salesrequest->project_requirements_files_4 }} </a>
                                </div>
                              </div>






                              <?php if ($salesrequest->category == 'Special')
                              { ?>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_category">Project Category:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_category" value="{{ $salesrequest->category }}" disabled/>
                                </div>
                              </div>
                            <?php } ?>
                            </div><br>

                            <?php if ($salesrequest->category !== 'Special')
                            { ?>
                      <div class="approvebox"><br>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Bidder:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                      <DIV class="table-responsive">
                          <table id="projectdesign" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                  <td>Trade</td>
                                  <td>Contractor Name</td>
                                  <td>Total Cost</td>
                                  <td>Select</td>
                                </tr>
                            </thead>
                            @foreach($biddingdetails as $biddingdetail)
                            <tr>
                            <td>{{$biddingdetail->bid_trade}}</td>
                            <td>{{$biddingdetail->contractor_name}}</td>
                            <?php //$total_cost =  str_replace(",","",$biddingdetail->total_cost); ?>
                            <td>{{$biddingdetail->total_cost}}</td>
                            <td><input type="checkbox" name="bidder[]" class="check" value="{{$biddingdetail->id}}" {{ ($biddingdetail->bid_status== '1')? "checked" : "" }}></td>
                            @endforeach
                          </table>
                      </DIV>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bid_file">Bid File:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="/storage/uploads/{{ $salesrequest->bid_file }}" download class="clickable">{{$salesrequest->bid_file}}</a>
                    </div>
                  </div>

                  <?php if ($salesrequest->pm_remarks_yes != ''){ ?>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pm_remarks_yes">PM Remarks:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    {{$salesrequest->pm_remarks_yes}}
                    </div>
                  </div>
                <?php }?>
                </div>
              <?php }?>
                              <br>
                              <div class="approvebox">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remarks">Approved:</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="radio"  name="approved_status" value ="Yes" onclick="yesnoCheck();" id="yesCheck"> Yes   ||
                                  <input type="radio"  name="approved_status" value ="No" onclick="yesnoCheck();" id="noCheck"> No
                                </div>
                              </div>
                                  <div id ="show_remark">
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remarks">Remarks: </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="remarks" id="remarks" />
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="revision">Revision: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select name='revision' class="form-control">
                                        <option disabled selected = selected> -- select an option -- </option>
                                          <option value="1" >Minor Revision</option>
                                          <option value="2" >Major Revision</option>
                                      </select>
                                </div>
                              </div>
                              </div>

                              <div id ="show_mark_up">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mark_up">Philcom Proposal: </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="/storage/uploads/{{ $salesrequest->mark_up_file }}" download class="clickable">{{$salesrequest->mark_up_file}}</a><input type="file" class="form-control-file" name="mark_up_file"><input type="hidden" name="existing_mark_up_file" value="{{$salesrequest->mark_up_file}}">
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mark_up">Project Size: </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name='project_size' class="form-control">
                                    <option disabled selected = selected> -- select an option -- </option>
                                      <option value="Small" {{ ($salesrequest->project_size=="Small")? "selected" : "" }}>Small</option>
                                      <option value="Big" {{ ($salesrequest->project_size=="Big")? "selected" : "" }}>Big</option>
                                  </select>
                            </div>
                          </div>
                          </div>

                              <input type="hidden" class="form-control" name="mall_id2"  value ="{{ $salesrequest->mall_id }}"  />
                              <input type="hidden" class="form-control" name="sales_request_id2" value ="{{ $salesrequest->sales_request_id }}"  />
                              <input type="hidden" class="form-control" name="approver_id" id="approver_id" value ="{{ Auth::user()->id }}"  />
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <a href="{{ action('BiddingController@index',Auth::user()->id) }}"><button type="button" class="btn btn-primary">Cancel</button></a>
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

    <script type="text/javascript">
document.getElementById('show_remark').style.display = 'none';
document.getElementById('show_mark_up').style.display = 'none';

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('show_remark').style.display = 'none';
        document.getElementById('remarks').required = false;
        document.getElementById('show_mark_up').style.display = 'block';
    }
    else {
       document.getElementById('show_remark').style.display = 'block';
       document.getElementById('remarks').required = true;
       document.getElementById('show_mark_up').style.display = 'none';

	}

}

</script>

  </body>
</html>
