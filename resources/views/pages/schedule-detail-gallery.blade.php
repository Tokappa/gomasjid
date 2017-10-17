@extends('layouts.app-dashboard')



@section('page-title')
@lang('schedule.page_title')
@endsection



@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<style>
.notopmargin {
    margin-top: 0px;
}
</style>
@endsection



@section('navbar-dashboard-title')
@lang('schedule.page_title')
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
                    <div class="col-md-9">
                        <div class="card">
                            <img src="{{ asset($schedule->gallery->image_url) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">@lang('schedule.input_start_date')</label>
                            <input type="text" class="form-control" name="start_date" value="{{ $schedule->start }}">
                        </div>
                        <div class="form-group notopmargin">
                            <label class="control-label">@lang('schedule.input_end_date')</label>
                            <input type="text" class="form-control" name="end_date" value="{{ $schedule->end }}">
                        </div>

                        <button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#changeScheduleModal">@lang('schedule.button_change')</button>
                        <button type="button" class="btn btn-info btn-danger" data-toggle="modal" data-target="#deleteScheduleModal">@lang('schedule.button_delete')</button>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer-dashboard')

    </div>
</div>
@endsection



@section('modals')
<div class="modal fade" id="changeScheduleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('schedule.update') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('schedule.update_schedule_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">@lang('gallery.input_daterange')</label>
                        <input type="text" class="form-control" name="display_schedule" value="{{ $schedule->start }} - {{ $schedule->end }}">
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $schedule->hashed_id }}">
                    <input type="hidden" name="type" value="gallery">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">@lang('common.modal.button_close')</button>
                    <button type="submit" class="btn btn-info btn-primary">@lang('common.modal.button_continue')</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteScheduleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('schedule.delete') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('schedule.delete_schedule_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <div class="container-fluid">
                    	  <div class="alert-icon">
                    	    <i class="material-icons">error_outline</i>
                    	  </div>
                          @lang('schedule.delete_confirmation')
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $schedule->hashed_id }}">
                    <input type="hidden" name="type" value="gallery">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">@lang('common.modal.button_close')</button>
                    <button type="submit" class="btn btn-info btn-primary">@lang('common.modal.button_continue')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





@section('javascript')
<script src="{{ asset('js/jquery.typeahead.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {

    $('input[name="display_schedule"]').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD'
        },
    });

    // $('#changeScheduleModal, #deleteScheduleModal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget);
    //     var modal = $(this);
    //     var fieldId = button.data('id');
    //     modal.find('.form-control').each(function() {
    //         $(this).val('');
    //     });
    //     modal.find('input[name="id"]').val(fieldId);
    //
    //     modal.find('.form-control[value=""]').each(function() {
    //         $(this).parent().removeClass('is-empty');
    //     });
    //
    // })
});
</script>
@endsection
