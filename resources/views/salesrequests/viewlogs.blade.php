@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Logs</h1>
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
                            </div><br />
                        @endif
                        <table id="datatable" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <td>Project Title</td>
                                <td>User</td>
                                <td>Action</td>
                                <td>Date Time</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($request_logs as $request_log)
                                <tr>
                                    <td>{{$request_log->project_title}}</td>
                                    <td>{{$request_log->username}}</td>
                                    <td>{{$request_log->action}}</td>
                                    <td>{{\Carbon\Carbon::parse($request_log->date_time)->format('d-F-Y h:i a ')}}</td>
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
                        // targets: [0, 1, 2, 3, 6, 9, 11, 12],
                        responsivePriority: 1,
                        className: 'none',
                    }
                ]
            });
        });
    </script>
@endsection
