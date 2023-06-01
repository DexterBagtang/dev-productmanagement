<form method="post" action="{{ route('salesrequests.update', $salesrequest->sales_request_id) }}"
      enctype="multipart/form-data" class="form-horizontal form-label-left">
    @method('PATCH')
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
            <input type="text" class="form-control" name="qoutation_addressee"
                   value="{{ $salesrequest->qoutation_addressee }}"/>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Requester:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="requester" value="{{ $salesrequest->requester }}" required/>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Project Title:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="project_title" value="{{ $salesrequest->project_title }}"
                   required/>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label text-end">Proposal Target Date:</label>
        <div class="col-sm-9">
            <input type="date" class="form-control" name="date_needed" value="{{ $salesrequest->date_needed }}"
                   required>
        </div>
    </div>

    <div class="mb-3 row align-items-center">
        <label for="staticEmail" class="col-sm-3 form-label text-end">For Site Survey:</label>
        <div class="col-sm-9">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="on_site_survey" id="inlineRadio1"
                       value="Yes" {{ ($salesrequest->on_site_survey=="Yes")? "checked" : "" }}>
                <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="on_site_survey" id="inlineRadio2"
                       value="No" {{ ($salesrequest->on_site_survey=="No")? "checked" : "" }}>
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
            <input type="hidden" name="existing_project_requirements"
                   value="{{$salesrequest->project_requirements_files}}">
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

    <div class="modal-footer">
        <div class="text-end">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</form>

