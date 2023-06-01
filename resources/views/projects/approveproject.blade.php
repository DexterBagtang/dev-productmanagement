@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Approve Project Design</h1>
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
                              action="{{ action('ProjectController@approved_project',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="">
                            @csrf
                            <div class="row g-2">
                            @if($salesrequest->reason_for_revision != null)
                                <div class="approvebox">
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
                            <div class="col">
                                <label class="form-label"
                                       for="project_manager">Project Manager:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_manager"
                                           value="{{ $salesrequest->username }}" disabled/>
                                </div>
                            </div>

                            <div class="col">
                                <label class="form-label"
                                       for="sales_request_code">Sales Request Code:</label>
                                <div class="">
                                    <input type="text" class="form-control"
                                           name="sales_request_code"
                                           value="{{ $salesrequest->sales_request_code }}"
                                           disabled/>
                                </div>
                            </div>


                            <div class="col-12">
                                <label class="form-label"
                                       for="project_title">Project Title:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_title"
                                           value="{{ $salesrequest->project_title }}" disabled/>
                                </div>
                            </div>

                            <div class="col">
                                <label class="form-label"
                                       for="project_code">Project Code:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_code"
                                           value="{{ $salesrequest->project_code }}" disabled/>
                                </div>
                            </div>


                            <div class="col">
                                <label class="form-label"
                                       for="project_status">Project Status:</label>
                                <div class="">
                                    <input type="text" class="form-control" name="project_status"
                                           value="{{ $salesrequest->status }}" disabled/>
                                </div>
                            </div>

                            <div class="col">
                                <label class="form-label"
                                       for="category">Category:</label>
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
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Single-Line Diagram:</label>
                                    <div class="card">
                                        <div class="card-body">
                                            @if(count($slds) < 1 || $slds[0]->sld_file == null)
                                                <div >
                                                    N/A
                                                </div>
                                            @else
                                                @foreach($slds as $sld)
                                                    <a href="/storage/uploads/{{ $sld->sld_file }}"
                                                       target="_blank"
                                                       class="form-control">📂{{$sld->sld_file}}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="" class="form-label">Bill of Quantities:</label>
                                    <div class="card">
                                        <div class="card-body">
                                            @foreach($boms as $bom)
                                                <a href="/storage/uploads/{{ $bom->bom_file }}"
                                                   target="_blank"
                                                   class="form-control">📂{{$bom->bom_file}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="" class="form-label">Layout:</label>
                                    <div class="card">
                                        <div class="card-body">
                                            @if(count($layouts) < 1 || $layouts[0]->layout_file == null)
                                                <div>
                                                    N/A
                                                </div>
                                            @else
                                                @foreach($layouts as $layout)
                                                    <a href="/storage/uploads/{{ $layout->layout_file }}"
                                                       target="_blank"
                                                       class="form-control">📂{{$layout->layout_file}}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="approvebox">
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
                                    <div class="col">
                                        <label class="form-label"
                                               for="remarks">Remarks: </label>
                                        <div class="col-6">
                                                                <textarea type="text" class="form-control"
                                                                          name="remarks" id="remarks" rows="3"
                                                                          required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="mall_id2"
                                       value="{{ $salesrequest->mall_id }}"/>
                                <input type="hidden" class="form-control" name="sales_request_id2"
                                       value="{{ $salesrequest->sales_request_id }}"/>
                                <input type="hidden" class="form-control" name="approver_id"
                                       id="approver_id" value="{{ Auth::user()->id }}"/>
                                <div class="col">
                                    <div class=" col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Submit
                                        </button>
                                        <a href="{{ action('ProjectController@index',Auth::user()->id) }}">
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

        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = true;
            } else {
                document.getElementById('show_remark').style.display = 'block';
                document.getElementById('remarks').required = true;

            }

        }
    </script>
@endsection
