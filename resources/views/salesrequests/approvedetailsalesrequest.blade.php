@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="col mb-lg-0">
                <h1 class="h4">Review Sales Request</h1>
                <p class="mb-0"></p>
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
                        <form method="get"
                              action="{{ action('SalesrequestController@approved_sr',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="">
                            @method('PATCH')
                            @csrf
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class=" col-form-label" for="mall_name">Mall
                                        Name:</label>
                                    <div class="">
                                        <select name='mall_id' class="form-control" disabled>
                                            <option value={{ $salesrequest->mall_id }} selected
                                            = selected> {{ $salesrequest->mall_name }} </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="col-form-label" for="qoutation_addressee">Quotation
                                        Addressee:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="qoutation_addressee"
                                               value="{{ $salesrequest->qoutation_addressee }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="col-form-label"
                                           for="requester">Requester:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="requester"
                                               value="{{ $salesrequest->requester }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="col-form-label" for="project_title">Project
                                        Title:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_title"
                                               value="{{ $salesrequest->project_title }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="col-form-label" for="date_needed">Proposal
                                        Target Date:</label>
                                    <div class="">
                                        <input type="date" class="form-control" name="date_needed"
                                               value="{{ $salesrequest->date_needed }}" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="col-form-label" for="on_site_survey">For Site
                                        Survey:</label>
                                    <div class="">
                                        <input type="text" class="form-control" disabled
                                               value="{{$salesrequest->on_site_survey}}">
                                    </div>
                                </div>

                                @if($salesrequest->comment != null)
                                <div class="col-12">
                                    <label class="col-form-label" for="comment">Comment:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="comment"
                                               value="{{ $salesrequest->comment }}" disabled/>
                                    </div>
                                </div>
                                @endif


                                <div class="col-6">
                                    <label class="col-form-label"
                                           for="project_requirements_files">Project Requirement Files :</label>
                                    <div class="">
                                        <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}"
                                           target="_blank"
                                           class="form-control form-control-info">📂 {{ $salesrequest->project_requirements_files }} </a>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="col-form-label"
                                           for="category">Category:</label>
                                    <div class="">
                                        <input type="text" value="{{$salesrequest->category}}" disabled
                                               class="form-control">
                                    </div>
                                </div>

                                @if($salesrequest->reason_for_revision != null)
                                    <div class="col-12">
                                        <label class="col-form-label red" style="font-size: 18px"
                                               for="category">Reason For Revision</label>
                                        <div class="">
                                        <textarea type="text" class="form-control" name="reason_for_revision" rows="6"
                                                  readonly>{{$salesrequest->reason_for_revision}}</textarea>
                                        </div>
                                    </div>
                                @endif
                                <br>
                                <div class="approvebox mt-2">
                                    <div class="col">
                                        <label class="col-form-label"
                                               for="remarks">Approve:</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="approved_status" value="Yes"
                                                   onclick="yesnoCheck();"
                                                   id="yesCheck">
                                            <label class="form-check-label" for="yesCheck">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="approved_status" value="No"
                                                   onclick="yesnoCheck();"
                                                   id="noCheck">
                                            <label class="form-check-label" for="noCheck">No</label>
                                        </div>
                                    </div>
                                    <div id="show_remark">
                                        <div class="col-12">
                                            <label class="col-form-label"
                                                   for="remarks">Remarks: </label>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="remarks" id="remarks"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="show_pm">
                                        <div class="col-12">
                                            <label class="col-form-label" for="remarks">
                                                Assign to: </label>
                                            <div class="col-6">
                                                <select name='pm_assigned_id' class="form-select">
                                                    <option disabled selected=selected> -- select an option --</option>
                                                    @foreach(($users)->sortBy('username') as $user)
                                                        <option value="{{$user->id}}">{{$user->username}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" name="mall_id2"
                                           value="{{ $salesrequest->mall_id }}"/>
                                    <input type="hidden" class="form-control" name="sales_request_id2"
                                           value="{{ $salesrequest->sales_request_id }}"/>
                                    <input type="hidden" class="form-control" name="approver_id" id="approver_id"
                                           value="{{ Auth::user()->id }}"/>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ action('SalesrequestController@approved_header') }}">
                                            <button type="button" class="btn btn-danger">Cancel</button>
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
    <script>
        document.getElementById('show_remark').style.display = 'none';
        document.getElementById('show_pm').style.display = 'none';

        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('show_pm').style.display = 'block';
                document.getElementById('remarks').required = true;
            } else {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('show_pm').style.display = 'none';
                document.getElementById('remarks').required = true;
            }
        }
    </script>
@endsection
