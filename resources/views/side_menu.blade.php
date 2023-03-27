<div class="clearfix"></div>

<div class="profile clearfix">
  <div class="profile_pic">
    <img src="../../img/user.png" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Welcome,</span>
    <h2>{{ Auth::user()->username }}</h2>
  </div>
</div>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<div class="menu_section">
  <ul class="nav side-menu">
    @if (Auth::user()->role == '1' || Auth::user()->role == '3' || Auth::user()->role == '8')
    <li><a><i class="fa fa-area-chart"></i> Sales <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        @if (Auth::user()->role == '1' || Auth::user()->role == '8')
        <li><a href="{{ action('MallController@index') }}">Malls</a></li>
        @endif

        @if (Auth::user()->role == '1' || Auth::user()->role == '8' || Auth::user()->role == '3')
          @if (Auth::user()->role == '1' || Auth::user()->role == '8')
            <li><a href="{{ action('SalesrequestController@index') }}">Sales Request</a></li>
          @endif
          @if (Auth::user()->role == '3')
            <li><a href="{{ action('SalesrequestController@approved_header') }}">Sales Request</a></li>
          @endif
          @if (Auth::user()->role == '1' || Auth::user()->role == '8')
            <li><a href="{{ action('SalesrequestController@revise_project') }}">Revise Project</a></li>
          @endif
        @endif

      </ul>
    </li>
    @endif
    @if (Auth::user()->role == '1' || Auth::user()->role == '3' || Auth::user()->role == '2')
        <li><a href="{{ action('ProjectController@index',Auth::user()->id) }}"><i class="fa fa-wrench"></i>Project Details</a></li>

    @endif
    @if (Auth::user()->role == '1' || Auth::user()->role == '3' || Auth::user()->role == '4' || Auth::user()->role == '5')
        <li><a href="{{ action('BiddingController@index',Auth::user()->id) }}"><i class="fa fa-tasks"></i>Bidding</a></li>
    @endif
    <li><a href="{{ action('SalesrequestController@viewprojectstatus') }}"><i class="fa fa-desktop"></i>Project Status</a></li>
    @if (Auth::user()->role <> '9')
    <li><a href="{{ action('SalesrequestController@viewprojectfiles') }}"><i class="fa fa-file"></i>Project Files</a></li>
    <li><a href="{{ action('SalesrequestController@viewdocs') }}"><i class="fa fa-upload"></i>Upload Files</a></li>
    @endif
    @if (Auth::user()->role == '1')
    <li><a><i class="fa fa-user-secret"></i> Admin Panel <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        <li><a href="{{ action('Auth\RegisterController@viewusers') }}"><i class="fa fa-users"></i>Users</a></li>
        <li><a href="{{ action('HomeController@showResetPasswordForm') }}"><i class="fa fa-refresh"></i>Reset Password</a></li>
	<li><a href="{{ action('SalesrequestController@viewlogs') }}"><i class="fa fa-envelope-o"></i>Project Logs</a></li>
      </ul>
    </li>
    @endif



  </ul>
</div>
</div>
