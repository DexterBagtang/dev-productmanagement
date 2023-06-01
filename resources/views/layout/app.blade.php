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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Project Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt Premium Bootstrap Dashboard - Typography">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="og:title" content="Volt Premium Bootstrap Dashboard - Typography">
    <meta property="og:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="twitter:title" content="Volt Premium Bootstrap Dashboard - Typography">
    <meta property="twitter:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

{{--    <!-- Favicon -->--}}
{{--    <link rel="apple-touch-icon" sizes="120x120" href="img/pm.logo.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="img/pm.logo.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="img/pm.logo.png">--}}
{{--    <link rel="manifest" href="img/pm.logo.png">--}}
{{--    <link rel="mask-icon" href="img/pm.logo.png">--}}
{{--    <meta name="msapplication-TileColor" content="#ffffff">--}}
{{--    <meta name="theme-color" content="#ffffff">--}}
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
        html{
            font-size: 13px;
        }
    </style>

</head>


<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->


<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="../../volt/index.html">
        <img class="navbar-brand-dark" src="../../volt/assets/img/brand/light.svg" alt="Volt logo" /> <img class="navbar-brand-light" src="../../volt/assets/img/brand/dark.svg" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

@include('layout.sidebar')

<main class="content">

    @include('layout.navbar')

    @yield('content')

    <!-- History -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Action History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <div id="history_logs"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
{{--                    <button type="button" class="btn btn-primary">Understood</button>--}}
                </div>
            </div>
        </div>
    </div>

{{--    <footer class="rounded shadow p-5 mb-4 mt-4">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">--}}
{{--                <p class="mb-0 text-center text-lg-start">© 2019-<span class="current-year"></span> <a class="text-primary fw-normal" href="https://themesberg.com" target="_blank">Themesberg</a></p>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-8 col-xl-6 text-center text-lg-start">--}}
{{--                <!-- List -->--}}
{{--                <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">--}}
{{--                    <li class="list-inline-item px-0 px-sm-2">--}}
{{--                        <a href="https://themesberg.com/about">About</a>--}}
{{--                    </li>--}}
{{--                    <li class="list-inline-item px-0 px-sm-2">--}}
{{--                        <a href="https://themesberg.com/themes">Themes</a>--}}
{{--                    </li>--}}
{{--                    <li class="list-inline-item px-0 px-sm-2">--}}
{{--                        <a href="https://themesberg.com/blog">Blog</a>--}}
{{--                    </li>--}}
{{--                    <li class="list-inline-item px-0 px-sm-2">--}}
{{--                        <a href="https://themesberg.com/contact">Contact</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
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

<!-- Charts -->
<script src="../../volt/vendor/chartist/dist/chartist.min.js"></script>
<script src="../../volt/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="../../volt/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Sweet Alerts 2 -->
<script src="../../volt/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="../../volt/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Notyf -->
<script src="../../volt/vendor/notyf/notyf.min.js"></script>

<!-- Simplebar -->
<script src="../../volt/vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="../../volt/assets/js/volt.js"></script>



@yield('script')

<script>
    document.querySelectorAll('.history').forEach(function (element) {
        element.addEventListener('click', function () {
            // var salesRequestId = document.querySelector("#editModalButton").getAttribute("data-id");
            var url = element.getAttribute('href');
            var salesRequestId = element.getAttribute("data-id");
            var modal = document.querySelector('#staticBackdrop');
            var loadingSpinner = document.querySelector('#loading-spinner');

            console.log(url);

            // Show loading spinner
            // loadingSpinner.style.display = 'block';

            // Make a fetch request to fetch the dynamic content
            fetch(url)
                .then(function(response) {
                    return response.text();
                })
                .then(function(data) {
                    // loadingSpinner.style.display = 'none';
                    modal.querySelector('#history_logs').innerHTML = data;
                });
        });
    });
</script>

</body>

</html>
