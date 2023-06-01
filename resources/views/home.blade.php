@extends('layout.app')
@section('link')
{{--    <style>--}}
{{--        * {--}}
{{--            border: 1px solid red !important;--}}
{{--        }--}}
{{--    </style>--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">


@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            {{--            <div class="mb-3 mb-lg-0">--}}
            {{--                <h1 class="h4">Home</h1>--}}
            {{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            {{--            </div>--}}
        </div>
    </div>

    <div class="row">
        {{--        <div class="col-12 mb-4">--}}
        {{--            <div class="card border-0 shadow position-relative components-section">--}}
        {{--                <div class="card-body">--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        @if (Auth::user()->role == '1' || Auth::user()->role == '3')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@approved_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">New Sales Requests</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">New Sales Requests</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Review Sales Requests</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('ProjectController@index',Auth::user()->id) }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M1 2.75A.75.75 0 011.75 2h10.5a.75.75 0 010 1.5H12v13.75a.75.75 0 01-.75.75h-1.5a.75.75 0 01-.75-.75v-2.5a.75.75 0 00-.75-.75h-2.5a.75.75 0 00-.75.75v2.5a.75.75 0 01-.75.75h-2.5a.75.75 0 010-1.5H2v-13h-.25A.75.75 0 011 2.75zM4 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM4.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM8 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM8.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM14.25 6a.75.75 0 00-.75.75V17a1 1 0 001 1h3.75a.75.75 0 000-1.5H18v-9h.25a.75.75 0 000-1.5h-4zm.5 3.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm.5 3.5a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="fw-extrabold h5">Project Design for Review</h2>
                                        <h3 class="mb-1">{{$showCounts10}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Project Design for Review</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts10}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Review Project design</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts10 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('BiddingController@index',Auth::user()->id) }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="fw-extrabold h5"> Check and Review Bidder</h2>
                                        <h3 class="mb-1">{{$showCounts2}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0"> Check and Review Bidder</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts2}}</h3>
                                    </div>
                                    <small class="text-gray-500">
                                        <br>
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Check and choose bid winner</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts2 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative position-relative">
                    <a href="{{ action('BiddingController@pm_technicalcheck_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M18 5.25a2.25 2.25 0 00-2.012-2.238A2.25 2.25 0 0013.75 1h-1.5a2.25 2.25 0 00-2.238 2.012c-.875.092-1.6.686-1.884 1.488H11A2.5 2.5 0 0113.5 7v7h2.25A2.25 2.25 0 0018 11.75v-6.5zM12.25 2.5a.75.75 0 00-.75.75v.25h3v-.25a.75.75 0 00-.75-.75h-1.5z"
                                                  clip-rule="evenodd"/>
                                            <path fill-rule="evenodd"
                                                  d="M3 6a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H3zm6.874 4.166a.75.75 0 10-1.248-.832l-2.493 3.739-.853-.853a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.154-.114l3-4.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="fw-extrabold h5"> Philcom Proposal Technical Checking</h2>
                                        <h3 class="mb-1">{{$showCounts4}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0"> Philcom Proposal Technical Checking</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts4}}</h3>
                                    </div>
                                    <small class="text-gray-500">
                                        <br>
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Technical Review of the proposal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts4 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif


        @if (Auth::user()->role == '4')

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('BiddingController@index',Auth::user()->id) }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                        </svg>

                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Project Bidding</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts5}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Project Bidding</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts5}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Update Bidders for project</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts5 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>


            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@release_pontp_header',Auth::user()->id) }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                        </svg>

                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Releasing of NTP/PO</h2>
                                        <h3 class="fw-extrabold mb-1">{{$releasepontp}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Releasing of NTP/PO</h2>
                                        <h3 class="fw-extrabold mb-2">{{$releasepontp}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Release NTP PO to Winning Contractor</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($releasepontp > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif


        @if (Auth::user()->role == '5')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('BiddingController@index',Auth::user()->id) }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M12.577 4.878a.75.75 0 01.919-.53l4.78 1.281a.75.75 0 01.531.919l-1.281 4.78a.75.75 0 01-1.449-.387l.81-3.022a19.407 19.407 0 00-5.594 5.203.75.75 0 01-1.139.093L7 10.06l-4.72 4.72a.75.75 0 01-1.06-1.061l5.25-5.25a.75.75 0 011.06 0l3.074 3.073a20.923 20.923 0 015.545-4.931l-3.042-.815a.75.75 0 01-.53-.919z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Projects for Markup</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts3}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Projects for Markup</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts3}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Check Projects for Markup</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @if($showCounts3 > 0)
                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@bid_summary_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M13.75 7h-3V3.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L6.2 4.74a.75.75 0 001.1 1.02l1.95-2.1V7h-3A2.25 2.25 0 004 9.25v7.5A2.25 2.25 0 006.25 19h7.5A2.25 2.25 0 0016 16.75v-7.5A2.25 2.25 0 0013.75 7zm-3 0h-1.5v5.25a.75.75 0 001.5 0V7z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Uploading of Bid Summary</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts12}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Uploading of Bid Summary</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts12}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Projects for bid summary upload</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts12 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif


        @if (Auth::user()->role == '2')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('ProjectController@index',Auth::user()->id) }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z"/>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Projects for Designing</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts6}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Projects for Designing</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts6}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Check Project for design upload</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts6 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>

        @endif


        @if (Auth::user()->role == '6')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('BiddingController@revenue_head_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M18 5.25a2.25 2.25 0 00-2.012-2.238A2.25 2.25 0 0013.75 1h-1.5a2.25 2.25 0 00-2.238 2.012c-.875.092-1.6.686-1.884 1.488H11A2.5 2.5 0 0113.5 7v7h2.25A2.25 2.25 0 0018 11.75v-6.5zM12.25 2.5a.75.75 0 00-.75.75v.25h3v-.25a.75.75 0 00-.75-.75h-1.5z"
                                                  clip-rule="evenodd"/>
                                            <path fill-rule="evenodd"
                                                  d="M3 6a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H3zm6.874 4.166a.75.75 0 10-1.248-.832l-2.493 3.739-.853-.853a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.154-.114l3-4.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">PhilCom Proposal for Checking</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts7}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">PhilCom Proposal for Checking</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts7}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Review Proposal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts7 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif

        @if (Auth::user()->role == '7')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('BiddingController@finance_head_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M18 5.25a2.25 2.25 0 00-2.012-2.238A2.25 2.25 0 0013.75 1h-1.5a2.25 2.25 0 00-2.238 2.012c-.875.092-1.6.686-1.884 1.488H11A2.5 2.5 0 0113.5 7v7h2.25A2.25 2.25 0 0018 11.75v-6.5zM12.25 2.5a.75.75 0 00-.75.75v.25h3v-.25a.75.75 0 00-.75-.75h-1.5z"
                                                  clip-rule="evenodd"/>
                                            <path fill-rule="evenodd"
                                                  d="M3 6a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H3zm6.874 4.166a.75.75 0 10-1.248-.832l-2.493 3.739-.853-.853a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.154-.114l3-4.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">PhilCom Proposal for Checking</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts8}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">PhilCom Proposal for Checking</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts8}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Review Proposal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts8 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif


        @if (Auth::user()->role == '8')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@sr_disapproved_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                             aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Sales Request Disapproved</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts14}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Sales Request Disapproved</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts14}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Check Disapproved sales requests</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts14 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@release_proposal_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                             aria-hidden="true">
                                            <path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925A1.5 1.5 0 005.135 9.25h6.115a.75.75 0 010 1.5H5.135a1.5 1.5 0 00-1.442 1.086l-1.414 4.926a.75.75 0 00.826.95 28.896 28.896 0 0015.293-7.154.75.75 0 000-1.115A28.897 28.897 0 003.105 2.289z"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Releasing of Proposal</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts11}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Releasing of Proposal</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts11}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Release proposal to client</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts11 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@po_ntp_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                             aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Sales Proposal Status</h2>
                                        <h3 class="fw-extrabold mb-1">{{$showCounts9}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Sales Proposal Status</h2>
                                        <h3 class="fw-extrabold mb-2">{{$showCounts9}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Update status of sales proposal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($showCounts9 > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif



        @if (Auth::user()->role == '10')
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-0 shadow position-relative">
                    <a href="{{ action('SalesrequestController@upload_cer_header') }}">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M18 5.25a2.25 2.25 0 00-2.012-2.238A2.25 2.25 0 0013.75 1h-1.5a2.25 2.25 0 00-2.238 2.012c-.875.092-1.6.686-1.884 1.488H11A2.5 2.5 0 0113.5 7v7h2.25A2.25 2.25 0 0018 11.75v-6.5zM12.25 2.5a.75.75 0 00-.75.75v.25h3v-.25a.75.75 0 00-.75-.75h-1.5z"
                                                  clip-rule="evenodd"/>
                                            <path fill-rule="evenodd"
                                                  d="M3 6a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1H3zm6.874 4.166a.75.75 0 10-1.248-.832l-2.493 3.739-.853-.853a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.154-.114l3-4.5z"
                                                  clip-rule="evenodd"/>
                                        </svg>

                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5 text-gray-900">Upload CER</h2>
                                        <h3 class="fw-extrabold mb-1">{{$uploadCerCount}}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-700 mb-0">Upload CER</h2>
                                        <h3 class="fw-extrabold mb-2">{{$uploadCerCount}}</h3>
                                    </div>
                                    <small class="d-flex align-items-center text-gray-500">
                                        <br>
                                        {{--                                    Feb 1 - Apr 1,--}}
                                        {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                        {{--                                    USA--}}
                                    </small>
                                    <div class="small d-flex mt-1">
                                        <div>Upload CER for the project</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($uploadCerCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                                        <span class="visually-hidden">New alerts</span>
                                                    </span>
                        @endif
                    </a>
                </div>
            </div>
        @endif
    </div>




    <div class="row">
        <div class="col-12 col-xxl-8 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h2 class="fs-5 fw-bold mb-0">Progress Status</h2>
                    <a href="{{url('viewprojectstatus')}}" class="btn btn-sm btn-primary">View all</a>
                </div>
                <div class="card-body">
                    @foreach($projectStatus as $project)
                        <div class="row mb-4">
                            <div class="col-auto">
                                <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                          d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="col">
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="h6 mb-0">{{$project->project_title}}</div>
                                        @php
                                            $percentage = 0;
                                            $color = '';
                                            if(str_contains($project->status, 'PM Designing') || str_contains($project->status, 'Redesign')) {
                                                $percentage = 10;
                                                $color = 'bg-danger';
                                            } elseif(str_contains($project->status, 'PM Review')) {
                                                $percentage = 20;
                                                $color = 'bg-warning';
                                            } elseif(str_contains($project->status, 'Pm Review of Design')) {
                                                $percentage = 30;
                                                $color = 'bg-warning';
                                            } elseif(str_contains($project->status, 'Purchasing Bidding') || str_contains($project->status, 'Purchasing')) {
                                                $percentage = 35;
                                                $color = 'bg-warning';
                                            } elseif(str_contains($project->status, 'PM Review Bidders')) {
                                                $percentage = 40;
                                                $color = 'bg-info';
                                            } elseif(str_contains($project->status, 'Revenue Mark Up') || str_contains($project->status, 'Revenue Re-Mark Up') ) {
                                                $percentage = 45;
                                                $color = 'bg-info';
                                            } elseif(str_contains($project->status, 'PM Mark Up Technical Check')) {
                                                $percentage = 50;
                                                $color = 'bg-info';
                                            } elseif(str_contains($project->status, 'Revenue Head Unit')) {
                                                $percentage = 60;
                                                $color = 'bg-success';
                                            } elseif(str_contains($project->status, 'Finance Head')) {
                                                $percentage = 70;
                                                $color = 'bg-success';
                                            } elseif(str_contains($project->status, 'Sales Releasing of proposal')) {
                                                $percentage = 80;
                                                $color = 'bg-success';
                                            } elseif(str_contains($project->status, 'Sales Proposal Status') || str_contains($project->status, 'Revenue Upload Contractor Bid Summary')) {
                                                $percentage = 90;
                                                $color = 'bg-success';
                                            } elseif (str_contains($project->status, 'Project Completion') || str_contains($project->status, 'Uploading of Documents')) {
                                                $percentage = 95;
                                                $color = 'bg-success';
                                            } elseif (str_contains($project->status, 'Upload CER')) {
                                                $percentage = 96;
                                                $color = 'bg-success';
                                            } elseif (str_contains($project->status, 'Release NTP PO')) {
                                                $percentage = 97;
                                                $color = 'bg-success';
                                            }
                                        @endphp
                                        <div class="small fw-bold text-gray-500"><span>{{ $percentage }} %</span></div>
                                    </div>
                                    <div class="progress mb-0">
                                        <div class="progress-bar {{ $color }}" role="progressbar"
                                             aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"
                                             style="width: {{ $percentage }}%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto ms--2">
{{--                                    <h4 class="h6 mb-0">--}}
{{--                                        <a href="#">{{$project->project_code}}</a>--}}
{{--                                    </h4>--}}
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="{{$color}} dot rounded-circle me-1"></div>
                                        <small>{{$project->status}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-end">
                                <a href="{{ action('BiddingController@viewReportlogs',$project->sales_request_id)}}"
                                   class="btn btn-sm btn-tertiary history" data-bs-toggle="modal"
                                   data-bs-target="#staticBackdrop" data-id="history">
                                    <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    History
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @if($projectStatus->links() != "")
                        <div class="">
                            <div class="float-end">{{$projectStatus->links()}}</div>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        {{--<div class="col-12 col-xxl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h2 class="fs-5 fw-bold mb-0">Users Action History</h2>
                    <a href="#" class="btn btn-sm btn-primary">See all</a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        --}}{{--                                        <img class="rounded" alt="Image placeholder" src="../../assets/img/team/profile-picture-1.jpg">--}}{{--
                                    </div>
                                </div>
                                <div class="col-auto ms--2">
                                    <h4 class="h6 mb-0">
                                        <a href="#">Chris Wood</a>
                                    </h4>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success dot rounded-circle me-1"></div>
                                        <small>Online</small>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <a href="#" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                                        <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        Invite
                                    </a>
                                </div>
                            </div>
                        </li>
                        @foreach($memberLogs as $logs)
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        --}}{{--                                        <img class="rounded" alt="Image placeholder" src="../../assets/img/team/profile-picture-1.jpg">--}}{{--
                                    </div>
                                </div>
                                <div class="col-auto ms--2">
                                    <h4 class="h6 mb-0">
                                        <a href="#">{{$logs->username}}</a>
                                    </h4>
                                    <div class="d-flex align-items-center">
--}}{{--                                        <div class="bg-success dot rounded-circle me-1"></div>--}}{{--
                                        <small>Online</small>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <a href="#" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                                        <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        Invite
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>--}}

        <div class="col-12 col-md-6 col-xxl-4 mb-4">
            <div class="card notification-card border-0 shadow">
                <div class="card-header d-flex align-items-center">
                    <h2 class="fs-5 fw-bold mb-0">Users Recent Activity</h2>
{{--                    <div class="ms-auto"><a class="fw-normal d-inline-flex align-items-center" href="#">--}}
{{--                            <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>--}}
{{--                                <path fill-rule="evenodd"--}}
{{--                                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"--}}
{{--                                      clip-rule="evenodd"></path>--}}
{{--                            </svg>--}}
{{--                            View all</a></div>--}}
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush list-group-timeline">
                        @foreach($memberLogs as $logs)
                            @php
                            $svg="";
                            $iconColor = "";
                            if (str_contains($logs->action, 'Upload') || str_contains($logs->action, 'upload')){
                                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
                                       </svg>
                                        ';
                                $iconColor="warning";
                            }if (str_contains($logs->action, 'Create') || str_contains($logs->action, 'Create')){
                                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                                        </svg>';
                                $iconColor="info";
                            }if (str_contains($logs->action, 'Edit') || str_contains($logs->action, 'edit')){
                                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
</svg>
';
                                $iconColor="info";
                            }if (str_contains($logs->action, 'Disapproved') || str_contains($logs->action, 'disapproved') || str_contains($logs->action, 'Cancel')){
                                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M15.73 5.25h1.035A7.465 7.465 0 0118 9.375a7.465 7.465 0 01-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 01-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.498 4.498 0 00-.322 1.672V21a.75.75 0 01-.75.75 2.25 2.25 0 01-2.25-2.25c0-1.152.26-2.243.723-3.218C7.74 15.724 7.366 15 6.748 15H3.622c-1.026 0-1.945-.694-2.054-1.715A12.134 12.134 0 011.5 12c0-2.848.992-5.464 2.649-7.521.388-.482.987-.729 1.605-.729H9.77a4.5 4.5 0 011.423.23l3.114 1.04a4.5 4.5 0 001.423.23zM21.669 13.773c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.959 8.959 0 01-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227z" />
</svg>
';
                                $iconColor='danger';
                            }if (str_contains($logs->action, 'Approved')/* || str_contains($logs->action, 'approved')*/){
                                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
</svg>
';
                                $iconColor='success';
                            }
                            if (str_contains($logs->action, 'Releas')/* || str_contains($logs->action, 'approved')*/){
                                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
</svg>
';
                                $iconColor='info';
                            }
                            if (str_contains($logs->action, 'Revision')/* || str_contains($logs->action, 'approved')*/){
                $svg= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path fill-rule="evenodd" d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 01-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0113.5 1.5H15a3 3 0 012.663 1.618zM12 4.5A1.5 1.5 0 0113.5 3H15a1.5 1.5 0 011.5 1.5H12z" clip-rule="evenodd" />
  <path d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 019 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0116.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625v-12z" />
  <path d="M10.5 10.5a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963 5.23 5.23 0 00-3.434-1.279h-1.875a.375.375 0 01-.375-.375V10.5z" />
</svg>

';
                $iconColor='danger';
            }
                            @endphp
                        <div class="list-group-item border-0">
                            <div class="row ps-lg-1">
                                <div class="col-auto">
                                    <div class="icon-shape icon-xs icon-shape-{{$iconColor}} rounded">
                                        {!! $svg !!}
                                    </div>
                                </div>

                                <div class="col ms-n2 mb-3">
                                    <h3 class="fs-6 fw-bold mb-0">{{$logs->username}}</h3>
                                    <p class="mb-0">{{$logs->action}}</p>
                                    <p class="fw-thin small mb-0">{{$logs->project_title}}</p>

                                    <div class="d-flex align-items-center">
                                        <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="small">{{\Carbon\Carbon::parse($logs->date_time)->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card border-1 border-primary shadow bg-info bg-opacity-10 mb-4">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    {{--            <div class="card border-0 bg-gradient shadow position-relative">--}}
                    {{--                <a href="{{ action('SalesrequestController@sr_disapproved_header') }}">--}}
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape text-info rounded me-4 me-sm-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                    </svg>

                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5 text-gray-900">All Projects</h2>
                                    <h3 class="fw-extrabold mb-1">{{$projectAll}}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-900 fw-bolder mb-0">All Projects</h2>
                                    <h3 class="fw-extrabold mb-2">{{$projectAll}}</h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-500">
                                    <br>
                                    {{--                                    Feb 1 - Apr 1,--}}
                                    {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                    {{--                                    USA--}}
                                </small>
                                <div class="small d-flex mt-1">
                                    <div>All projects in the system</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                </a>--}}
                    {{--            </div>--}}
                </div>

                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    {{--            <div class="card border-0 shadow position-relative">--}}
                    {{--                <a href="{{ action('SalesrequestController@sr_disapproved_header') }}">--}}
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape text-secondary rounded me-4 me-sm-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
                                    </svg>

                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5 text-gray-900">Ongoing Projects</h2>
                                    <h3 class="fw-extrabold mb-1">{{$projectOngoing}}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-700 fw-bolder mb-0">Ongoing Projects</h2>
                                    <h3 class="fw-extrabold mb-2">{{$projectOngoing}}</h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-500">
                                    <br>
                                    {{--                                    Feb 1 - Apr 1,--}}
                                    {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                    {{--                                    USA--}}
                                </small>
                                <div class="small d-flex mt-1">
                                    <div>Pending projects in the system</div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @if($showCounts14 > 0)--}}
{{--                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">--}}
{{--                                                        <span class="visually-hidden">New alerts</span>--}}
{{--                                                    </span>--}}
{{--                    @endif--}}
                    {{--                </a>--}}
                    {{--            </div>--}}
                </div>

                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    {{--            <div class="card border-0 shadow position-relative">--}}
                    {{--                <a href="{{ action('SalesrequestController@sr_disapproved_header') }}">--}}
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape text-success rounded me-4 me-sm-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/>
                                    </svg>

                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5 text-gray-900">Projects Completed</h2>
                                    <h3 class="fw-extrabold mb-1">{{$projectCompleted}}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-700 fw-bolder mb-0">Projects Completed</h2>
                                    <h3 class="fw-extrabold mb-2">{{$projectCompleted}}</h3>
                                </div>
                                <small class="d-flex align-items-center text-gray-500">
                                    <br>
                                    {{--                                    Feb 1 - Apr 1,--}}
                                    {{--                                    <svg class="icon icon-xxs text-gray-500 ms-2 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>--}}
                                    {{--                                    USA--}}
                                </small>
                                <div class="small d-flex mt-1">
                                    <div>Projects completed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                </a>--}}
                    {{--            </div>--}}
                </div>



            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection
