@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Approve Bidders</h1>
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
                        <form method="get" action="{{ action('BiddingController@pm_approved_bidding',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @method('PATCH')
                            @csrf
                            <div class="">
                                @if($salesrequest->reason_for_revision != null)
                                    <div class="row g-2">
                                        <div class="col" style="padding: 10px;">
                                            <label class="form-label red" style="font-size: 18px" for="category">Reason For Revision:</label>
                                            <div class="">
                                                <textarea type="text" class="form-control" name="reason_for_revision" rows="6" readonly >{{$salesrequest->reason_for_revision}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label class="form-label" for="project_title">Project Title:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" disabled/>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label class="form-label" for="project_code">Project Code:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="project_code" value="{{ $salesrequest->project_code }}" disabled/>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <label class="form-label" for="project_status">Project Status:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="project_status" value="{{ $salesrequest->status }}" disabled/>
                                        </div>
                                    </div>
                                </div>
                                    <hr>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label class="form-label" for="category">Bidder:</label>
                                        <div class="card">

                                            <DIV class="table-responsive">
                                                <table id="projectdesign" class="table table-bordered" width="100%">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Trade</th>
                                                        <th>Contractor Name</th>
{{--                                                        <th>Total Cost</th>--}}
                                                        <th>Select</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($biddingdetails as $biddingdetail)
                                                        <tr>
                                                            <td>{{$biddingdetail->bid_trade}}</td>
                                                            <td>{{$biddingdetail->contractor_name}}</td>
{{--                                                            <td>{{$biddingdetail->total_cost}}</td>--}}

                                                            <td><input type="checkbox" name="bidder[]" class="check" value="{{$biddingdetail->id}}"></td>
                                                    @endforeach
                                                </table>
                                            </DIV>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="sales_request_code">Bid File:</label>
                                        <div class="col-6">
                                            @if($salesrequest->bid_file != null)
                                            <a href="/storage/uploads/{{ $salesrequest->bid_file }}" target="_blank" class="badge bg-info">📂{{$salesrequest->bid_file}}</a>
                                            @endif
                                            <input type="file" class="form-control d-none" name="bid_file" >
                                            <input type="hidden" name="existing_bid_file" value="{{$salesrequest->bid_file}}">
                                        </div>
                                    </div>
                                </div>
                                    <hr>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="remarks">Approved:</label>
                                        <div class="">
                                            <input type="radio"  name="approved_status" value ="Yes" onclick="yesnoCheck();" id="yesCheck"> Yes   ||
                                            <input type="radio"  name="approved_status" value ="No" onclick="yesnoCheck();" id="noCheck"> No
                                        </div>
                                    </div>

                                    <div id="show_remark">
                                        <div class="col-12">
                                            <label class="form-label" for="remarks">Remarks: </label>
                                            <div class="col-6">
                                                <textarea type="text" class="form-control" name="remarks" id="remarks" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" name="mall_id2"  value ="{{ $salesrequest->mall_id }}"  />
                                    <input type="hidden" class="form-control" name="sales_request_id2" value ="{{ $salesrequest->sales_request_id }}"  />
                                    <input type="hidden" class="form-control" name="approver_id" id="approver_id" value ="{{ Auth::user()->id }}"  />
                                    <div class="col">
                                        <div class=" col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ action('BiddingController@index',Auth::user()->id) }}"><button type="button" class="btn btn-primary">Cancel</button></a>
                                        </div>
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

        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = false;
            }
            else {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = true;

            }
        }
    </script>
@endsection
