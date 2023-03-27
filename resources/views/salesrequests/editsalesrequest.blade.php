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
                    <h2>Edit Sales Request</h2>
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
                            <form method="post" action="{{ route('salesrequests.update', $salesrequest->sales_request_id) }}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                              @method('PATCH')
                              @csrf
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mall_name">Mall Name:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name='mall_id' class="form-control" required>
                                    <option value = {{ $salesrequest->mall_id }} selected = selected> {{ $salesrequest->mall_name }} </option>
                                    @foreach($malls as $mall)
                                  <option value="{{$mall->mall_id}}" >{{$mall->mall_name}} </option>
                                  @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qoutation_addressee">Quotation Addressee:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="qoutation_addressee" value="{{ $salesrequest->qoutation_addressee }}"/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="requester">Requester:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="requester" value="{{ $salesrequest->requester }}" required/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_title">Project Title:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" required/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_needed">Proposal Target Date:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="date" class="form-control" name="date_needed" value = "{{ $salesrequest->date_needed }}" required>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="on_site_survey">For Site Survey:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="radio"  name="on_site_survey" value ="Yes" {{ ($salesrequest->on_site_survey=="Yes")? "checked" : "" }}> Yes   ||
                                  <input type="radio"  name="on_site_survey" value ="No" {{ ($salesrequest->on_site_survey=="No")? "checked" : "" }}> No
                                </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="comment" value="{{ $salesrequest->comment }}" />
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files">Project Requirement Files 1:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" class="form-control-file" name="project_requirements_files" >
                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}" target="_blank" class="clickable">{{ $salesrequest->project_requirements_files }}</a>
                                  <input type="hidden" name="existing_project_requirements" value="{{$salesrequest->project_requirements_files}}">
                                </div>
                              </div>

{{--                              <div class="form-group">--}}
{{--                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_2">Project Requirement Files 2:</label>--}}
{{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                  <input type="file" class="form-control-file" name="project_requirements_files_2" >--}}
{{--                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_2 }}" target="_blank" class="clickable">{{ $salesrequest->project_requirements_files_2 }}</a>--}}
{{--                                  <input type="hidden" name="existing_project_requirements" value="{{$salesrequest->project_requirements_files_2}}">--}}
{{--                                --}}


{{--                                </div>--}}
{{--                              </div>--}}


{{--                              <div class="form-group">--}}
{{--                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_3">Project Requirement Files 3:</label>--}}
{{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                  <input type="file" class="form-control-file" name="project_requirements_files_3" >--}}
{{--                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_3 }}" target="_blank" class="clickable">{{ $salesrequest->project_requirements_files_3 }}</a>--}}
{{--                                  <input type="hidden" name="existing_project_requirements" value="{{$salesrequest->project_requirements_files_3}}">--}}
{{--                                </div>--}}
{{--                              </div>--}}



{{--                              <div class="form-group">--}}
{{--                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_4">Project Requirement Files 4:</label>--}}
{{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                  <input type="file" class="form-control-file" name="project_requirements_files_4" >--}}
{{--                                  <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_4 }}" target="_blank" class="clickable">{{ $salesrequest->project_requirements_files_4 }}</a>--}}
{{--                                  <input type="hidden" name="existing_project_requirements" value="{{$salesrequest->project_requirements_files_4}}">--}}
{{--                                </div>--}}
{{--                              </div>--}}




                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name='category' class="form-control" required>
                                  <option value="Small" {{ ($salesrequest->category=="Small")? "selected" : "" }}>Small</option>
                                  <option value="Medium" {{ ($salesrequest->category=="Medium")? "selected" : "" }}>Medium</option>
                                  <option value="Large" {{ ($salesrequest->category=="Large")? "selected" : "" }}>Large</option>
                                  <option value="Special" {{ ($salesrequest->category=="Special")? "selected" : "" }}>Special</option>
                                  </select>
                                </div>
                              </div>

                              <input type="hidden" class="form-control" name="revision"  value ="{{ $salesrequest->revision }}"  />
                              <input type="hidden" class="form-control" name="pm_approval_status"  value ="{{ $salesrequest->pm_approval_status }}"  />

                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <a href="{{ action('SalesrequestController@index') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
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
