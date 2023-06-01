@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4 ms-2">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Sales Request</h1>
                {{--        <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                id="showModalButton">
            Add New Request
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Sales Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="loading-spinner" style="display:none;">Loading...
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </div>
                        {{--Form Loaded dynamically--}}
                        <div id="modal-content-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Sales Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="loading-spinner" style="display:none;">Loading...
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </div>
                        {{--Form Loaded dynamically--}}
                        <div id="edit-modal-dialog"></div>
                    </div>
                </div>
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
                        </div><br/>
                    @endif


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered ">
                            <thead class="thead-light">
                            <tr>
                                <th>Mall Name</th>
                                <th>Project Title</th>
                                <th>Project Status</th>
                                <th>History</th>
                                <th>Proposal Target Date</th>
                                <th>Date Requested</th>

                                <th>Revision</th>
                                <th>Qoutation Addressee</th>
                                <th>Requester</th>
                                <th>PM Assigned</th>
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
                                    <td class="text-wrap">{{$salesrequest->project_title}}</td>
                                    <td class="text-danger fw-bolder">{{$salesrequest->status}}</td>
                                    <td>
                                        {{--                                            <a href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"--}}
                                        {{--                                               class="btn btn-sm btn-secondary modal-global m-0">--}}
                                        {{--                                                History--}}
                                        {{--                                            </a>--}}
                                        <button type="button"
                                                href="{{ action('BiddingController@viewReportlogs',$salesrequest->sales_request_id)}}"
                                                class="btn btn-sm btn-tertiary history" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop" data-id="history">
                                            History
                                        </button>
                                    </td>
                                    <td>{{$salesrequest->date_needed}}</td>

                                    <td>{{$salesrequest->created_at}}</td>

                                    <td>{{$salesrequest->revision}}</td>
                                    <td>{{$salesrequest->qoutation_addressee}}</td>
                                    <td>{{$salesrequest->requester}}</td>
                                    {{--                              <td><a href="{{ action('BiddingController@viewLogs',$salesrequest->sales_request_id)}}" class="btn btn-primary modal-global">History</a></td>--}}


                                    <td>{{$salesrequest->username}}</td>
                                    <td>{{$salesrequest->project_age}}</td>
                                    <td>{{$salesrequest->project_code}}</td>
                                    <td>{{$salesrequest->sales_request_code}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary edit_modal"
                                                data-id="{{$salesrequest->sales_request_id}}"
                                                data-bs-toggle="modal" data-bs-target="#editModal" id="editModalButton">
                                            Edit
                                        </button>


                                        {{--                                            <a href="{{ action('SalesrequestController@edit',$salesrequest->sales_request_id)}}" class="btn btn-sm btn-primary m-0">Edit</a>--}}

                                        <a href="{{ action('SalesrequestController@cancel_request',$salesrequest->sales_request_id)}}"
                                           class="btn btn-sm btn-danger m-0">Cancel</a>
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
    {{--Datatable--}}
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
                        targets: [0,6,7,8,9,11,12],
                        responsivePriority: 1,
                        className: 'none',
                        // render: function(data, type, row, meta) {
                        //     return type === 'display' && $(window).width() < 768 ? '-' : data;
                        // }
                    }
                    ]
            });
        });
    </script>

    {{--Add new Sales Request Modal without Jquery--}}
    <script>
        document.getElementById('showModalButton').addEventListener('click', function () {
            console.log('add')
            var modal = document.getElementById('exampleModal');
            var loadingSpinner = document.getElementById('loading-spinner');

            // Show loading spinner
            loadingSpinner.style.display = 'block';

            // Make a fetch request to fetch the dynamic content
            fetch('{{ url('create_salesrequest') }}')
                .then(response => response.json())
                .then(data => {
                    loadingSpinner.style.display = 'none';
                    modal.querySelector('#modal-content-placeholder').innerHTML = data;
                });
        });

    </script>

    <script>
        document.querySelectorAll('.edit_modal').forEach(function (element) {
            element.addEventListener('click', function () {
                // var salesRequestId = document.querySelector("#editModalButton").getAttribute("data-id");
                var salesRequestId = element.getAttribute("data-id");
                var modal = document.querySelector('#editModal');
                var loadingSpinner = document.querySelector('#loading-spinner');
                console.log(salesRequestId)

                // Show loading spinner
                loadingSpinner.style.display = 'block';

                // Make a fetch request to fetch the dynamic content
                fetch('{{ url('edit_salesrequest') }}' + salesRequestId)
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        loadingSpinner.style.display = 'none';
                        modal.querySelector('#edit-modal-dialog').innerHTML = data;
                    });
            });
        });
    </script>

@endsection
