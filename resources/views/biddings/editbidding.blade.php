@extends('layout.app')
@section('link')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Upload Bidders</h1>
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
                              action="{{ route('biddings.update', $salesrequest->sales_request_id) }}"
                              enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @method('PATCH')
                            @csrf
                            <div class="row g-2">
                                @if($salesrequest->reason_for_revision != null)
                                    <div class="col-12">
                                        <div class="col">
                                            <label class="form-label"
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

                                <div class="col-6">
                                    <label class="form-label"
                                           for="project_manager">Project Manager:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_manager"
                                               value="{{ $salesrequest->username }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-6">
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

                                <div class="col-4">
                                    <label class="form-label"
                                           for="project_code">Project Code:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_code"
                                               value="{{ $salesrequest->project_code }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="form-label"
                                           for="project_status">Project Status:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="project_status"
                                               value="{{ $salesrequest->status }}" disabled/>
                                    </div>
                                </div>

                                <div class="col-4">
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

                                <div class="col-4">
                                    <label class="form-label"
                                           for="category">Single-Line Diagram:</label>
                                    <div class="">

                                        <DIV class="table-responsive">
                                            <table id="projectdesign" class="table table-bordered"
                                                   width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Single Line Digram</th>
                                                </tr>
                                                </thead>
                                                @foreach($slds as $sld)
                                                    <tr>
                                                        @if($sld->sld_file != null)
                                                        <td>
                                                            <a href="/storage/uploads/{{ $sld->sld_file }}"
                                                               target="_blank"
                                                               class="clickable">📂{{$sld->sld_file}}</a>
                                                        </td>
                                                    @else
                                                        <td>NA</td>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </DIV>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="form-label"
                                           for="category">Project Design:</label>
                                    <div class="">

                                        <DIV class="table-responsive">
                                            <table id="projectdesign" class="table table-bordered"
                                                   width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Bill of Materials</th>
                                                </tr>
                                                </thead>
                                                @foreach($boms as $bom)
                                                    <tr>
                                                        <td>
                                                            <a href="/storage/uploads/{{ $bom->bom_file }}"
                                                               target="_blank"
                                                               class="clickable">📂{{$bom->bom_file}}</a>
                                                        </td>
                                                @endforeach
                                            </table>
                                        </DIV>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="form-label"
                                           for="category">Layout:</label>
                                    <div class="">

                                        <DIV class="table-responsive">
                                            <table id="projectdesign" class="table table-bordered"
                                                   width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Layout File</th>
                                                </tr>
                                                </thead>

                                                @foreach($layouts as $layout)
                                                    <tr>
                                                        @if($layout->layout_file != null)
                                                        <td>
                                                            <a href="/storage/uploads/{{ $layout->layout_file }}"
                                                               target="_blank"
                                                               class="clickable">📂{{$layout->layout_file}}</a>
                                                        </td>
                                                        @else
                                                            <td>NA</td>
                                                        @endif
                                                    </tr>
                                                @endforeach

                                            </table>
                                        </DIV>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="mt-3">
                                <h4>Bidders</h4>

                                <div class="col">
                                    <label class="form-label"><input
                                                type="button"
                                                class="btn btn-round btn-primary btn-xs"
                                                name="add_item" id="add_item" value="Add More"
                                                onClick="addMorebid();"/></label>

                                    <div class=" mb-3">
                                        <div class="table-responsive">
                                            <table id="bidders" class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Trade</th>
                                                    <th>Contractor Name</th>
                                                    <th>Total Cost</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <?php $b = 0; ?>
                                                @foreach($biddings as $bidding)
                                                    <?php $b = $b + 1; ?>
                                                    <tr id="rowb<?php echo $b; ?>">
                                                        <td>
                                                            <input type="text" class="form-control" name="bid_trade[]" value="{{ $bidding->bid_trade }}"/>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="contractor_name[]" value="{{ $bidding->contractor_name }}"/>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="currency{{$b}}" class="form-control" name="total_cost[]" value="{{ $bidding->total_cost }}"/>
                                                        </td>

                                                        <td>
                                                            <button type="button" name="remove"
                                                                    id="{{ $b}}"
                                                                    class="btn btn-sm m-0 btn-danger btn_remove_bid">
                                                                Remove
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <?php if ($b == 0){ ?>
                                                <tr id="rowb1">
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               name="bid_trade[]"/></td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               name="contractor_name[]"/></td>
                                                    <td>
{{--                                                        <input type="text" id="currency{{$b}}"--}}
{{--                                                               class="form-control"--}}
{{--                                                               name="total_cost[]">--}}
                                                        <input type="text" class="form-control" name="total_cost[]"
                                                               id="currency-field" data-type="currency">
                                                    </td>

                                                    <td>
                                                        <button type="button" name="remove" id="1"
                                                                class="btn btn-sm m-0 btn-danger btn_remove_bid">
                                                            Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </table>
                                            <small class="text-danger">* Total Cost column will be hidden to the PM Supervisor.</small>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bolder h6" for="sales_request_code">Bid File <span class="text-danger">(PM Supervisor)</span>:</label>
                                            <div class="">
                                                @if($salesrequest->bid_file != null)
                                                    <a href="/storage/uploads/{{ $salesrequest->bid_file }}" target="_blank"
                                                       class="badge bg-info">📂{{$salesrequest->bid_file}}</a>
                                                @endif
                                                <input type="file" class="form-control" name="bid_file" {{($salesrequest->bid_file == null)? 'required' : ''}}>
                                                <input type="hidden" name="existing_bid_file" value="{{$salesrequest->bid_file}}">
                                            </div>
                                        </div>

                                        <div class=" col mb-3">
                                            <label class="form-label h6 fw-bolder" for="sales_request_code">Bid File <span class="text-danger">(Revenue)</span>:</label>
                                            <div class="">
                                                @if($salesrequest->bid_file_revenue != null)
                                                    <a href="/storage/uploads/{{ $salesrequest->bid_file_revenue }}" target="_blank"
                                                       class="badge bg-info">📂{{$salesrequest->bid_file_revenue}}</a>
                                                @endif
                                                <input type="file" class="form-control" name="bid_file_revenue" {{($salesrequest->bid_file_revenue == null)? 'required' : ''}}>
                                                <input type="hidden" name="existing_bid_file_revenue" value="{{$salesrequest->bid_file_revenue}}">
                                                <small class="text-danger">* The PM Supervisor Role will not view this file, but it will be visible to Revenue Roles.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ action('BiddingController@index',Auth::user()->id) }}">
                                                <button type="button" class="btn btn-danger">
                                                    Cancel
                                                </button>
                                            </a>
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
    <script>
        // Jquery Dependency

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") { return; }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "" + left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "" + input_val;

                // final formatting
                if (blur === "blur") {
                    input_val += ".00";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

    </script>

    <script>
        var i = 30;

        function addMorebid() {
            i++;
            $('#bidders').append('<tr id="rowb' + i + '">' +
                '<td><input type="text" class="form-control" name="bid_trade[]"/>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" name="contractor_name[]"/>' +
                '</td><td>' +
                '<input type="text" class="form-control" name="total_cost[]" id="currency-field" data-type="currency">' +
                '</td><td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-sm m-0 btn-danger btn_remove_bid" ">Remove</button>' +
                '</td></tr> ');

            // Format the new total cost input field as a currency
            $("input[data-type='currency']").on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });
        }

        $(document).ready(function () {
            $(document).on('click', '.btn_remove_bid', function () {
                var button_id = $(this).attr("id");
                $('#rowb' + button_id + '').remove();
            });
        });
    </script>

@endsection
