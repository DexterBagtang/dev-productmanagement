@extends('layout.app')
@section('link')
  <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/>
  <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
@endsection
@section('content')
  <div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
      <div class="mb-3 mb-lg-0">
        <h1 class="h4">Upload Bid Summary</h1>
{{--        <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and more.</p>--}}
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
            <form method="post" action="{{ action('SalesrequestController@bid_summary_upload',$salesrequest->sales_request_id)}}"
                  enctype="multipart/form-data" class="form-horizontal form-label-left">
              @csrf
              <div class="row g-2"><br>
                <div class="col-12">
                  <label class="form-label" for="project_title">Project Title:</label>
                  <div class="col-6">
                    <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}" disabled/>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label" for="project_code">Project Code:</label>
                  <div class="col-6">
                    <input type="text" class="form-control" name="project_code" value="{{ $salesrequest->project_code }}" disabled/>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label" for="project_status">Project Status:</label>
                  <div class="col-6">
                    <input type="text" class="form-control" name="project_status" value="{{ $salesrequest->status }}" disabled/>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label" for="project_requirements_files">Project Requirements:</label>
                  <div class="col-6">
                    <a href="/storage/uploads/{{ $salesrequest->project_requirements_files }}" download class="badge bg-success"> {{ $salesrequest->project_requirements_files }} </a>
                  </div>
                </div>
                <?php if ($salesrequest->category == 'Special')
                { ?>
                <div class="col-12">
                  <label class="form-label" for="project_category">Project Category:</label>
                  <div class="col-6">
                    <input type="text" class="form-control" name="project_category" value="{{ $salesrequest->category }}" disabled/>
                  </div>
                </div>
                <?php } ?>
              </div><br>


              <br>
              <div class="row g-2"><br>

                <div class="col-12">
                  <label class="form-label" for="po_ntp_files">PO / NTP:</label>
                  <div class="col-6">

                    <DIV class="table-responsive">
                      <table id="projectdesign" class="table table-bordered" width="100%">
                        <thead>
                        <tr>
                          <td>File</td>
                        </tr>
                        </thead>
                        <tr>
                          <td><a href="/storage/uploads/{{ $salesrequest->po_ntp_files }}" download class="form-control">{{ $salesrequest->po_ntp_files }}</a></td>

                      </table>
                    </DIV>

                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label" for="po_ntp_files">Proposal:</label>
                  <div class="col-6">
                    <DIV class="table-responsive">
                      <table id="projectdesign" class="table table-bordered" width="100%">
                        <thead>
                        <tr>
                          <td>File</td>
                        </tr>
                        </thead>
                        <tr>
                          <td><a href="/storage/uploads/{{ $salesrequest->proposal_files }}" download class="form-control">📂{{ $salesrequest->proposal_files }}</a></td>

                      </table>
                    </DIV>
                  </div>
                </div>
              </div>

              <br><div class="row g-2">
                <div class="col-12">
                  <label class="form-label" for="remarks">Approved:</label>
                  <div class="col-6">
                    <input type="radio"  name="approved_status" value ="Yes" onclick="yesnoCheck();" id="yesCheck"> Yes   ||
                    <input type="radio"  name="approved_status" value ="No" onclick="yesnoCheck();" id="noCheck"> No
                  </div>
                </div>
                <div id ="show_remark">
                  <div class="col-12">
                    <label class="form-label" for="remarks">Remarks: </label>
                    <div class="col-6">
                      <input type="text" class="form-control" name="remarks" id="remarks" />
                    </div>
                  </div>
                </div>

                <div id ="show_files">
                  <div class="col-12">
                    <label class="form-label" for="bid_summary_files">Bid Summary:</label>
                    <div class="col-6">
                      <input type="file" class="form-control" name="bid_summary_files">
                      <input type="hidden" class="form-control" name="bid_summary_files_exist" value="{{ $salesrequest->bid_summary_files }}">

                      <a href="/storage/uploads/{{ $salesrequest->bid_summary_files }}" class="badge bg-success" target="_blank">{{ $salesrequest->bid_summary_files }}</a>

                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="col-6 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <a href="{{ action('SalesrequestController@bid_summary_header') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
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
    $(document).ready(function(){
      $('input:checkbox').click(function() {
        $('input:checkbox').not(this).prop('checked', false);
      });
    });
  </script>
  <script type="text/javascript">
    document.getElementById('show_remark').style.display = 'none';
    document.getElementById('show_files').style.display = 'none';

    function yesnoCheck() {
      if (document.getElementById('yesCheck').checked) {
        document.getElementById('show_remark').style.display = 'none';
        document.getElementById('remarks').required = false;
        document.getElementById('show_files').style.display = 'block';
      }
      else {
        document.getElementById('show_remark').style.display = 'block';
        document.getElementById('remarks').required = true;
        document.getElementById('show_files').style.display = 'none';
      }

    }

  </script>
@endsection
