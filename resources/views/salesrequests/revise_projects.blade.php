@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')

    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Revise Project</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <div class="table-responsive" id="myGrid">
                        <table id="revise_table" class="table table-centered">
                            <thead class="thead-light">
                            <tr>
                                {{--                                <th>Mall Name</th>--}}
                                <th>Project Title</th>
                                <th>Proposal Target Date</th>
                                <th>Date Requested</th>
                                <th>Project Status</th>
                                <th>History</th>
                                <th>Project Age</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesrequests as $salesrequest)
                                <tr>
                                    {{--                                    <td>{{$salesrequest->mall_name}}</td>--}}
                                    <td class="text-wrap">{{$salesrequest->project_title}}</td>
                                    <td>{{\Carbon\Carbon::parse($salesrequest->date_needed)->format('d-F-Y')}}</td>
                                    <td>{{$salesrequest->created_at}}</td>
                                    <td>{{$salesrequest->status}}</td>
                                    <td>
                                        {{--                                        <a href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"--}}
                                        {{--                                           class="btn btn-primary history" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="history">History</a>--}}
                                        <button type="button" href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"
                                                class="btn btn-sm btn-tertiary m-0 history" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="history">
                                            History
                                        </button>
                                    </td>
                                    <td>{{$salesrequest->project_age}}</td>
                                    <td>
                                        <a href="{{ action('SalesrequestController@revise',$salesrequest->sales_request_id)}}" class="btn btn-sm btn-primary m-0">
                                            Revise
                                        </a>
                                        {{--                                            <a href="{{ action('SalesrequestController@timeline',$salesrequest->sales_request_id)}}" class="btn btn-danger">--}}
                                        {{--                                                <i class="fa fa-refresh" style="margin-right:5px;" aria-hidden="true"></i>Timeline</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#revise_table').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                stateSave: true,
                aaSorting:[],
                autoWidth:false,
            });
        });
    </script>
@endsection
