@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Cancel Request</h1>
{{--                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
                <div class="card-body">
                    @foreach($salesrequests as $salesrequest)
                        <form method="post"
                              action="{{ action('SalesrequestController@cancel_request_details',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="form-horizontal form-label-left">

                            @csrf
                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="mall_name">Mall
                                    Name:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name='mall_id' class="form-control" disabled>
                                        <option value="{{ $salesrequest->mall_id }}"
                                                selected=selected> {{ $salesrequest->mall_name }} </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="qoutation_addressee">Quotation
                                    Addressee:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="qoutation_addressee"
                                           value="{{ $salesrequest->qoutation_addressee }}" disabled/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12"
                                       for="requester">Requester:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="requester"
                                           value="{{ $salesrequest->requester }}" disabled/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="project_title">Project
                                    Title:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="project_title"
                                           value="{{ $salesrequest->project_title }}" disabled/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="date_needed">Proposal
                                    Target Date:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" class="form-control" name="date_needed"
                                           value="{{ $salesrequest->date_needed }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="on_site_survey">For Site
                                    Survey:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if ($salesrequest->on_site_survey == 'Yes')
                                        <input type="radio" name="on_site_survey" value="Yes" checked disabled> Yes ||
                                        <input type="radio" name="on_site_survey" value="No" disabled> No
                                    @else
                                        <input type="radio" name="on_site_survey" value="Yes" disabled> Yes ||
                                        <input type="radio" name="on_site_survey" value="No" checked disabled> No
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="comment"
                                           value="{{ $salesrequest->comment }}" disabled/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12"
                                       for="project_requirements_files">Project Requirement Files:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}"
                                       target="_blank">
                                        <span>📂</span>
                                        {{ $salesrequest->project_requirements_files }}
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12"
                                       for="category">Category:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name='category' class="form-control" disabled>
                                        <option value="Small" {{ ($salesrequest->category=="Small")? "selected" : "" }}>
                                            Small
                                        </option>
                                        <option value="Medium" {{ ($salesrequest->category=="Medium")? "selected" : "" }}>
                                            Medium
                                        </option>
                                        <option value="Large" {{ ($salesrequest->category=="Large")? "selected" : "" }}>
                                            Large
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="approvebox">
                                <br>
                                <div class="row mb-3">
                                    <label class="col-form-label col-md-3 col-sm-3 col-xs-12"
                                           for="project_requirements_files"> Proof of Cancellation:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="proof_of_cancellation">
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="mall_id2"
                                       value="{{ $salesrequest->mall_id }}"/>
                                <input type="hidden" class="form-control" name="sales_request_id2"
                                       value="{{ $salesrequest->sales_request_id }}"/>
                                <input type="hidden" class="form-control" name="approver_id" id="approver_id"
                                       value="{{ Auth::user()->id }}"/>
                                <div class="row mb-3 text-end">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ action('SalesrequestController@index') }}">
                                            <button type="button" class="btn btn-primary">Cancel</button>
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

@endsection
