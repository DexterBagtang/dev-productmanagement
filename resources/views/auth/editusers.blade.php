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
              <a href="/home" class="site_title"> <img src="../img/company_logo.png" width = '70%' height = '80%'></a>

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
                    <h2>Edit User</h2>
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

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">


                                    <div class="card-body">
                                      @foreach($users as $user)
                                        <form method="POST" action="{{ action('Auth\RegisterController@users_update',$user->id)}}">
                                            @csrf



                                            <div class="form-group row">
                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                <div class="col-md-6">
                                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" required>

                                                    @if ($errors->has('username'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                                <div class="col-md-6">


                                                    <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" id="role">
                                                    <option value="1" {{ ($user->role=="1")? "selected" : "" }}>Admin</option>
                                                    <option value="7" {{ ($user->role=="7")? "selected" : "" }}>Finance Head</option>
                                                    <option value="6" {{ ($user->role=="6")? "selected" : "" }}>Revenue Head</option>
                                                    <option value="5" {{ ($user->role=="5")? "selected" : "" }}>Revenue</option>
                                                    <option value="4" {{ ($user->role=="4")? "selected" : "" }}>Purchasing</option>
                                                    <option value="3" {{ ($user->role=="3")? "selected" : "" }}>PM Supervisor</option>
                                                    <option value="2" {{ ($user->role=="2")? "selected" : "" }}>PM</option>
                                                    <option value="8" {{ ($user->role=="8")? "selected" : "" }}>Sales</option>
                                                    </select>

                                                    @if ($errors->has('role'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('role') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                                                <div class="col-md-6">


                                                    <select class="form-control{{ $errors->has('active') ? ' is-invalid' : '' }}" name="active" id="active">
                                                        <option value="Yes" {{ ($user->active=="Yes")? "selected" : "" }}>Yes</option>
                                                        <option value="No" {{ ($user->active=="No")? "selected" : "" }}>No</option>
                                                    </select>

                                                    @if ($errors->has('active'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('active') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Edit') }}
                                                    </button>
                                                    <a href="{{ action('Auth\RegisterController@viewusers')}}"><button type="button" class="btn btn-primary">Cancel</button></a>
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
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>
