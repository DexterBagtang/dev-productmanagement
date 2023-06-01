@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Users/Add</h1>
                <p class="mb-0">Add New user</p>
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

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">


                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf


                                            <input type="hidden" name="active" value="Yes">
                                            <div class="form-group row">
                                                <label for="username"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                <div class="col-md-6">
                                                    <input id="username" type="text"
                                                           class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                           name="username"
                                                           value="{{ old('username') }}" required>

                                                    @if ($errors->has('username'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email"
                                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                           name="email" value="{{ old('email') }}"
                                                           required>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                    <small class="text-danger">* Use only the company or internal email address. Ex: john.doe@philcom.com</small>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label for="password"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                           name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password"
                                                           class="form-control"
                                                           name="password_confirmation" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="role"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                                <div class="col-md-6">


                                                    <select class="form-select{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                                            name="role" id="role">
                                                        @if(Auth::user()->role == '1')
                                                            <option value="10">Admin</option>
                                                            <option value="7">Finance Head</option>
                                                            <option value="6">Revenue Head</option>
                                                            <option value="5">Revenue</option>
                                                            <option value="4">Purchasing</option>
                                                            <option value="9">Monitoring</option>
                                                            <option value="3">PM Supervisor</option>
                                                            <option value="2">PM Design</option>
                                                            <option value="8">Sales</option>
                                                            <option value="6">Revenue Head</option>
                                                            <option value="5">Revenue</option>
                                                        @elseif(Auth::user()->role == '3')
                                                            <option value="3">PM Supervisor</option>
                                                            <option value="2">PM Design</option>
                                                        @elseif(Auth::user()->role == '8')
                                                            <option value="8">Sales</option>
                                                        @elseif(Auth::user()->role == '6')
                                                            <option value="6">Revenue Head</option>
                                                            <option value="5">Revenue</option>
                                                        @endif

                                                    </select>

                                                    @if ($errors->has('role'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('role') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Register') }}
                                                    </button>
                                                    <a href="{{ action('Auth\RegisterController@viewusers')}}">
                                                        <button type="button"
                                                                class="btn btn-primary">Cancel
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
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
