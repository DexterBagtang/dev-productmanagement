@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Project Status</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}

            </div>
            <div class="me-2">
                <form method="get" action="{{ action('SalesrequestController@viewprojectstatus_usr')}}"  enctype="multipart/form-data"
                      class="">
                    <div class="row ">
                        <label for="" class="col-form-label">Search Option :</label>
                        <div class="col">
                            <select name='search_opt' class="col form-select" required>
                                <option value="sales_request_code" >Sales Request Code </option>
                                <option value="mall_name" >Mall Name </option>
                                <option value="project_title" >Project Title </option>
                                <option value="status" >Project Status </option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" name="usr_search" class="form-control">
                        </div>

                        <div class="col-2">
                            <input type="submit" name="btn_search" value="SEARCH" class="btn btn-sm btn-round btn-primary me-2">
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="status" class="table table-centered rounded">
                            <thead class="thead-light">
                            <tr>
                                <th>Project Title</th>
                                <th>Project Status</th>
                                <th>History</th>
                                <th>Mall Name</th>
                                <th>Revision</th>
                                <th>Qoutation Addressee</th>
                                <th>Requester</th>
                                <th>Proposal Target Date</th>
                                <th>Date Requested</th>
                                <th>PM Assigned</th>
                                <th>Project Age</th>
                                <th>Project Code</th>
                                <th>Sales Request Code</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesrequests as $salesrequest)
                                <tr>
                                    <td class="text-wrap">{{$salesrequest->project_title}}</td>
                                    <td class="text-danger fw-bolder">{{$salesrequest->status}}</td>

                                    <td><button type="button"
                                                href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"
                                                class="btn btn-sm btn-tertiary history m-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop"
                                                data-id="history">
                                            History
                                        </button>
                                    </td>
                                    <td>{{$salesrequest->mall_name}}</td>
                                    <td>{{$salesrequest->revision}}</td>
                                    <td>{{$salesrequest->qoutation_addressee}}</td>
                                    <td>{{$salesrequest->requester}}</td>
                                    <td>{{\Carbon\Carbon::parse($salesrequest->date_needed)->format('d-M-Y')}}</td>
                                    <td>{{$salesrequest->created_at}}</td>
                                    <td>{{$salesrequest->username}}</td>
                                    <td>{{$salesrequest->project_age}}</td>
                                    <td>{{$salesrequest->project_code}}</td>
                                    <td>{{$salesrequest->sales_request_code}}</td>
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
        $(document).ready( function () {
            $('#status').DataTable({
                aaSorting:[],
                responsive:true,
                autoWidth:false,
                fixedHeader:true,
                // stateSave:true,
                columnDefs: [
                    {
                        targets: [3,4,5,8,9,11,12],
                        responsivePriority: 1,
                        className: 'none',
                    }
                ]
            });
        });
    </script>
@endsection
