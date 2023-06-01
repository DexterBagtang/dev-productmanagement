@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Project Bidding</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                  @if(session()->get('success'))
                    <div class="alert alert-success">
                      {{ session()->get('success') }}
                    </div><br />
                  @endif
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Mall Name</th>
                                <th>Revision</th>
                                <th>Qoutation Addressee</th>
                                <th>Requester</th>
                                <th>Project Title</th>
                                <th>Proposal Target Date</th>
                              <th>History</th>
                              <th>Date Requested</th>
                                <th>Project Status</th>
                                <th>Project Age</th>
                                <th>Project Code</th>
                                <th>Sales Request Code</th>
                                <th>Action</th>
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
                                  <td>
                                    <button type="button"
                                            href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"
                                            class="btn btn-sm btn-tertiary history" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop" data-id="history">
                                      History
                                    </button>
                                  </td>
                                    <td>{{$salesrequest->created_at}}</td>
                                    <td class="text-danger fw-bolder">{{$salesrequest->status}}</td>
                                    {{--                            <td><a href="{{ action('BiddingController@viewLogs',$salesrequest->sales_request_id)}}" class="btn btn-primary modal-global">History</a></td>--}}


                                    <td>{{$salesrequest->project_age}}</td>
                                    <td>{{$salesrequest->project_code}}</td>
                                    <td>{{$salesrequest->sales_request_code}}</td>
                                    @if ($role == '4')
                                    <td>
                                      <a href="{{ action('BiddingController@edit',$salesrequest->project_id)}}" class="btn btn-primary">
                                        Upload
                                      </a>
                                      <a href="{{ route('biddings.show',$salesrequest->project_id)}}" class="btn btn-info">
                                        View
                                      </a>
                                    </td>
                                    @elseif ($role == '3')
                                    <td>
                                        <a href="{{ action('BiddingController@pm_approve_bidder_detail',$salesrequest->sales_request_id)}}"
                                           class="btn btn-primary">Review</a></td>
                                    @elseif ($role == '5')
                                    <td>
                                        <a href="{{ action('BiddingController@revenue_approve_bidder_detail',$salesrequest->sales_request_id)}}"
                                           class="btn btn-info">Mark Up</a></td>
                                    @else
                                    <td></td>
                                    @endif
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
                        targets: [0, 1, 2, 3, 9, 10, 11],
                        responsivePriority: 1,
                        className: 'none',
                    }
                ]
            });
        });
    </script>
@endsection
