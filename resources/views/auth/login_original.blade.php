<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Project Management</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" type="image/png" href="img/pm.logo.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<div class="container" style="z-index:9999;">
    <div class="row justify-content-center">
        <div class="col-md-4"></div>
        <div class="col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 divider col-sm-6">
                            <img src="{{asset('img/logo1.png')}}" alt="Hero" style="height:80px;">
                            <div style="color: lightgrey; text-align: center; margin-top: 1rem;font-weight: bolder">Project Management System</div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-1 col-sm-1"></div>
                                    <div class="col-md-10 col-sm-10">
                                        <input id="username" type="text"
                                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                               name="username" value="{{ old('username') }}" required autofocus
                                               placeholder="Username">


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1 col-sm-1"></div>
                                    <div class="col-md-10 col-sm-10">
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <!--  <div class="form-group row">
                                      <div class="col-md-1 offset-md-1">
                                          <div class="g-recaptcha" data-sitekey="6Lea0qQUAAAAAAHOEYQFbNvIp4NNUO7I8jHDTKfe"></div>
                                      </div>
                                  </div> -->


                                <div class="form-group row mb-0">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3"></div>
                                            <button type="submit" class="btn_login btn btn-primary col-md-6 col-sm-6">
                                                {{ __('Login') }}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                @foreach ($errors->all() as $error)
                                    <br>
                                    <div class="logout-warning">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
