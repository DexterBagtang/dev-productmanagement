@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
    <style>
        .red_td {
            background-color: #FF0000;
        }

        .green_td {
            background-color: #008000;
            color: red;
        }

        .green_tds {
            color: black;
        }

        /** {*/
        /*    border: 1px solid red !important;*/
        /*}*/
    </style>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Upload Files</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
            <div>
                <form method="get" action="{{ action('SalesrequestController@viewdocs_usr')}}" class="form-horizontal">
                    <div class="row">
                        <label class="col-form-label" for="search_opt">Search Option:</label>
                        <div class="col">
                            <select id="search_opt" name="search_opt" class="form-select" required>
                                <option value="sales_request_code">Sales Request Code</option>
                                <option value="mall_name">Mall Name</option>
                                <option value="project_title">Project Title</option>
                                <option value="status">Project Status</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" id="usr_search" name="usr_search" class="form-control">
                        </div>
                        <div class="col-2">
                            <button type="submit" name="btn_search" class="btn btn-primary btn-round">SEARCH</button>
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
                        <table id="datatable" class="table table-centered"
                               cellspacing="0" width="100%">
                            <thead class="thead-light">
                            <tr>
{{--                                <th>Mall Name</th>--}}
                                <th>Project Title</th>
                                <th>Status</th>
                                <th>Sales Request Code</th>
                                <th>Contractor NTP</th>
                                <th>CER</th>
                                <th>Contractor PO</th>
                                <th>CARI</th>
                                <th>1st COPA</th>
                                <th>2nd COPA</th>
                                <th>COCA</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesrequests as $salesrequest)
                                <tr>
{{--                                    <td>{{$salesrequest->mall_name}}</td>--}}
                                    <td class="text-wrap">{{$salesrequest->project_title}}</td>
                                    <td class="">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="bg-success dot rounded-circle me-1"></div>
                                            </div>
                                            <div class="">{{$salesrequest->status}}</div>
                                        </div>
                                    </td>

                                    @if (Auth::user()->role == '4' || Auth::user()->role == '8' || Auth::user()->role == '5' )
                                        <td>
                                            <a href="{{ action('SalesrequestController@uploadfiles_details',$salesrequest->sales_request_id)}}">
                                                <small>{{$salesrequest->sales_request_code}}</small><br>
                                                <div class="btn btn-sm btn-success m-0">Upload</div>
                                            </a>
                                        </td>
                                    @else
                                        <td>{{$salesrequest->sales_request_code}}</td>
                                    @endif

                                    <td class="text-wrap align-middle">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->contractor_ntp == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->contractor_ntp)
                                                        <a href="{{ asset('storage/uploads/' . $salesrequest->contractor_ntp) }}"
                                                           target="_blank">
                                                            <small>{{ $salesrequest->contractor_ntp }}</small>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                    </td>

                                    <td class="text-wrap align-middle">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->cer_files == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->cer_files)
                                                    <a href="/storage/uploads/{{ $salesrequest->cer_files }}"
                                                       target="_blank"><small>{{$salesrequest->cer_files}}</small>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-wrap align-middle">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->contractor_po == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->contractor_po)
                                                        <a href="/storage/uploads/{{ $salesrequest->contractor_po }}"
                                                           target="_blank"><small>{{$salesrequest->contractor_po}}</small>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-wrap align-middle">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->cari == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->cari)
                                                        <a href="/storage/uploads/{{ $salesrequest->cari }}"
                                                           target="_blank"><small>{{$salesrequest->cari}}</small>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-wrap align-middle">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->first_copa == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->first_copa)
                                                        <a href="/storage/uploads/{{ $salesrequest->first_copa }}"
                                                           target="_blank"><small>{{$salesrequest->first_copa}}</small>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-wrap align-middle">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->second_copa == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->second_copa)
                                                        <a href="/storage/uploads/{{ $salesrequest->second_copa }}"
                                                           target="_blank"><small>{{$salesrequest->second_copa}}</small>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-wrap align-middle">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="bg-{{ $salesrequest->coca == '' ? 'danger' : 'success' }} dot rounded-circle me-1"></div>
                                                </div>
                                                <div>
                                                    @if($salesrequest->coca)
                                                        <a href="/storage/uploads/{{ $salesrequest->coca }}"
                                                           target="_blank"><small>{{$salesrequest->coca}}</small>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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
            $('#datatable').DataTable({
                aaSorting: [],
                responsive:true,
                // autoWidth: false,
                fixedHeader: true,
                // stateSave: true,
            });
        });
    </script>
@endsection
