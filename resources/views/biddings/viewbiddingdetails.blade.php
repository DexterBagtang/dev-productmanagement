@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Project Details</h1>
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
                        <form method="get"
                              action="{{ action('ProjectController@approved_project',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="row">
                            @method('PATCH')
                            @csrf
                            <div class="col-6 mb-3">
                                <label class="form-label" for="project_manager">Project Manager:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_manager"
                                           value="{{ $salesrequest->username }}" disabled/>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-label" for="sales_request_code">Sales Request Code:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="sales_request_code"
                                           value="{{ $salesrequest->sales_request_code }}" disabled/>
                                </div>
                            </div>


                            <div class="col-12">
                                <label class="form-label" for="project_title">Project Title:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_title"
                                           value="{{ $salesrequest->project_title }}" disabled/>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-label" for="project_code">Project Code:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_code"
                                           value="{{ $salesrequest->project_code }}" disabled/>
                                </div>
                            </div>


                            <div class="col-6 mb-3">
                                <label class="form-label" for="project_status">Project Status:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_status"
                                           value="{{ $salesrequest->status }}" disabled/>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label" for="category">Category:</label>
                                <div class="">
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

                            <div class="col-4">
                                <label class="form-label" for="category">Single-Line Diagram:</label>
                                <div class="">
                                    @foreach($slds as $sld)
                                        @if($sld->sld_file != null)
                                            <a href="/storage/uploads/{{ $sld->sld_file }}" target="_blank"
                                               class="form-control">
                                                📂{{$sld->sld_file}}
                                            </a>
                                        @else
                                            <div class="form-control">NA</div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label" for="category">Project Design:</label>
                                <div class="">
                                    @foreach($boms as $bom)
                                        @if($bom->bom_file != null)
                                            <a href="/storage/uploads/{{ $bom->bom_file }}" target="_blank"
                                               class="form-control">
                                                📂{{$bom->bom_file}}
                                            </a>
                                        @else
                                            <div class="form-control">NA</div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                                <div class="col-4">
                                    <label class="form-label" for="category">Layout:</label>
                                    <div class="">
                                        @foreach($layouts as $layout)
                                            @if($layout->layout_file != null)
                                                <a href="/storage/uploads/{{ $layout->layout_file }}" target="_blank"
                                                   class="form-control">
                                                    📂{{$layout->layout_file}}
                                                </a>
                                            @else
                                                <div class="form-control">NA</div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                    <div class="col-12">
                                        <div class=" col-md-offset-3">
                                            <a href="{{ action('BiddingController@index',Auth::user()->id) }}">
                                                <button type="button" class="btn btn-primary">Back</button>
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

@endsection
