@extends('layouts.app')



@section('body_style')
signup-page
@endsection



@section('content')
<div class="wrapper">
    <div class="header header-filter header-background">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

                    <form method="POST" action="{{ route('register') }}">
                        <div class="card card-signup">

                            <div class="header header-primary text-center">
                                <h4>@lang('register.register_form_title')</h4>
                            </div>

                            <div class="content">

                                {{ csrf_field() }}

                                <div class="col-md-10 col-md-offset-1">

                                    <div class="form-group{{ $errors->has('masjid_name') ? ' has-error' : '' }} label-floating">

                                        <label for="masjid_name" class="control-label">@lang('register.input_masjid_name')</label>

                                        <input id="masjid_name" type="text" class="form-control" name="masjid_name" value="{{ old('masjid_name') }}" required autofocus>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('masjid_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('masjid_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('masjid_phone') ? ' has-error' : '' }} label-floating">
                                        <label for="masjid_phone" class="control-label">@lang('register.input_masjid_phone')</label>

                                        <input id="masjid_phone" type="text" class="form-control" name="masjid_phone" value="{{ old('masjid_phone') }}" required>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('masjid_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('masjid_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('contact_person_name') ? ' has-error' : '' }} label-floating">
                                        <label for="contact_person_name" class="control-label">@lang('register.input_contact_person_name')</label>

                                        <input id="contact_person_name" type="text" class="form-control" name="contact_person_name" value="{{ old('contact_person_name') }}" required>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('contact_person_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_person_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('contact_person_phone') ? ' has-error' : '' }} label-floating">
                                        <label for="contact_person_phone" class="control-label">@lang('register.input_contact_person_phone')</label>

                                        <input id="contact_person_phone" type="text" class="form-control" name="contact_person_phone" value="{{ old('contact_person_phone') }}" required>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('contact_person_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_person_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('account_email') ? ' has-error' : '' }} label-floating">
                                        <label for="account_email" class="control-label">@lang('register.input_account_email')</label>

                                        <input id="account_email" type="text" class="form-control" name="account_email" value="{{ old('account_email') }}" required>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('account_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('account_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} label-floating">
                                        <label for="password" class="control-label">@lang('register.input_password')</label>

                                        <input id="password" type="password" class="form-control" name="password" required>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group label-floating">
                                        <label for="password-confirm" class="control-label">@lang('register.input_confirm_password')</label>

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        <span class="material-icons form-control-feedback">clear</span>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block">
                                        @lang('register.button_register')
                                    </button>

                                    <p>@lang('register.already_have_account')&nbsp;&nbsp;&nbsp;<a href="{{ route('login') }}" class="link">@lang('common.login')</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="{{ route('password.request') }}" class="link">@lang('common.forgot_password')</a></p>
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
