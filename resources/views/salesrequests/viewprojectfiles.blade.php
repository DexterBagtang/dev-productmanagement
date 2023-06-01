@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Project Files</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="files" class="table table-centered table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Mall Name</th>
                                <th>Project Title</th>
                                <th>Sales Request Code</th>
                                <th>Project Design</th>
                                <th>BOM File</th>
                                <th>Mark up File</th>
                                <th>P&L File</th>
                                <th>Proof & Additional Attachments</th>
                                <th>PO/NTP File</th>
                                <th>Proposal File</th>
                                <th>Bid Summary</th>
                                <th>Proof of Cancellation</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesrequests as $salesrequest)
                                <tr>
                                    <td>{{$salesrequest->mall_name}}</td>
                                    <td class="text-wrap">{{$salesrequest->project_title}}</td>
                                    <td>{{$salesrequest->sales_request_code}}</td>
                                    @if (Auth::user()->role == '3' )
                                        <td>
                                            <button href="{{ action('SalesrequestController@viewDesign',$salesrequest->sales_request_id)}}"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button"
                                                    class="btn btn-sm btn-primary m-0 history">Project Design</button>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if (Auth::user()->role == '3' || Auth::user()->role == '4' || Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '7' )
                                        <td>📂
                                            <a href="/storage/uploads/{{ $salesrequest->bid_file }}" class="text-info"
                                               target="_blank">{{$salesrequest->bid_file}} </a>
                                        </td>
                                    @else
                                        <td>📂</td>
                                    @endif

                                    @if (Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '7' )
                                        <td>📂<a href="/storage/uploads/{{ $salesrequest->mark_up_file }}"
                                               target="_blank">{{$salesrequest->mark_up_file}}</a></td>
                                        <td>📂<a href="/storage/uploads/{{ $salesrequest->pnl_file }}"
                                               target="_blank">{{$salesrequest->pnl_file}}</a></td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif

                                    <td>@foreach(explode(',',$salesrequest->proof_of_sending) as $file)
                                            📂
                                            <a href="/storage/uploads/{{ $file }}" class="text-info"
                                               target="_blank">{{$file}}
                                            </a> <br>
                                        @endforeach
                                    </td>
                                    @if (Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '7' || Auth::user()->role == '8' )
                                        <td>📂<a href="/storage/uploads/{{ $salesrequest->po_ntp_files }}"
                                               target="_blank">{{$salesrequest->po_ntp_files}}</a></td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if (Auth::user()->role == '3' || Auth::user()->role == '5' || Auth::user()->role == '6' || Auth::user()->role == '7' || Auth::user()->role == '8' )
                                        <td>📂<a href="/storage/uploads/{{ $salesrequest->proposal_files }}"
                                               target="_blank">{{$salesrequest->proposal_files}}</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if (Auth::user()->role == '4' || Auth::user()->role == '5' )
                                        <td>📂<a href="/storage/uploads/{{ $salesrequest->bid_summary_files }}"
                                               target="_blank">{{$salesrequest->bid_summary_files}}</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>📂<a href="/storage/uploads/{{ $salesrequest->proof_of_cancellation }}"
                                           target="_blank">{{$salesrequest->proof_of_cancellation}}</a></td>
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
            $('#files').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                // stateSave: true,
                aaSorting: [],
                autoWidth: false,
                responsive: true,
                columnDefs: [
                    {
                        targets: [2],
                        responsivePriority: 1,
                        className: 'none',
                    }
                ]
            });
        });
    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#datatable').DataTable({--}}
{{--                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],--}}
{{--                // stateSave: true,--}}
{{--                aaSorting: [],--}}
{{--                autoWidth: false,--}}
{{--                responsive: true,--}}
{{--                columnDefs: [--}}
{{--                    {--}}
{{--                        targets: [0, 1, 2, 3, 6, 9, 11, 12],--}}
{{--                        responsivePriority: 1,--}}
{{--                        className: 'none',--}}
{{--                    }--}}
{{--                ]--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
