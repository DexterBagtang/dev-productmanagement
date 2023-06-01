<div class="nav_menu">
  <nav>
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li class="">
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="images/img.jpg" alt="">{{ Auth::user()->username }}
          <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
          <li> <a href="{{ action('HomeController@showChangePasswordForm') }}" >Change Password</a></li>
          <li> <a href="{{ action('HomeController@showFlowChart') }}" >Flow Chart</a></li>
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}</form></li>

        </ul>
      </li>

      <li class="">
        <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	 <?php $user_last_login = Session::get('user_last_login'); ?>
          Last Login : [{{ $user_last_login }}]
        </a>
      </li>


    </ul>
  </nav>
</div>
