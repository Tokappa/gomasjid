@extends('layouts.app-dashboard')



@section('page-title')
@lang('masjid.jumat.page_title')
@endsection



@section('navbar-dashboard-title')
@lang('masjid.jumat.page_title')
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
                                <h3 class="panel-title">@lang('masjid.jumat_info')</h3>
                                <!-- <p class="text-muted text-center">Update date("d F Y", strtotime($masjid->jumat->updated_at))</p> -->
                            </div>
                            <div class="panel-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>@lang('masjid.jumat.muadzin')</b> <span class="pull-right">{{ (isset($masjid->jumat)) ? $masjid->jumat->muadzin : ""}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>@lang('masjid.jumat.khatib')</b> <span class="pull-right">{{ (isset($masjid->jumat)) ? $masjid->jumat->khatib : ""}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>@lang('masjid.jumat.imam')</b> <span class="pull-right">{{ (isset($masjid->jumat)) ? $masjid->jumat->imam : ""}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <form action="{{ route('jumat.update') }}" method="post">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">@lang('masjid.jumat_update')</h3>
                                </div>

                                <div class="panel-body">

                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_muadzin')</label>
                                        <input type="text" class="form-control" name="muadzin" value="{{ $masjid->jumat->muadzin or "" }}">
                                    </div>


                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_khatib')</label>
                                        <input type="text" class="form-control" name="khatib" value="{{ $masjid->jumat->khatib or "" }}">
                                    </div>

                                    <div class="form-group label-floating">
                                        <label class="control-label">@lang('masjid.input_imam')</label>
                                        <input type="text" class="form-control" name="imam" value="{{ $masjid->jumat->imam or "" }}">
                                    </div>

                                </div>

                                <div class="panel-footer">
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
