@extends('layouts.app-dashboard')



@section('page-title')
@lang('masjid.financial.page_title')
@endsection



@section('navbar-dashboard-title')
@lang('masjid.financial.page_title')
@endsection



@section('navbar-dashboard-search')
<!-- <form class="navbar-form navbar-right typeahead__container" method="get" role="search" action="{{ route('user.search') }}">
    <div class="form-group is-empty typeahead__field">
        <span class="typeahead__query">
            <input type="text" class="form-control" name="q" placeholder="Search" autocomplete="off">
            <span class="material-input"></span>
        </span>
    </div>

    <input type="hidden" name="search" value="user">

    <button type="submit" class="btn btn-white btn-round btn-just-icon">
        <i class="material-icons">search</i><div class="ripple-container"></div>
    </button>
</form> -->
@endsection



@section('content')


<div class="wrapper">

    @include('layouts.sidebar')

    <div class="main-panel">

        @include('layouts.navbar-dashboard')

        <div class="content">
            <div class="container-fluid">

                @include('layouts.flash')

                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('masjid.financial_status')</h3>
                            </div>
                            <div class="panel-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>@lang('masjid.income')</b> <span class="pull-right">Rp. {{ (isset($masjid->financial)) ? number_format($masjid->financial->income, 0, ',', '.') : 0}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>@lang('masjid.expense')</b> <span class="pull-right">Rp. {{ (isset($masjid->financial)) ? number_format($masjid->financial->expense, 0, ',', '.') : 0}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>@lang('masjid.balance')</b> <span class="pull-right">Rp. {{ (isset($masjid->financial)) ? number_format($masjid->financial->balance, 0, ',', '.') : 0}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <form action="{{ route('financial.update') }}" method="post">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">@lang('masjid.financial_update')</h3>
                                </div>

                                <div class="panel-body">

                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_income')</label>
                                        <input type="text" class="form-control" name="income" value="{{ $masjid->financial->income or 0 }}">
                                    </div>


                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_expense')</label>
                                        <input type="text" class="form-control" name="expense" value="{{ $masjid->financial->expense or 0 }}">
                                    </div>

                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_balance')</label>
                                        <input type="text" class="form-control" name="balance" value="{{ $masjid->financial->balance or 0 }}">
                                    </div>

                                </div>

                                <div class="panel-footer">
                                    <input type="hidden" name="step" value="1">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary btn-block">Simpan</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer-dashboard')

    </div>
</div>
@endsection





@section('javascript')
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {

});
</script>
@endsection
