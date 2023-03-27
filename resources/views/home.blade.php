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
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/home" class="site_title"> <img src="img/company_logo.png" width = '70%' height = '80%'></a>

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
          <br>
          @if(session()->get('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}
            </div><br />
          @endif
          @if (Auth::user()->role == '1' || Auth::user()->role == '3')
          <!-- show all new sales request -->
          @if ($showCounts > 0)
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>New Sales Request</h2>
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
                      <div class="card upper">

                    <div class="card-body">
                        You have <b> {{$showCounts}} </b> Sales Request to approve <a href='{{ action('SalesrequestController@approved_header') }}'><b><u>Click Here</u></b></a>

                    </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif

            <!-- show all project design review -->
            @if ($showCounts10 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Project Design for Review</h2>
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
                          You have <b> {{$showCounts10}} </b> Project Design to review <a href='{{ action('ProjectController@index',Auth::user()->id) }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            <!-- show all check contractor cost -->
            @if ($showCounts2 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Check Contractor Cost</h2>
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
                          You have <b> {{$showCounts2}} </b> Application to check <a href='{{ action('BiddingController@index',Auth::user()->id) }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <!-- show all mark up technical checking -->
              @if ($showCounts4 > 0)
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Philcom Proposal Technical Checking</h2>
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
                            You have <b> {{$showCounts4}} </b> Application to check <a href='{{ action('BiddingController@pm_technicalcheck_header') }}'><b><u>Click Here</u></b></a>

                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endif

            @if (Auth::user()->role == '4')
            <!-- show all purchasing bidding / rebidding -->
            @if ($showCounts5 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Project Bidding</h2>
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
                          You have <b> {{$showCounts5}} </b> Application to check <a href='{{ action('BiddingController@index',Auth::user()->id) }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            @endif

            @if (Auth::user()->role == '5')
            <!-- show all revenue for mark up -->
            @if ($showCounts3 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Projects for Mark Up</h2>
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
                          You have <b> {{$showCounts3}} </b> Application to check <a href='{{ action('BiddingController@index',Auth::user()->id) }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              <!-- show all revenue bid summary -->
              @if ($showCounts12 > 0)
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Uploading of Bid Summary</h2>
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
                            You have <b> {{$showCounts12}} </b> Application to check <a href='{{ action('SalesrequestController@bid_summary_header') }}'><b><u>Click Here</u></b></a>

                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endif


            @if (Auth::user()->role == '2')
            <!-- show all for pm design -->
            @if ($showCounts6 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Projects for Designing</h2>
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
                          You have <b> {{$showCounts6}} </b> Application to check <a href='{{ action('ProjectController@index',Auth::user()->id) }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            @endif

            @if (Auth::user()->role == '6')
            <!-- show all revenue for mark up -->
            @if ($showCounts7 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Philcom Proposal for Checking</h2>
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
                          You have <b> {{$showCounts7}} </b> Application to check <a href='{{ action('BiddingController@revenue_head_header') }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            @endif

            @if (Auth::user()->role == '7')
            <!-- show all revenue for mark up -->
            @if ($showCounts8 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Philcom Proposal for Checking</h2>
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
                          You have <b> {{$showCounts8}} </b> Application to check <a href='{{ action('BiddingController@finance_head_header') }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            @endif

            @if (Auth::user()->role == '8')

            <!-- show all sales request Disapproved -->
            @if ($showCounts14 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Sales Request Disapproved</h2>
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
                          You have <b> {{$showCounts14}} </b> Sales Request Disapproved <a href='{{ action('SalesrequestController@sr_disapproved_header') }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            <!-- show all endorsement of po / ntp -->
            @if ($showCounts9 > 0)
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Sales Proposal Status</h2>
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
                          You have <b> {{$showCounts9}} </b> Application to check <a href='{{ action('SalesrequestController@po_ntp_header') }}'><b><u>Click Here</u></b></a>

                      </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <!-- show all releasing of proposal  -->
              @if ($showCounts11 > 0)
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Releasing of Proposal</h2>
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
                            You have <b> {{$showCounts11}} </b> Application to check <a href='{{ action('SalesrequestController@release_proposal_header') }}'><b><u>Click Here</u></b></a>

                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endif
        </div>
        <!-- /page content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <!--<script src="../vendors/fastclick/lib/fastclick.js"></script>-->
    <!-- NProgress -->
    <!--<script src="../vendors/nprogress/nprogress.js"></script>-->
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <!--<script src="../vendors/gauge.js/dist/gauge.min.js"></script>-->
    <!-- bootstrap-progressbar -->
    <!--<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>-->
    <!-- iCheck -->
    <!--<script src="../vendors/iCheck/icheck.min.js"></script> -->
    <!-- Skycons -->
    <!--<script src="../vendors/skycons/skycons.js"></script> -->
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <!-- <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script> -->

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>
