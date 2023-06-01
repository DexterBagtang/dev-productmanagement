@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Users/Edit</h1>
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
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">


                                    <div class="card-body">
                                        @foreach($users as $user)
                                            <form method="POST"
                                                  action="{{ action('Auth\RegisterController@users_update',$user->id)}}">
                                                @csrf


                                                <div class="form-group row">
                                                    <label for="username"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="username" type="text"
                                                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                               name="username"
                                                               value="{{ $user->username }}"
                                                               required>

                                                        @if ($errors->has('username'))
                                                            <span class="invalid-feedback"
                                                                  role="alert">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="text"
                                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                               name="email"
                                                               value="{{ $user->email }}">

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback"
                                                                  role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="role"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                                    <div class="col-md-6">


                                                        <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                                                name="role" id="role">
                                                            @if(Auth::user()->role == '1')
                                                                <option value="1" {{ ($user->role=="1")? "selected" : "" }}>
                                                                    Admin
                                                                </option>


                                                            <option value="7" {{ ($user->role=="7")? "selected" : "" }}>
                                                                Finance Head
                                                            </option>
                                                            <option value="6" {{ ($user->role=="6")? "selected" : "" }}>
                                                                Revenue Head
                                                            </option>
                                                            <option value="5" {{ ($user->role=="5")? "selected" : "" }}>
                                                                Revenue
                                                            </option>
                                                            <option value="4" {{ ($user->role=="4")? "selected" : "" }}>
                                                                Purchasing
                                                            </option>
                                                            <option value="3" {{ ($user->role=="3")? "selected" : "" }}>
                                                                PM Supervisor
                                                            </option>
                                                            <option value="2" {{ ($user->role=="2")? "selected" : "" }}>
                                                                PM
                                                            </option>
                                                            <option value="8" {{ ($user->role=="8")? "selected" : "" }}>
                                                                Sales
                                                            </option>

                                                            @endif

                                                                @if(Auth::user()->role == '3')
                                                                    <option value="3" {{ ($user->role=="3")? "selected" : "" }}>
                                                                        PM Supervisor
                                                                    </option>
                                                                    <option value="2" {{ ($user->role=="2")? "selected" : "" }}>
                                                                        PM
                                                                    </option>
                                                                @endif

                                                                @if(Auth::user()->role == '8')
                                                                    <option value="8" {{ ($user->role=="8")? "selected" : "" }}>
                                                                        Sales
                                                                    </option>
                                                                @endif
                                                                @if(Auth::user()->role == '6')
                                                                    <option value="6" {{ ($user->role=="6")? "selected" : "" }}>
                                                                        Revenue Head
                                                                    </option>
                                                                    <option value="5" {{ ($user->role=="5")? "selected" : "" }}>
                                                                        Revenue
                                                                    </option>
                                                                    <option value="4" {{ ($user->role=="4")? "selected" : "" }}>
                                                                        Purchasing
                                                                    </option>
                                                                @endif

                                                        </select>

                                                        @if ($errors->has('role'))
                                                            <span class="invalid-feedback"
                                                                  role="alert">
                                                            <strong>{{ $errors->first('role') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="role"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                                                    <div class="col-md-6">


                                                        <select class="form-control{{ $errors->has('active') ? ' is-invalid' : '' }}"
                                                                name="active" id="active">
                                                            <option value="Yes" {{ ($user->active=="Yes")? "selected" : "" }}>
                                                                Yes
                                                            </option>
                                                            <option value="No" {{ ($user->active=="No")? "selected" : "" }}>
                                                                No
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('active'))
                                                            <span class="invalid-feedback"
                                                                  role="alert">
                                                            <strong>{{ $errors->first('active') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit"
                                                                class="btn btn-primary">
                                                            {{ __('Update') }}
                                                        </button>
                                                        <a href="{{ action('Auth\RegisterController@viewusers')}}">
                                                            <button type="button"
                                                                    class="btn btn-primary">Cancel
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
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
