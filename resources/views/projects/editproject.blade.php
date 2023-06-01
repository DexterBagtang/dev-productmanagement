@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Upload Design</h1>
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
                        <form method="post" action="{{ route('projects.update', $salesrequest->project_id,$salesrequest->sales_request_id) }}"
                              enctype="multipart/form-data">
                            @method('PATCH')
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
                                <div class="approvebox row g-2">
                                    <div class="col-6">
                                        <label class="form-label"
                                               for="project_manager">Project Manager:</label>
                                        <div class="">
                                            <input type="text" class="form-control"
                                                   name="project_manager"
                                                   value="{{ $salesrequest->username }}" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label"
                                               for="sales_request_code">Sales Request Code:</label>
                                        <div class="">
                                            <input type="text" class="form-control"
                                                   name="sales_request_code"
                                                   value="{{ $salesrequest->sales_request_code }}"
                                                   readonly/>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label"
                                               for="project_title">Project Title:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="project_title"
                                                   value="{{ $salesrequest->project_title }}" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label"
                                               for="project_code">Project Code:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="project_code"
                                                   value="{{ $salesrequest->project_code }}" readonly/>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <label class="form-label"
                                               for="category">Category:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="category"
                                                   value="{{ $salesrequest->category }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-4">
                                    Single-Line Diagram
                                    <div class="">
                                        <label class="form-label">
                                            <input type="button" class="btn btn-round btn-primary btn-xs"
                                                    name="add_item" id="add_item" value="Add More"
                                                    onClick="addMoresld();"/>
                                        </label>

                                        <div class="">
                                            <div class="table-responsive">
                                                <table id="singlelinediagram" class="table table-borderless">
                                                    <?php $a = 0; ?>
                                                    @foreach($slds as $sld)
                                                        <?php $a = $a + 1; ?>
                                                        <tr id="rowa<?php echo $a; ?>">
                                                            <td>
                                                                @if($sld->sld_file != null)
                                                                <a href="/storage/uploads/{{ $sld->sld_file }}" target="_blank" class="badge bg-info">
                                                                    {{$sld->sld_file}}
                                                                </a>
                                                                @endif
                                                                <input type="hidden" name="sld_number[]" value="1">
                                                                <input type="file" class="form-control" name="sld[]">
                                                                <input type="hidden" id="existing_sld_id" name="existing_sld[]" value="{{$sld->sld_file}}">
                                                            </td>

                                                            <td style="text-align: center; vertical-align: middle">
                                                                <button type="button" name="remove" id="1" class="btn btn-rounded btn-xs btn-danger btn_remove_sld">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @if ($a == 0)
                                                    <tr id="rowa1">
                                                        <td>
                                                            <input type="hidden" name="sld_number[]" value="1">
                                                            <input type="file" class="form-control" name="sld[]">
                                                        </td>

                                                        <td>
                                                            <button type="button" name="remove" id="1"
                                                                    class="btn btn-rounded btn-xs btn-danger btn_remove_sld">
                                                                Remove
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </table>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sld_na" value="{{$a}}" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Not Available
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    Bill of Quantities
                                    <div class="">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">
                                            <input type="button" class="btn btn-round btn-primary btn-xs"
                                                    name="add_item" id="add_item" value="Add More"
                                                    onClick="addMorebom();"/>
                                        </label>

                                        <div>
                                            <div class="table-responsive">
                                                <table id="projectdesign" class="table table-borderless"
                                                       width="100%">

                                                    <?php $b = 0; ?>
                                                    @foreach($boms as $bom)
                                                        <?php $b = $b + 1; ?>
                                                        <tr id="rowb<?php echo $b; ?>">
                                                            <td>
                                                                <div>
                                                                    @if($bom->bom_file != null)
                                                                    <a href="/storage/uploads/{{ $bom->bom_file }}"
                                                                       target="_blank"
                                                                       class="badge bg-info">{{$bom->bom_file}}
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                                <input type="hidden" name="bom_number[]" value="1">
                                                                <input type="file" class="form-control" name="bom[]">
                                                                <input type="hidden" id="existing_bom_id" name="existing_bom[]" value="{{$bom->bom_file}}">
                                                            </td>

                                                            <td>
                                                                <button type="button" name="remove" id="1" class="btn btn-rounded btn-xs btn-danger btn_remove_bom">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @if ($b == 0)
                                                    <tr id="rowb1">
                                                        <td>
                                                            <input type="hidden" name="bom_number[]" value="1">
                                                            <input type="file" class="form-control" name="bom[]">
                                                        </td>
                                                        <td>
                                                            <button type="button" name="remove" id="1" class="btn btn-rounded btn-xs btn-danger btn_remove_bom">
                                                                Remove
                                                            </button>
                                                        </td>
                                                    </tr>
                                                        @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    Layout
                                    <div class="">
                                        <label class="">
                                            <input
                                                    type="button"
                                                    class="btn btn-round btn-primary btn-xs"
                                                    name="add_item" id="add_item" value="Add More"
                                                    onClick="addMorelayout();"/></label>

                                        <div class="">
                                            <div class="table-responsive">
                                                <table id="layout" class="table table-borderless">
                                                    <?php $c = 0; ?>
                                                    @foreach($layouts as $layout)
                                                        <?php $c = $c + 1; ?>
                                                        <tr id="rowc<?php echo $c; ?>">
                                                            <td>
                                                                @if($layout->layout_file != null)
                                                                <a href="/storage/uploads/{{ $layout->layout_file }}"
                                                                   target="_blank"
                                                                   class="badge bg-info">{{$layout->layout_file}}</a>
                                                                @endif
                                                                    <input
                                                                        type="hidden"
                                                                        name="layout_number[]"
                                                                        value="1"><input type="file"
                                                                                         class="form-control"
                                                                                         name="layout[]"><input
                                                                        type="hidden"
                                                                        id="existing_layout_id"
                                                                        name="existing_layout[]"
                                                                        value="{{$layout->layout_file}}">
                                                            </td>
                                                            <td>
                                                                <button type="button" name="remove"
                                                                        id="1"
                                                                        class="btn btn-rounded btn-xs btn-danger btn_remove_layout">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <?php if ($c == 0){ ?>
                                                    <tr id="rowc1">
                                                        <td><input type="hidden" name="layout_number[]"
                                                                   value="1"><input type="file"
                                                                                    class="form-control"
                                                                                    name="layout[]">
                                                        </td>
                                                        <td>
                                                            <button type="button" name="remove" id="1"
                                                                    class="btn btn-rounded btn-xs btn-danger btn_remove_layout">
                                                                Remove
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                </table>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="layout_na" value="{{$a}}" id="flexCheckDefault2">
                                                <label class="form-check-label" for="flexCheckDefault2">
                                                    Not Available
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="col-12">
                                <div class=" col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ action('ProjectController@index',Auth::user()->id) }}">
                                        <button type="button" class="btn btn-primary">Cancel
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
        var i = 20;

        function addMoresld() {
            i++;
            $('#singlelinediagram').append('<tr id="rowa' + i + '">' +
                '<td>' +
                '<input type="hidden" name="sld_number[]" value="1"' +
                '><input type="file" class="form-control" name="sld[]">' +
                '</td><td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-rounded btn-xs btn-danger btn_remove_sld" ">Remove</button></td></tr> ');
        }

        function getsldData() {
            var sld = document.getElementById('existing_sld_id').value;
            $('#singlelinediagram').append('<input type="hidden" name="existing_sld_name[]" value="' + sld + '">');
        }

        $(document).ready(function () {
            $(document).on('click', '.btn_remove_sld', function () {
                var button_id = $(this).attr("id");
                if (button_id < 20) {
                    getsldData();
                }
                $('#rowa' + button_id + '').remove();

            });
        });

        function addMorebom() {
            i++;
            $('#projectdesign').append('<tr id="rowb' + i + '">' +
                '<td><input type="hidden" name="bom_number[]" value="1">' +
                '<input type="file" class="form-control" name="bom[]" >' +
                '</td><td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-rounded btn-xs btn-danger btn_remove_bom" ">Remove</button>' +
                '</td></tr> ');

        }

        function getbomData() {
            var bom = document.getElementById('existing_bom_id').value;
            $('#projectdesign').append('<input type="hidden" name="existing_bom_name[]" value="' + bom + '">');
        }

        $(document).ready(function () {
            $(document).on('click', '.btn_remove_bom', function () {
                var button_id = $(this).attr("id");
                if (button_id < 20) {
                    getbomData();
                }
                $('#rowb' + button_id + '').remove();
            });
        });

        function addMorelayout() {
            i++;
            $('#layout').append('<tr id="rowc' + i + '"><td>' +
                '<input type="hidden" name="layout_number[]" value="1">' +
                '<input type="file" class="form-control" name="layout[]" >' +
                '</td><td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-rounded btn-xs btn-danger btn_remove_layout" ">Remove</button></td></tr> ');

        }

        function getlayoutData() {
            var layout = document.getElementById('existing_layout_id').value;
            $('#layout').append('<input type="hidden" name="existing_layout_name[]" value="' + layout + '">');
        }

        $(document).ready(function () {
            $(document).on('click', '.btn_remove_layout', function () {
                var button_id = $(this).attr("id");
                if (button_id < 20) {
                    getlayoutData();
                }
                $('#rowc' + button_id + '').remove();
            });
        });
    </script>
@endsection
