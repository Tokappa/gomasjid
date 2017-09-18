@extends('layouts.app-dashboard')



@section('page-title')
@lang('masjid.financial.page_title')
@endsection



@section('style')
<style>
.notopmargin {
    margin-top: 0px;
}
</style>
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
                                        <b>Pemasukan</b> <a class="pull-right">Rp. 150.000</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pengeluaran</b> <a class="pull-right">Rp. 250.000</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Saldo</b> <a class="pull-right">Rp. 30.000.000</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('masjid.financial_update')</h3>
                            </div>

                            <div class="panel-body">

                                <div class="form-group label-floating">
                                    <label class="control-label">@lang('masjid.input_income')</label>
                                    <input type="text" class="form-control" name="income">
                                </div>


                                <div class="form-group label-floating">
                                    <label class="control-label">@lang('masjid.input_expense')</label>
                                    <input type="text" class="form-control" name="expense">
                                </div>

                                <div class="form-group label-floating">
                                    <label class="control-label">@lang('masjid.input_balance')</label>
                                    <input type="text" class="form-control" name="balance">
                                </div>

                                <div class="clearfix"></div>
                                <button class="btn btn-primary">Simpan</button>


                            </div>
                        </div>
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
