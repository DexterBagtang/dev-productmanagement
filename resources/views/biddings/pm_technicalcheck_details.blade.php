@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Approve Philcom Proposal</h1>
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
                        </div><br />
                    @endif
                    @foreach($salesrequests as $salesrequest)
                        <form method="get" action="{{ action('BiddingController@pm_approved_markup',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @method('PATCH')
                            @csrf
                            @if($salesrequest->reason_for_revision != null)
                                <div class="row g-2">
                                    <div class="col-12" style="padding: 10px;">
                                        <label class="form-label red" style="font-size: 18px" for="category">Reason For Revision:</label>
                                        <div class="">
                                            <textarea type="text" class="form-control" name="reason_for_revision" rows="6" readonly >{{$salesrequest->reason_for_revision}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endif
                            <div class="row g-2"><br>
                                <div class="col-12">
                                    <label class="form-label" for="project_title">Project Title:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label" for="project_code">Project Code:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_code" value="{{ $salesrequest->project_code }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label" for="project_status">Project Status:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_status" value="{{ $salesrequest->status }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="project_requirements_files">Project Requirements:</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}" target="_blank" class="badge bg-info">{{($salesrequest->project_requirements_files != null)? '📂':'' }} {{ $salesrequest->project_requirements_files }} </a>
                                    </div>
                                </div>

                                @if ($salesrequest->category == 'Special')
                                    <div class="col-12">
                                        <label class="form-label" for="project_category">Project Category:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="project_category" value="{{ $salesrequest->category }}" disabled/>
                                        </div>
                                    </div>
                                @endif
                            </div><br>

                            @if($salesrequest->category !== 'Special')
                                <div class="row g-2"><br>
                                    <div class="col-12">
                                        <label class="form-label" for="category">Bidder:</label>
                                        <div class="fw-bolder">

                                            <div class="table-responsive">
                                                <table id="projectdesign" class="table table-bordered">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Trade</th>
                                                        <th>Contractor Name</th>
{{--                                                        <th>Total Cost</th>--}}
                                                    </tr>
                                                    </thead>
                                                    @foreach($biddingdetails as $biddingdetail)
                                                        <tr>
                                                            <td>{{$biddingdetail->bid_trade}}</td>
                                                            <td>{{$biddingdetail->contractor_name}}</td>
{{--                                                            <td>{{$biddingdetail->total_cost}}</td>--}}
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                  <div class="col">--}}
                                    {{--                      <label class="form-label" for="sales_request_code">Bid File:</label>--}}
                                    {{--                    <div class="">--}}
                                    {{--                    <a href="/storage/uploads/{{ $salesrequest->bid_file }}" target="_blank" class="clickable">{{$salesrequest->bid_file}}</a>--}}
                                    {{--                    </div>--}}
                                    {{--                  </div>--}}
                                </div>
                            @endif

                            <div class="row g-2 mt-2"><br>
                                <div class="col">
                                    <label class="form-label" for="category">Philcom Proposal:</label>
                                    <div class="">

                                        <DIV class="table-responsive">
                                            <table id="projectdesign" class="table table-bordered" width="100%">

                                                @foreach($mark_ups as $mark_up)
                                                    <div>
                                                        <div>
                                                            <a href="/storage/uploads/{{ $mark_up->mark_up_file }}" target="_blank" class="badge bg-info">
                                                                <b>{{($mark_up->mark_up_file != null)? '📂':'' }} {{$mark_up->mark_up_file}}</b></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </table>
                                        </DIV>
                                    </div>
                                </div>

                                {{--                    @if($salesrequest->reason_for_revision != null)--}}
                                {{--                    <div class="col">--}}
                                {{--                        <label class="form-label" for="category">Reason For Revision</label>--}}
                                {{--                        <div class="">--}}
                                {{--                            <textarea type="text" class="form-control" name="reason_for_revision" rows="6" >{{$salesrequest->reason_for_revision}}</textarea>--}}
                                {{--                        </div>--}}
                                {{--                    </div>--}}
                                {{--                    @endif--}}
                            </div>

                            <br>
                            <div class="row g-2">
                                <div class="col">
                                    <label class="form-label" for="remarks">Approved:</label>
                                    <div class="">
                                        <input type="radio"  name="approved_status" value ="Yes" onclick="yesnoCheck();" id="yesCheck"> Yes   ||
                                        <input type="radio"  name="approved_status" value ="No" onclick="yesnoCheck();" id="noCheck"> No
                                    </div>
                                </div>
                                <div id ="show_remark">
                                    <div class="col">
                                        <label class="form-label" for="remarks">Remarks: </label>
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="remarks" id="remarks" />
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="mall_id2"  value ="{{ $salesrequest->mall_id }}"  />
                                <input type="hidden" class="form-control" name="sales_request_id2" value ="{{ $salesrequest->sales_request_id }}"  />
                                <input type="hidden" class="form-control" name="approver_id" id="approver_id" value ="{{ Auth::user()->id }}"  />
                                <div class="col">
                                    <div class=" col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ action('BiddingController@pm_technicalcheck_header') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
    <script>
        $(document).ready(function(){
            $('input:checkbox').click(function() {
                $('input:checkbox').not(this).prop('checked', false);
            });
        });
    </script>
@endsection
