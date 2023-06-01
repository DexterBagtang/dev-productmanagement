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
                    <h2>Approve Sales Requesta</h2>
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
                            <form method="get" action="{{ action('SalesrequestController@approved_sr',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                              @method('PATCH')
                              @csrf
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mall_name">Mall Name:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name='mall_id' class="form-control" disabled>
                                    <option value = {{ $salesrequest->mall_id }} selected = selected> {{ $salesrequest->mall_name }} </option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qoutation_addressee">Quotation Addressee:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="qoutation_addressee" value="{{ $salesrequest->qoutation_addressee }}" disabled/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="requester">Requester:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="requester" value="{{ $salesrequest->requester }}" disabled/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_title">Project Title:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" disabled/>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_needed">Proposal Target Date:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="date" class="form-control" name="date_needed" value = "{{ $salesrequest->date_needed }}" disabled>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="on_site_survey">For Site Survey:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <?php if ($salesrequest->on_site_survey == 'Yes') {?>
                                  <input type="radio"  name="on_site_survey" value ="Yes" checked disabled> Yes   ||
                                  <input type="radio"  name="on_site_survey" value ="No" disabled> No
                                <?php } else {?>
                                  <input type="radio"  name="on_site_survey" value ="Yes" disabled> Yes   ||
                                  <input type="radio"  name="on_site_survey" value ="No" checked disabled> No
                                <?php } ?>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" name="comment" value="{{ $salesrequest->comment }}" disabled/>
                                </div>
                              </div>


                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files">Project Requirement Files :</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}" target="_blank" class="clickable">  {{ $salesrequest->project_requirements_files }} </a>
                                </div>
                              </div>


{{--                 <!--             <div class="form-group">--}}
{{--                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_2">Project Requirement Files 2:</label>--}}
{{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_2 }}" target="_blank" class="clickable">  {{ $salesrequest->project_requirements_files_2 }} </a>--}}
{{--                                </div>--}}
{{--                              </div>--}}

{{--                             <div class="form-group">--}}
{{--                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_3">Project Requirement Files 3:</label>--}}
{{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_3 }}" target="_blank" class="clickable">  {{ $salesrequest->project_requirements_files_3 }} </a>--}}
{{--                                </div>--}}
{{--                              </div>--}}

{{--                             <div class="form-group">--}}
{{--                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project_requirements_files_4">Project Requirement Files 4:</label>--}}
{{--                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                <a href="/storage/uploads/{{ $salesrequest->project_requirements_files_4 }}" target="_blank" class="clickable">  {{ $salesrequest->project_requirements_files_4 }} </a>--}}
{{--                                </div>--}}
{{--                              </div>--}}
{{--		-->--}}

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

                                @if($salesrequest->reason_for_revision != null)
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 red" style="font-size: 18px" for="category">Reason For Revision</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" class="form-control" name="reason_for_revision" rows="6" readonly >{{$salesrequest->reason_for_revision}}</textarea>
                                        </div>
                                    </div>
                                @endif
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
                              </div>
                              <div id ="show_pm">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remarks">PM Assigned: </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name='pm_assigned_id' class="form-control">
                                      <option disabled selected = selected> -- select an option -- </option>
                                      @foreach(($users)->sortBy('username') as $user)
                                    <option value="{{$user->id}}" >{{$user->username}} </option>
                                    @endforeach
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
                              <a href="{{ action('SalesrequestController@approved_header') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
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
document.getElementById('show_pm').style.display = 'none';

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('show_remark').style.display = 'block';
        document.getElementById('show_pm').style.display = 'block';
        document.getElementById('remarks').required = true;
    }
    else {
       document.getElementById('show_remark').style.display = 'block';
       document.getElementById('show_pm').style.display = 'none';
       document.getElementById('remarks').required = true;

	}

}

</script>

  </body>
</html>
