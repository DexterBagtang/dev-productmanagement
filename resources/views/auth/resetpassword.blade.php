@extends('layout.app')
@section('link')

@endsection
@section('content')
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Reset Password</h1>
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
                        </div><br />
                    @endif

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">


                                    <div class="card-body">
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <form class="form-horizontal" method="POST" action="{{ action('HomeController@user_resetPassword')}}">
                                            {{ csrf_field() }}



                                            <div class="form-group row">
                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                <div class="col-md-6">
                                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                                    @if ($errors->has('username'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

{{--                                            <div class="form-group row">--}}
{{--                                                <label for="new-password" class="col-md-4 col-form-label text-md-right">New Password</label>--}}

{{--                                                <div class="col-md-6">--}}
{{--                                                    <input id="new-password" type="password" class="form-control" name="new-password" >--}}

{{--                                                    @if ($errors->has('new-password'))--}}
{{--                                                        <span class="help-block">--}}
{{--                                                        <strong>{{ $errors->first('new-password') }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


                                            <div class="form-group">
                                                <div class="col-md-8 col-form-label text-md-right">
                                                    <button type="submit" class="btn btn-primary">
                                                        Reset Password
                                                    </button>
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
