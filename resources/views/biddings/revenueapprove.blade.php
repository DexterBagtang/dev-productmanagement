@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Approve Bidder</h1>
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
                              action="{{ action('BiddingController@revenue_approved_bidding',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @csrf

                            @if($salesrequest->reason_for_revision != null)
                                <div class="row g-2">
                                    <div class="col" style="padding: 10px;">
                                        <label class="form-label red"
                                               style="font-size: 18px" for="category">Reason For
                                            Revision:</label>
                                        <div class="">
                                                                <textarea type="text" class="form-control"
                                                                          name="reason_for_revision" rows="6"
                                                                          readonly>{{$salesrequest->reason_for_revision}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endif
                            <div class="row g-2"><br>
                                <div class="col-12">
                                    <label class="form-label"
                                           for="project_title">Project Title:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_title"
                                               value="{{ $salesrequest->project_title }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label"
                                           for="project_code">Project Code:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_code"
                                               value="{{ $salesrequest->project_code }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label"
                                           for="project_status">Project Status:</label>
                                    <div class="">
                                        <input type="text" class="form-control"
                                               name="project_status"
                                               value="{{ $salesrequest->status }}" disabled/>
                                    </div>
                                </div>

                                <div class="col">
                                    <label class="form-label"
                                           for="project_requirements_files">Project Requirements :</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}"
                                           target="_blank"
                                           class="badge bg-info">{{($salesrequest->project_requirements_files != null)? '📂':'' }} {{ $salesrequest->project_requirements_files }} </a>
                                    </div>
                                </div>

                                @if ($salesrequest->category == 'Special')
                                    <div class="col">
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

                            @if ($salesrequest->category !== 'Special')
                                <div class="row g-2"><br>
                                    <div class="col-12">
                                        <label class="form-label"
                                               for="category">Bidder:</label>
                                        <div class="">

                                            <DIV class="table-responsive">
                                                <table id="projectdesign" class="table table-bordered"
                                                       width="100%">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Trade</th>
                                                        <th>Contractor Name</th>
                                                        <th>Total Cost</th>
                                                        <th>Select</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($biddingdetails as $biddingdetail)
                                                        <tr>
                                                            <td>{{$biddingdetail->bid_trade}}</td>
                                                            <td>{{$biddingdetail->contractor_name}}</td>
                                                            <?php //$total_cost =  str_replace(",","",$biddingdetail->total_cost); ?>
                                                            <td>{{$biddingdetail->total_cost}}</td>
                                                            <td><input type="checkbox" name="bidder[]"
                                                                       class="check"
                                                                       value="{{$biddingdetail->id}}" {{ ($biddingdetail->bid_status== '1')? "checked" : "" }}>
                                                            </td>
                                                    @endforeach
                                                </table>
                                            </DIV>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label"
                                               for="bid_file">Bid File(PM):</label>
                                        <div class="col-10">
                                            <a href="/storage/uploads/{{ $salesrequest->bid_file }}"
                                               target="_blank"
                                               class="form-control">{{($salesrequest->bid_file != null)? '📂':'' }}{{$salesrequest->bid_file}}</a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label"
                                               for="bid_file">Bid File(Revenue):</label>
                                        <div class="col-10">
                                            <a href="/storage/uploads/{{ $salesrequest->bid_file_revenue }}"
                                               target="_blank"
                                               class="form-control">{{($salesrequest->bid_file_revenue != null)? '📂':'' }}{{$salesrequest->bid_file_revenue}}</a>
                                        </div>
                                    </div>

                                    @if ($salesrequest->pm_remarks_yes != '')
                                        <div class="col-12">
                                            <label class="form-label"
                                                   for="pm_remarks_yes">PM Remarks:</label>
                                            <div class="form-control" readonly="readonly">
                                                {{$salesrequest->pm_remarks_yes}}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <br>
                            <div class="row g-2">
                                <div class="col">
                                    <label class="form-label"
                                           for="remarks">Approved:</label>
                                    <div class="">
                                        <input type="radio" name="approved_status" value="Yes"
                                               onclick="yesnoCheck();" id="yesCheck"> Yes ||
                                        <input type="radio" name="approved_status" value="No"
                                               onclick="yesnoCheck();" id="noCheck"> No
                                    </div>
                                </div>
                                <div id="show_remark">
                                    <div class="col-6">
                                        <label class="form-label"
                                               for="remarks">Remarks: </label>
                                        <div class="">
                                            <textarea type="text" class="form-control" name="remarks"
                                                      id="remarks"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label"
                                               for="revision">Return: </label>
                                        <div class="">
                                            <select name='revision' class="form-select">
                                                <option disabled selected=selected> -- select an
                                                    option --
                                                </option>
                                                <option value="1">Minor Revision (Purchasing)</option>
                                                <option value="2">Major Revision (Purchasing &#8680; PM Supervisor)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="show_mark_up">
                                    <div class="col-6 mt-3">
                                        <label class="form-label" for="mark_up">Philcom Proposal: </label>
                                        <div class="">
                                            @if($salesrequest->mark_up_file != null)
                                                <a href="/storage/uploads/{{ $salesrequest->mark_up_file }}" download
                                                   class="badge bg-info">📂{{$salesrequest->mark_up_file}}
                                                </a>
                                            @endif

                                            <input type="file" class="form-control" name="mark_up_file">
                                            <input type="hidden" name="existing_mark_up_file"
                                                   value="{{$salesrequest->mark_up_file}}">
                                        </div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label" for="pnl">P&L File: </label>
                                        <div class="">
                                            @if($salesrequest->pnl_file != null)
                                                <a href="/storage/uploads/{{ $salesrequest->pnl_file }}" target="_blank"
                                                   class="badge bg-info">📂{{$salesrequest->pnl_file}}</a>
                                            @endif
                                            <input type="file" class="form-control" name="pnl_file">
                                            <input type="hidden" name="existing_pnl_file"
                                                   value="{{$salesrequest->pnl_file}}">
                                        </div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label"
                                               for="mark_up">Project Size: </label>
                                        <div class="">
                                            <select name='project_size' class="form-select">
                                                <option disabled selected=selected> -- select an
                                                    option --
                                                </option>
                                                <option value="Small" {{ ($salesrequest->project_size=="Small")? "selected" : "" }}>
                                                    Small
                                                </option>
                                                <option value="Big" {{ ($salesrequest->project_size=="Big")? "selected" : "" }}>
                                                    Big
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="mall_id2"
                                       value="{{ $salesrequest->mall_id }}"/>
                                <input type="hidden" class="form-control" name="sales_request_id2"
                                       value="{{ $salesrequest->sales_request_id }}"/>
                                <input type="hidden" class="form-control" name="approver_id"
                                       id="approver_id" value="{{ Auth::user()->id }}"/>
                            </div>
                            <div class="mt-3">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Submit
                                    </button>
                                    <a href="{{ action('BiddingController@index',Auth::user()->id) }}">
                                        <button type="button" class="btn btn-danger">Cancel
                                        </button>
                                    </a>
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
        document.getElementById('show_mark_up').style.display = 'none';

        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('show_remark').style.display = 'none';
                document.getElementById('remarks').required = false;
                document.getElementById('show_mark_up').style.display = 'block';
            } else {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = true;
                document.getElementById('show_mark_up').style.display = 'none';

            }

        }

    </script>
@endsection
