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

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        <div class="card card-signup">

                            <div class="header header-primary text-center">
                                <h4>Reset Password</h4>
                            </div>

                            <div class="content">

                                {{ csrf_field() }}

                                <div class="col-md-10 col-md-offset-1">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                                        <label for="email" class="control-label">E-Mail Address</label>

                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        <span class="material-icons form-control-feedback">clear</span>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                                Send Password Reset Link
                                        </button>
                                    </div>
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
