@extends('layout.app')
@section('link')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
    <div class="py-4 px-2">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Malls</h1>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createMall">
                Add New Mall
              </button>

                <!-- Modal -->
                <div class="modal fade" id="createMall" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('malls.store') }}" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Mall</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-2 row">
                                        <label for="" class="col-sm-3 col-form-label">Region</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="region"
                                                   value="{{old('region')}}"
                                                   required autofocus>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Mall Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputPassword" name="mall_name"
                                                   value="{{old('mall_name')}}" required>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Mall Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputPassword" name="mall_code"
                                                   value="{{old('mall_code')}}" required>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Mall Logo</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="inputPassword" name="mall_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div><br />
    @endif
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-centered">
                            <thead class="thead-light">
                            <tr>
                                <th>Region</th>
                                <th>Mall Name</th>
                                <th>Mall Code</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($malls as $mall)
                                <tr>
                                    <td>{{$mall->region}}</td>
                                    <td>{{$mall->mall_name}}</td>
                                    <td>{{$mall->mall_code}}</td>
                                    <td>
{{--                                      <a href="{{ action('MallController@edit',$mall->mall_id)}}"--}}
{{--                                           class="btn btn-sm btn-primary m-0">Edit</a>--}}
                                      <button type="button" class="btn btn-xs btn-primary m-0" data-bs-toggle="modal" data-bs-target="#editMall{{$mall->mall_id}}">
                                        Edit Mall
                                      </button>

                                      <!-- Edit Modal -->
                                      <div class="modal fade" id="editMall{{$mall->mall_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Mall</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('malls.update', $mall->mall_id) }}" method="post" enctype="multipart/form-data">
                                              <div class="modal-body">
                                                @method('PATCH')
                                                @csrf
                                                <div class="mb-2 row">
                                                  <label for="" class="col-sm-3 col-form-label">Region</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="region" value="{{ $mall->region }}">
                                                  </div>
                                                </div>
                                                <div class="mb-2 row">
                                                  <label for="inputPassword" class="col-sm-3 col-form-label">Mall Name</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputPassword" name="mall_name" value="{{ $mall->mall_name }}">
                                                  </div>
                                                </div>
                                                <div class="mb-2 row">
                                                  <label for="inputPassword" class="col-sm-3 col-form-label">Mall Code</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputPassword" name="mall_code" value="{{ $mall->mall_code }}">
                                                  </div>
                                                </div>
                                                <div class="mb-2 row">
                                                  <label for="inputPassword" class="col-sm-3 col-form-label">Mall Logo</label>
                                                  <div class="col-sm-9">
                                                    <input type="file" class="form-control" id="inputPassword" name="mall_logo">
                                                    @if($mall->mall_logo != "")
                                                      <img src="/storage/uploads/{{ $mall->mall_logo }}" class="img-fluid mt-2"/>
                                                    @endif
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-primary mx-2" type="submit">Submit</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#example').DataTable({
        aaSorting:[],
        pageLength: -1,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        // stateSave:true,
      });
    });
  </script>
@endsection
