@extends('layouts.app')



@section('body_style')
signup-page
@endsection



@section('style')
<style>
.signup-link {
    display: block;
    margin: 20px 0 10px;
    line-height: 1.75em;
}

</style>
@endsection



@section('content')
<div class="wrapper">
    <div class="header header-filter header-background">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

                    @include('layouts.flash')

                    <form method="POST" action="{{ route('login') }}">


                        <div class="card card-signup">


                            <div class="header header-primary text-center">
                                <h4>@lang('login.login_form_title')</h4>
                            </div>

                            <div class="content">
                                {{ csrf_field() }}

                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                                        <label for="email" class="control-label">@lang('login.input_email')</label>

                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} label-floating">
                                        <label for="password" class="control-label">@lang('login.input_password')</label>

                                        <input id="password" type="password" class="form-control" name="password" required>

                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="signup-link pull-right" href="{{ route('password.request') }}">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div> -->

                                    <button type="submit" class="btn btn-primary btn-block">
                                        @lang('login.button_login')
                                    </button>

                                    <p>@lang('login.dont_have_account')?&nbsp;&nbsp;&nbsp;<a href="{{ route('register') }}" class="link">@lang('login.register_now')</a>
                                    <span class="pull-right">@lang('login.forgot_password')?&nbsp;&nbsp;&nbsp;<a class="link" href="{{ route('password.request') }}">@lang('login.reset_password')</a></span>
                                    </p>

                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
