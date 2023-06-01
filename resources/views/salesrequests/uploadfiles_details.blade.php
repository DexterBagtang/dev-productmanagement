@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Upload Files</h1>
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

{{--                  @dd($salesrequests)--}}
                    @foreach($salesrequests as $salesrequest)
                        <form method="post"
                              action="{{ action('SalesrequestController@uploadfiles',$salesrequest->sales_request_id)}}"
                              enctype="multipart/form-data" class="form-horizontal form-label-left">
                            @csrf


                            @if (Auth::user()->role == '4' || Auth::user()->role == '5')
                                <div class="row mb-3">
                                    <label class="col-form-label" for="contractor_ntp">Contractor
                                        NTP:</label>
                                  @if($salesrequest->contractor_ntp != null || $salesrequest->contractor_ntp != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->contractor_ntp }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->contractor_ntp }}</a>
                                    </div>
                                  @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="contractor_ntp">
                                    </div>
                                    <input type="hidden" name="existing_contractor_ntp"
                                           value="{{$salesrequest->contractor_ntp}}">
                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label" for="contractor_po">Contractor
                                        PO:</label>
                                  @if($salesrequest->contractor_po != null || $salesrequest->contractor_po != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->contractor_po }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->contractor_po }}</a>
                                    </div>
                                  @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="contractor_po">
                                        <input type="hidden" name="existing_contractor_po"
                                               value="{{$salesrequest->contractor_po}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label" for="cari">CARI:</label>
                                  @if($salesrequest->cari != null || $salesrequest->cari != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->cari }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->cari }}</a>
                                    </div>
                                  @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="cari">
                                        <input type="hidden" name="existing_cari" value="{{$salesrequest->cari}}">
                                    </div>
                                </div>
                            @elseif (Auth::user()->role == '8')

                                <div class="row mb-3">
                                    <label class="col-form-label"
                                           for="cer_files">CER:</label>
                                  @if($salesrequest->cer_files != null || $salesrequest->cer_files != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->cer_files }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->cer_files }}</a>
                                    </div>
                                  @endif

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="cer_files">
                                        <input type="hidden" name="existing_cer_files"
                                               value="{{$salesrequest->cer_files}}">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-form-label" for="first_copa">First
                                        COPA:</label>
                                  @if($salesrequest->first_copa != null || $salesrequest->first_copa != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->first_copa }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->first_copa }}</a>
                                    </div>
                                  @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="first_copa">
                                        <input type="hidden" name="existing_first_copa"
                                               value="{{$salesrequest->first_copa}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label" for="second_copa">Second
                                        COPA:</label>
                                  @if($salesrequest->second_copa != null || $salesrequest->second_copa != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->second_copa }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->second_copa }}</a>
                                    </div>
                                  @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="second_copa">
                                    </div>
                                    <input type="hidden" name="existing_second_copa"
                                           value="{{$salesrequest->second_copa}}">
                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label" for="coca">COCA:</label>
                                  @if($salesrequest->coca != null || $salesrequest->coca != "")
                                    <div>
                                        <a href="/storage/uploads/{{ $salesrequest->coca }}"
                                           class="btn btn-sm btn-outline-info"
                                           target="_blank">📂{{ $salesrequest->coca }}</a>
                                    </div>
                                  @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control" name="coca">
                                    </div>
                                    <input type="hidden" name="existing_coca" value="{{$salesrequest->coca}}">
                                </div>
                            @endif


                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ action('SalesrequestController@viewdocs') }}">
                                        <button type="button" class="btn btn-primary">Cancel</button>
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
