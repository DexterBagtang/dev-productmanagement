@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Uploading of CER </h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    <div class="table-responsive">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div><br/>
                        @endif
                        <table id="datatable" class="table table-striped table-bordered dt-responsive " cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <td>Mall Name</td>
                                <td>Revision</td>
                                <td>Qoutation Addressee</td>
                                <td>Requester</td>
                                <td>Project Title</td>
                                <td>Proposal Target Date</td>
                                <td>Date Requested</td>
                                <td>Project Status</td>
                                <td>History</td>
                                <td>Project Age</td>
                                <td>Project Code</td>
                                <td>Sales Request Code</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesrequests as $salesrequest)
                                <tr>
                                    <td>{{$salesrequest->mall_name}}</td>
                                    <td>{{$salesrequest->revision}}</td>
                                    <td>{{$salesrequest->qoutation_addressee}}</td>
                                    <td>{{$salesrequest->requester}}</td>
                                    <td>{{$salesrequest->project_title}}</td>
                                    <td>{{$salesrequest->date_needed}}</td>
                                    <td>{{$salesrequest->created_at}}</td>
                                    <td>{{$salesrequest->status}}</td>
                                    <td>
                                      <button type="button"
                                              href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"
                                              class="btn btn-sm btn-tertiary history" data-bs-toggle="modal"
                                              data-bs-target="#staticBackdrop" data-id="history">
                                        History
                                      </button>
                                    </td>
                                    <td>{{$salesrequest->project_age}}</td>
                                    <td>{{$salesrequest->project_code}}</td>
                                    <td>{{$salesrequest->sales_request_code}}</td>
                                    <td>
                                        <a href="{{ action('SalesrequestController@upload_cer_details',$salesrequest->sales_request_id)}}"
                                           class="btn btn-primary btn-sm">Upload</a></td>

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
            $('#datatable').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                // stateSave: true,
                aaSorting: [],
                autoWidth: false,
                responsive: true,
                columnDefs: [
                    {
                        targets: [0, 1, 2, 3, 6, 9, 11],
                        responsivePriority: 1,
                        className: 'none',
                    }
                ]
            });
        });
    </script>
@endsection
