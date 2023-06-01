@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Update Sales Proposal</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                    @endif
                    @foreach($salesrequests as $salesrequest)
                        <form method="post"
                              action="{{ action('SalesrequestController@po_ntp_upload',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @csrf

                            <div class="row g-2"><br>
                                <div class="col-12">
                                    <label class="form-label"
                                           for="project_title">Project Title:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_title"
                                               value="{{ $salesrequest->project_title }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label"
                                           for="project_code">Project Code:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_code"
                                               value="{{ $salesrequest->project_code }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label"
                                           for="project_status">Project Status:</label>
                                    <div class="">
                                        <input type="text" class="form-control"
                                               name="project_status"
                                               value="{{ $salesrequest->status }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label"
                                           for="project_requirements_files">Project Requirements:</label>
                                    <div class="col-4">
                                        <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}"
                                           target="_blank"
                                           class="form-control">📂 {{ $salesrequest->project_requirements_files }} </a>
                                    </div>
                                </div>
                                @if ($salesrequest->category == 'Special')
                                <div class="col-12">
                                    <label class="form-label"
                                           for="project_category">Project Category:</label>
                                    <div class="">
                                        <input type="text" class="form-control"
                                               name="project_category"
                                               value="{{ $salesrequest->category }}" disabled/>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <br>

                            <br>
                            <div class="row g-2"><br>
                                <div class="col-12">
                                    <label class="form-label"
                                           for="category">Philcom Proposal:</label>
                                    <div class="">
                                        @foreach($mark_ups as $mark_up)
                                            <div>
                                                <a href="/storage/uploads/{{ $mark_up->mark_up_file }}"
                                                   target="_blank"
                                                   class="badge bg-info"><b>{{$mark_up->mark_up_file}}</b></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row g-2"><br>

                                <div class="col-12">
                                    <label class="form-label"
                                           for="remarks">Approved:</label>
                                    <div class="">
                                        <input type="radio" name="approved_status" value="Yes"
                                               onclick="yesnoCheck();" id="yesCheck"> Yes ||
                                        <input type="radio" name="approved_status" value="No"
                                               onclick="yesnoCheck();" id="noCheck"> No
                                    </div>
                                </div>


                                <div id="show_files">
                                    <div class="col-12">
                                        <label class="form-label"
                                               for="po_ntp_files">PO / NTP Files:</label>
                                        <div class="col-6">
                                            <input type="file" class="form-control"
                                                   name="po_ntp_files">
                                            <input type="hidden" class="form-control"
                                                   name="po_ntp_files_exist"
                                                   value="{{ $salesrequest->po_ntp_files }}">
                                            <a href="/storage/uploads/{{ $salesrequest->po_ntp_files }}"
                                               target="_blank"
                                               class="badge bg-info">{{ $salesrequest->po_ntp_files }}</a>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label"
                                               for="po_ntp_files">Proposal:</label>
                                        <div class="col-6">
                                            <input type="file" class="form-control"
                                                   name="proposal_files">
                                            <input type="hidden" class="form-control"
                                                   name="proposal_files_exist"
                                                   value="{{ $salesrequest->proposal_files }}">
                                            <a href="/storage/uploads/{{ $salesrequest->proposal_files }}"
                                               target="_blank"
                                               class="badge bg-info">{{ $salesrequest->proposal_files }}</a>

                                        </div>
                                    </div>
                                </div>
                                <div id="show_remark">
                                    <div class="col-12">
                                        <label class="form-label"
                                               for="remarks">Remarks: </label>
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="remarks"
                                                   id="remarks"/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"
                                               for="project_return">Return: </label>
                                        <div class="">
                                            <select name='project_return' class="form-select">
                                                <option disabled selected=selected> -- select an
                                                    option --
                                                </option>
                                                <option value="PM">PM(PM Design)</option>
                                                {{--                                                                    <option value="Purchasing">Purchasing(Bidding)</option>--}}
                                                <option value="Revenue">Revenue</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">

                                    </div>

                                </div>


                                <input type="hidden" class="form-control" name="mall_id2"
                                       value="{{ $salesrequest->mall_id }}"/>
                                <input type="hidden" class="form-control" name="sales_request_id2"
                                       value="{{ $salesrequest->sales_request_id }}"/>
                                <input type="hidden" class="form-control" name="approver_id"
                                       id="approver_id" value="{{ Auth::user()->id }}"/>
                                <div class="col-12">
                                    <div class=" col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit
                                        </button>
                                        <a href="{{ action('SalesrequestController@po_ntp_header') }}">
                                            <button type="button" class="btn btn-primary">Cancel
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        document.getElementById('show_remark').style.display = 'none';
        document.getElementById('show_files').style.display = 'none';

        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('show_remark').style.display = 'none';
                document.getElementById('remarks').required = false;
                document.getElementById('show_files').style.display = 'block';
            } else {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = true;
                document.getElementById('show_files').style.display = 'none';
            }

        }

    </script>
@endsection
