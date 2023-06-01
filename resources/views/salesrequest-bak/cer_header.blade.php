<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Philcom</title>
	<link rel="icon" href="images/philcom_logo.png" type="image/ico" />
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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/home" class="site_title"> <img src="img/company_logo.png" width = '70%' height = '80%'></a>

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
                <h3>Upload CER</h3>

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

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if(session()->get('success'))
                      <div class="alert alert-success">
                        {{ session()->get('success') }}
                      </div><br />
                    @endif
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                      <thead>
                          <tr>
                            <td>Mall Name</td>
                            <td>Revision</td>
                            <td>Qoutation Addressee</td>
                            <td>Requester</td>
                            <td>Project Title</td>
                            <td>Proposal Target Date</td>
                            <td>Date Requested</td>
                            <td>Project Status</td>
                            <td>History</td>
                            <td>Project Age</td>
                            <td>Project Code</td>
                            <td>Sales Request Code</td>
                            <td>Action</td>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($salesrequests as $salesrequest)
                          <tr>
                            <td>{{$salesrequest->mall_name}}</td>
                            <td>{{$salesrequest->revision}}</td>
                            <td>{{$salesrequest->qoutation_addressee}}</td>
                            <td>{{$salesrequest->requester}}</td>
                            <td>{{$salesrequest->project_title}}</td>
                            <td>{{$salesrequest->date_needed}}</td>
                            <td>{{$salesrequest->created_at}}</td>
                            <td>{{$salesrequest->status}}</td>
                            <td><a href="{{ action('BiddingController@viewLogs',$salesrequest->sales_request_id)}}" class="btn btn-primary modal-global">History</a></td>
                            <td>{{$salesrequest->project_age}}</td>
                            <td>{{$salesrequest->project_code}}</td>
                            <td>{{$salesrequest->sales_request_code}}</td>
                              <td><a href="{{ action('SalesrequestController@cer_details',$salesrequest->sales_request_id)}}" class="btn btn-primary">Upload</a></td>

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
    $('.modal-global').click(function(event) {
            event.preventDefault();

            var url = $(this).attr('href');

            $("#modal-global").modal('show');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
            })
            .done(function(response) {
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
