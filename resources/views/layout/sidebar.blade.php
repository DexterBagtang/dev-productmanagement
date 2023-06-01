<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="align-items-center justify-content-center px-1">
        <a href="/home" class="nav-link">
            <img src="img/company_logo.png" class="img-fluid" alt="">
            <div class="text-center mt-n3">
                <small style="color: #9dafba">Project Management System</small>
            </div>
        </a>
    </div>
    <div class="sidebar-inner px-4 pt-3">
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="../../volt/assets/img/team/profile-picture-2.jpg"
                         class="card-img-top rounded-circle border-white"
                         alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, {{ Auth::user()->username }}</h2>
                    <a href="../../volt/pages/examples/sign-in.html"
                       class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Sign Out
                    </a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse"
                   data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
                   aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>

        <ul class="nav flex-column pt-3 pt-md-0 mt-md-0">
            {{--            <li class="nav-item">--}}
            {{--                <a href="../../volt/index.html" class="nav-link d-flex align-items-center">--}}
            {{--          <span class="sidebar-icon">--}}
            {{--            <img src="../../volt/assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo">--}}
            {{--          </span>--}}
            {{--                    <span class="mt-1 ms-1 sidebar-text">Volt Overview</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}


            {{--Sales Side Bar--}}
            @if (Auth::user()->role == '1' || Auth::user()->role == '3' || Auth::user()->role == '8')
                <li class="nav-item">
                <span
                        class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#submenu-app">
                <span>
                <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 003 3h15a3 3 0 01-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125zM12 9.75a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H12zm-.75-2.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75zM6 12.75a.75.75 0 000 1.5h7.5a.75.75 0 000-1.5H6zm-.75 3.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75zM6 6.75a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-3A.75.75 0 009 6.75H6z"></path>
                            <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 01-3 0V6.75z"></path>
                        </svg>
                </span>
                <span class="sidebar-text">Sales</span>
                </span>
                <span class="link-arrow">
                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path></svg>
                </span>
                </span>
                    <div class="multi-level collapse {{ (request()->is('*mall*','salesrequest','revise_project','cancel_request*','revise_salesrequest*')) ? 'show' : '' }}"
                         role="list" id="submenu-app" aria-expanded="false">
                        <ul class="flex-column nav">
                            @if (Auth::user()->role == '1' || Auth::user()->role == '8')
                                <li class="nav-item {{ (request()->is('*mall*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ action('MallController@index') }}">
                                        <span class="sidebar-text">Malls</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->role == '1' || Auth::user()->role == '8' || Auth::user()->role == '3')

                                @if (Auth::user()->role == '1' || Auth::user()->role == '8')
                                    <li class="nav-item {{ (request()->is('salesrequest','cancel_request*')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ action('SalesrequestController@index') }}">
                                            <span class="sidebar-text">Sales Request</span>
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->role == '3')
                                    <li class="nav-item {{ (request()->is('salesrequest','cancel_request*')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ action('SalesrequestController@approved_header') }}">
                                            <span class="sidebar-text">Sales Request</span>
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->role == '1' || Auth::user()->role == '8')
                                    <li class="nav-item {{ (request()->is('revise_project','revise_salesrequest*')) ? 'active' : '' }}">
                                        <a class="nav-link"
                                           href="{{ action('SalesrequestController@revise_project') }}">
                                            <span class="sidebar-text">Revise</span>
                                        </a>
                                    </li>
                                @endif

                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            {{--End of Sales Side Bar--}}


            @if (Auth::user()->role == '1' || Auth::user()->role == '3' || Auth::user()->role == '2')
            <li class="nav-item ">
                <a href="{{ action('ProjectController@index',Auth::user()->id) }}" class="nav-link">
                    <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"><path
                                d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path
                                d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    </span>
                    <span class="sidebar-text">Project Details</span>
                </a>
            </li>
            @endif

            @if (Auth::user()->role == '1' || Auth::user()->role == '3' || Auth::user()->role == '4' || Auth::user()->role == '5')
            <li class="nav-item">
                <a href="{{ action('BiddingController@index',Auth::user()->id) }}"
                   class="nav-link d-flex justify-content-between">
                    <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                          d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </span>
            <span class="sidebar-text">Bidding</span>
          </span>
                    <span>
{{--            <span class="badge badge-sm bg-secondary ms-1 text-gray-800">Pro</span>--}}
          </span>
                </a>
            </li>
            @endif

            {{--Project Status--}}
            <li class="nav-item {{ (request()->is('viewprojectstatus*')) ? 'active' : '' }}">
                <a href="{{ action('SalesrequestController@viewprojectstatus') }}" class="nav-link">
                    <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                        d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd"
                                                                                  d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                                                                  clip-rule="evenodd"></path></svg>
          </span>
                    <span class="sidebar-text">Project Status</span>
                </a>
            </li>
            {{--End Project Status--}}


            @if (Auth::user()->role <> '9')
            {{--Project Files--}}
            <li class="nav-item {{ (request()->is('viewprojectfiles*')) ? 'active' : '' }}">
                <a href="{{ action('SalesrequestController@viewprojectfiles') }}" class="nav-link">
                    <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                        fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path></svg>
          </span>
                    <span class="sidebar-text">Project Files</span>
                </a>
            </li>
            {{--End of project files--}}

            {{--Upload Files--}}
            <li class="nav-item {{ (request()->is('viewdocs*','uploadfiles_details*')) ? 'active' : '' }}">
                <a href="{{ action('SalesrequestController@viewdocs') }}"
                   class="nav-link d-flex justify-content-between">
                    <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                          fill-rule="evenodd"
                          d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z"
                          clip-rule="evenodd"></path></svg>
            </span>
            <span class="sidebar-text">Upload Files</span>
          </span>
                </a>
            </li>
            {{--End of Upload Files--}}
            @endif

            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>

            @if (Auth::user()->role == '1')
            <li class="nav-item">
                <span
                        class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#admin">
                  <span>
                    <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                           xmlns="http://www.w3.org/2000/svg"><path
                                  fill-rule="evenodd"
                                  d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                                  clip-rule="evenodd"></path></svg>
                    </span>
                    <span class="sidebar-text">Admin Panel</span>
                  </span>
                  <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"><path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path></svg>
                  </span>
                </span>
                <div class="multi-level collapse {{ (request()->is('viewusers')) ? 'show' : '' }}"
                     role="list" id="admin" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (request()->is('viewusers')) ? 'show' : '' }}">
                            <a class="nav-link" href="{{ action('Auth\RegisterController@viewusers') }}">
                                <span class="sidebar-text">Users</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (request()->is('viewusers')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('HomeController@showResetPasswordForm') }}">
                                <span class="sidebar-text">Reset Password</span>
                            </a>
                        </li>
                        <li class="nav-item {{ (request()->is('viewusers')) ? 'show' : '' }}">
                            <a class="nav-link" href="{{ action('SalesrequestController@viewlogs') }}">
                                <span class="sidebar-text">Project Logs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if (Auth::user()->role == '3')
                <li class="nav-item">
                <span
                        class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#admin">
                  <span>
                    <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                           xmlns="http://www.w3.org/2000/svg"><path
                                  fill-rule="evenodd"
                                  d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                                  clip-rule="evenodd"></path></svg>
                    </span>
                    <span class="sidebar-text">Manage Users</span>
                  </span>
                  <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"><path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path></svg>
                  </span>
                </span>
                    <div class="multi-level collapse {{ (request()->is('viewusers')) ? 'show' : '' }}"
                         role="list" id="admin" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item {{ (request()->is('viewusers')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ action('Auth\RegisterController@viewusers') }}">
                                    <span class="sidebar-text">Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->role == '8' || Auth::user()->role=='6')
                <li class="nav-item">
                <span
                        class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#admin">
                  <span>
                    <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                           xmlns="http://www.w3.org/2000/svg"><path
                                  fill-rule="evenodd"
                                  d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                                  clip-rule="evenodd"></path></svg>
                    </span>
                    <span class="sidebar-text">Manage Users</span>
                  </span>
                  <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"><path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path></svg>
                  </span>
                </span>
                    <div class="multi-level collapse {{ (request()->is('viewusers','register','users_edit_*')) ? 'show' : '' }}"
                         role="list" id="admin" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item {{ (request()->is('viewusers','register','users_edit_*')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ action('Auth\RegisterController@viewusers') }}">
                                    <span class="sidebar-text">Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

{{--            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{asset('Manual of Project Management System.pdf')}}"--}}
{{--                   target="_blank"--}}
{{--                   class="nav-link d-flex align-items-center">--}}
{{--          <span class="sidebar-icon">--}}
{{--            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path--}}
{{--                        fill-rule="evenodd"--}}
{{--                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"--}}
{{--                        clip-rule="evenodd"></path></svg>--}}
{{--          </span>--}}
{{--                    <span class="sidebar-text">Manual --}}{{--<span--}}
{{--                                class="badge badge-sm bg-secondary ms-1 text-gray-800">v1.4</span>--}}{{--</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a href="{{asset('Manual of Project Management System.pdf')}}" target="_blank"--}}
{{--                   class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">--}}
{{--                    <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">--}}
{{--            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"--}}
{{--                 aria-hidden="true">--}}
{{--  <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z"></path>--}}
{{--</svg>--}}
{{--          </span>--}}
{{--                    <span>Manual</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a href="{{url('manual')}}"
                   class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
                    <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                 aria-hidden="true">
  <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z"></path>
</svg>
          </span>
                    <span>Manual</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
