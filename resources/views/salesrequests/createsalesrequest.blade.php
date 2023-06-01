<form method="post" action="{{ route('salesrequests.store') }}"
      enctype="multipart/form-data" class="form-horizontal form-label-left">
    @csrf

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Mall Name:</label>
        <div class="col-sm-9">
            <select name='mall_id' id="mall_name" class="form-select" required>
                <option disabled selected=selected> -- select an option --</option>
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
            <input type="text" class="form-control" name="qoutation_addressee" value="{{ old('qoutation_addressee') }}"/>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Requester:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="requester" value="{{ old('requester') }}" required/>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Project Title:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="project_title" value="{{ old('project_title') }}" required/>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Proposal Target Date:</label>
        <div class="col-sm-9">
            <input type="date" class="form-control" name="date_needed" required>
        </div>
    </div>

    <div class="mb-3 row align-items-center">
        <label for="staticEmail" class="col-sm-3 form-label text-end">For Site Survey:</label>
        <div class="col-sm-9">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="on_site_survey" id="inlineRadio1" value="Yes">
                <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="on_site_survey" id="inlineRadio2" value="No">
                <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Comment:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="comment" value="{{ old('comment') }}"/>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Project Requirement File:</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" name="project_requirements_files">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Category:</label>
        <div class="col-sm-9">
            <select name='category' class="form-control" required>
                <option disabled selected=selected> -- select an option --
                </option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="Special">Special</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <div class="text-end">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</form>

