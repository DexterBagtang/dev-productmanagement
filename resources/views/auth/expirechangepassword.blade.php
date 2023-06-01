<!--

=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themesberg.com/licensing)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="icon" type="image/png" href="img/pm.logo.png">

    <!-- Sweet Alert -->
    <link type="text/css" href="../../volt/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="../../volt/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="../../volt/css/volt.css" rel="stylesheet">


    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    @yield('link')
    <style>
        html {
            font-size: 13px;
        }
    </style>

</head>


<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->


<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="../../volt/index.html">
        <img class="navbar-brand-dark" src="../../volt/assets/img/brand/light.svg" alt="Volt logo"/> <img
                class="navbar-brand-light" src="../../volt/assets/img/brand/dark.svg" alt="Volt logo"/>
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>


<main class="content">


    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Change Password</h1>
                {{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-4">
            <div class="card border-0 shadow components-section">

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div><br>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div><br>
                    @endif
                    <form class="" method="POST" action="{{ action('HomeController@user_expirechangePassword')}}">
                        {{ csrf_field() }}

                        <div class="my-1{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Current Password</label>

                            <div class="col">
                                <input id="current-password" type="password" class="form-control"
                                       name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="text-danger small">
                                                            <strong>{{ $errors->first('current-password') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="my-1{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">New Password</label>

                            <div class="col">
                                <input id="new-password" type="password" class="form-control" name="new-password"
                                       required>

                                @if ($errors->has('new-password'))
                                    <span class="text-danger small">
                                                            <strong>{{ $errors->first('new-password') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="my-1">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New
                                Password</label>

                            <div class="col">
                                <input id="new-password-confirm" type="password" class="form-control"
                                       name="new-password_confirmation" required>
                            </div>
                        </div>

                        <div class="my-1">
                            <div class="col col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Core -->
<script src="../../volt/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="../../volt/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="../../volt/vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
{{--<script src="../../volt/vendor/nouislider/distribute/nouislider.min.js"></script>--}}

<!-- Smooth scroll -->
<script src="../../volt/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Volt JS -->
<script src="../../volt/assets/js/volt.js"></script>
</body>
</html>
