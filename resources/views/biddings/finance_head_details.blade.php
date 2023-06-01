@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">PhilCom Proposal for Checking</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-1 mb-4">
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
                        <form method="get" action="{{ action('BiddingController@finance_head_approved_markup',$salesrequest->sales_request_id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @method('PATCH')
                            @csrf
                            @if($salesrequest->reason_for_revision != null)
                                <div class="row g-2">
                                    <div class="col-12 mb-1" style="padding: 10px;">
                                        <label class="form-label red" style="font-size: 18px" for="category">Reason For Revision:</label>
                                        <div class="">
                                            <textarea type="text" class="form-control" name="reason_for_revision" rows="6" readonly >{{$salesrequest->reason_for_revision}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endif
                            <div class="row g-2"><br>
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="project_title">Project Title:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12 mb-1">
                                    <label class="form-label" for="project_code">Project Code:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_code" value="{{ $salesrequest->project_code }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12 mb-1">
                                    <label class="form-label" for="project_status">Project Status:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_status" value="{{ $salesrequest->status }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12 mb-1">
                                    <label class="form-label" for="project_requirements_files">Project Requirements:</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}" target="_blank" class="btn btn-outline-info">
                                            {{( $salesrequest->project_requirements_files!= null)? '📂':'' }}{{ $salesrequest->project_requirements_files }}
                                        </a>
                                    </div>
                                </div>

                                <?php if ($salesrequest->category == 'Special')
                                { ?>
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="project_category">Project Category:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_category" value="{{ $salesrequest->category }}" disabled/>
                                    </div>
                                </div>
                                <?php } ?>
                            </div><br>

                            <?php if ($salesrequest->category !== 'Special')
                            { ?>
                            <div class="row g-2"><br>
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="category">Bidder:</label>
                                    <div class="mb-2">

                                        <DIV class="table-responsive">
                                            <table id="projectdesign" class="table table-bordered rounded" width="100%">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Trade</th>
                                                    <th>Contractor Name</th>
                                                    <th>Total Cost</th>
                                                </tr>
                                                </thead>
                                                @foreach($biddingdetails as $biddingdetail)
                                                    <tr>
                                                        <td>{{$biddingdetail->bid_trade}}</td>
                                                        <td>{{$biddingdetail->contractor_name}}</td>
                                                        <td>{{$biddingdetail->total_cost}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </DIV>
                                    </div>
                                </div>
                                <div class="col-6 mb-1">
                                    <label class="form-label" for="sales_request_code">Bid File (PM):</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->bid_file }}" target="_blank" class="btn btn-outline-info">
                                            {{($salesrequest->bid_file != null)? '📂':'' }}{{$salesrequest->bid_file}}</a>
                                    </div>
                                </div>

                                <div class="col-6 mb-1">
                                    <label class="form-label" for="sales_request_code">Bid File (Revenue):</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->bid_file_revenue }}" target="_blank" class="btn btn-outline-info">
                                            {{($salesrequest->bid_file_revenue != null)? '📂':'' }}{{$salesrequest->bid_file_revenue}}</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <br><div class="row g-2"><br>
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="category">Philcom Cost :</label>
                                    <div class="">
                                                @foreach($mark_ups as $mark_up)
                                                    <a href="/storage/uploads/{{ $mark_up->mark_up_file }}" target="_blank" class="btn btn-outline-info">
                                                        <b>{{($mark_up->mark_up_file != null)? '📂':'' }}{{$mark_up->mark_up_file}}</b></a>
                                                @endforeach
                                    </div>
                                </div>
                                <?php if ($salesrequest->pm_remarks_yes != ""){ ?>
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="category">PM Technical Remarks :</label>
                                    <div class="form-control">
                                        {{ $salesrequest->pm_remarks_yes }}
                                    </div>
                                </div>
                                <?php } if ($salesrequest->pnl_file != ""){ ?>
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="category"> P&L File :</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->pnl_file }}" target="_blank" class="btn btn-outline-info">
                                            <b>{{($salesrequest->pnl_file != null)? '📂':'' }}{{$salesrequest->pnl_file}}</b></a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <br>
                            <div class="row g-2">
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="remarks">Approved:</label>
                                    <div class="">
                                        <input type="radio"  name="approved_status" value ="Yes" onclick="yesnoCheck();" id="yesCheck"> Yes   ||
                                        <input type="radio"  name="approved_status" value ="No" onclick="yesnoCheck();" id="noCheck"> No
                                    </div>
                                </div>
                                <div id ="show_remark">
                                    <div class="col-12 mb-1">
                                        <label class="form-label" for="remarks">Remarks: </label>
                                        <div class="">
                                            <input type="text" class="form-control" name="remarks" id="remarks" />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label class="form-label" for="project_return">Return: </label>
                                        <div class="">
                                            <select name='project_return' class="form-control">
                                                <option disabled selected = selected> -- select an option -- </option>
                                                <option value="Purchasing" >Purchasing</option>
                                                <option value="Revenue" >Revenue</option>
                                                <option value="Revenue_Head" >Revenue Head</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="mall_id2"  value ="{{ $salesrequest->mall_id }}"  />
                                <input type="hidden" class="form-control" name="sales_request_id2" value ="{{ $salesrequest->sales_request_id }}"  />
                                <input type="hidden" class="form-control" name="approver_id" id="approver_id" value ="{{ Auth::user()->id }}"  />
                                <div class="col-12 mb-1">
                                    <div class=" col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ action('BiddingController@finance_head_header') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
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
                document.getElementById('show_remark').style.display = 'none';
                document.getElementById('remarks').required = false;
            }
            else {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = true;
            }

        }

    </script>
@endsection
