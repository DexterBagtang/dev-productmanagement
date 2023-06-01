@extends('layout.app')
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Revise Project</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    <form method="post" action="{{ action('SalesrequestController@revised', $salesrequest->sales_request_id) }}" id="quickForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Mall Name:</label>
                            <div class="col-sm-9">
                                <select name='mall_id' id="mall_name" class="form-select" required>
                                    <option value="{{ $salesrequest->mall_id }}" selected> {{ $salesrequest->mall_name }} </option>
                                    @foreach($malls as $mall)
                                        <option value="{{$mall->mall_id}}">{{$mall->mall_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--    <div class="mb-3 row">--}}
                        {{--        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Email:</label>--}}
                        {{--        <div class="col-sm-9">--}}
                        {{--            <input type="text" class="form-control" id="staticEmail" value="email@example.com">--}}
                        {{--        </div>--}}
                        {{--    </div>--}}

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Quotation Addressee:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="qoutation_addressee" value="{{ $salesrequest->qoutation_addressee }}"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Requester:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="requester" value="{{ $salesrequest->project_title }}" required/>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Project Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="project_title" value = "{{ $salesrequest->date_needed }}" required/>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Proposal Target Date:</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date_needed" value="{{ $salesrequest->date_needed }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row align-items-center">
                            <label for="staticEmail" class="col-sm-3 form-label text-end">For Site Survey:</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="on_site_survey" id="inlineRadio1" value="Yes" {{ ($salesrequest->on_site_survey=="Yes")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="on_site_survey" id="inlineRadio2" value="No" {{ ($salesrequest->on_site_survey=="No")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Comment:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="comment" value="{{ $salesrequest->comment }}"/>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Project Requirement File:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="project_requirements_files">
                                <div class="mt-1">
                                    <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}"
                                       target="_blank" class="btn btn-outline-primary">
                                        <span>📂</span>{{ $salesrequest->project_requirements_files }}
                                    </a>
                                </div>
                                <input type="hidden" name="existing_project_requirements" value="{{$salesrequest->project_requirements_files}}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label text-end">Category:</label>
                            <div class="col-sm-9">
                                <select name='category' class="form-select" required>
                                    <option value="Small" {{ ($salesrequest->category=="Small")? "selected" : "" }}>Small</option>
                                    <option value="Medium" {{ ($salesrequest->category=="Medium")? "selected" : "" }}>Medium</option>
                                    <option value="Large" {{ ($salesrequest->category=="Large")? "selected" : "" }}>Large</option>
                                    <option value="Special" {{ ($salesrequest->category=="Special")? "selected" : "" }}>Special</option>
                                </select>
                            </div>
                        </div>
                        <hr>


                        <div style="font-size: 20px; color: indianred;">
                            <div class="row mb-2">
                                <label class="col-3 form-label col-form-label" for="reasonrevision">Reason For Revision:</label>
                                <div class="col-9">
                                    <textarea type="text" class="form-control" name="reason_for_revision" rows="6" placeholder="Reason for revision" required></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-3 form-label" for="return">Return Project To:</label>
                                <div class="col-9 mb-2-lg has-success">
                                    <select name='return' class="form-select" required>
                                        <option value="{{null}}" selected disabled >Select One</option>
                                        <option value="projectdesign">PM (Project Design)</option>
                                        <option value="bidding">Purchasing(Bidding)</option>
                                        <option value="markup">Revenue(Mark Up)</option>
                                        <option value="reviewrequest">PM Supervisor(Review Request)</option>
                                        <option value="reviewdesign">PM Supervisor(Review Design)</option>
                                        <option value="checkbidding">PM Supervisor(Review Check and Choose Bid Winner)</option>
                                        <option value="technicalcheck">PM Supervisor(Technical Check)</option>
                                        <option value="revenuehead">Revenue Head(Check)</option>
                                        <option value="financehead">Finance Head(Check)</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" class="form-control" name="revision"  value ="{{ $salesrequest->revision }}"  />
                        <input type="hidden" class="form-control" name="pm_approval_status"  value ="{{ $salesrequest->pm_approval_status }}"  />

                        <div class="mb-2 text-end">
                            {{--                            <div class="col-9 col-md-offset-3">--}}
                            <button type="submit" class="btn btn-success">Revise</button>
                            <button type="button" onclick="window.location.href='javascript:history.back()'" class="btn btn-primary">Cancel</button>
                            {{--                            </div>--}}
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
