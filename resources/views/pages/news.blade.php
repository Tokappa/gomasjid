@extends('layouts.app-dashboard')



@section('page-title')
@lang('masjid.news.page_title')
@endsection



@section('navbar-dashboard-title')
@lang('masjid.news.page_title')
@endsection



@section('navbar-dashboard-menu')
<li>
    <a href="#" data-toggle="modal" data-target="#addEditDeleteEntityModal" data-action="add">
        <i class="material-icons">add_circle_outline</i>
        <p class="hidden-lg hidden-md">Add New</p>
    </a>
</li>
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
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('masjid.news_info')</h3>
                                <!-- <p class="text-muted text-center">Update date("d F Y", strtotime($masjid->jumat->updated_at))</p> -->
                            </div>

                                <table class="table">
                                    <tr>
                                        <th width="5%">@lang('common.table.number')</th>
                                        <th width="80%">@lang('masjid.news_content')</th>
                                        <th width="15%">@lang('common.table.action')</th>
                                    </tr>
                                    <tbody>
                                        @if ($news->count() == 0)
                                            <tr>
                                                <td colspan="3"><p class="text-center"><strong>@lang('common.table.empty_data')</strong></p></td>
                                            </tr>
                                        @else
                                            @foreach ($news as $single_news)
                                            <tr>
                                                <td>{{ (($news->currentPage() - 1 ) * $news->perPage() ) + $loop->iteration }}
                                                <!-- <td>{{ $single_news->id }} -->
                                                </td>
                                                <td>{{ $single_news->content }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-just-icon-xs"
                                                        data-toggle="modal"
                                                        data-target="#addEditDeleteEntityModal"
                                                        data-action="edit"
                                                        data-id="{{ $single_news->hashed_id }}"
                                                        >
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-warning btn-just-icon-xs"
                                                        data-toggle="modal"
                                                        data-target="#addEditDeleteEntityModal"
                                                        data-action="delete"
                                                        data-id="{{ $single_news->hashed_id }}"
                                                        >
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                <div class="panel-footer">
                                    <div class="text-center">
                                        {{ $news->links() }}
                                    </div>
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





@section('modals')
<div class="modal fade" id="addEditDeleteEntityModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('news.update') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('news.edit_modal_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="ajax-error alert alert-warning">
                        <div class="container-fluid">
                            <div class="alert-icon">
                                <i class="material-icons">error_outline</i>
                            </div>
                            <b>Error:</b> Connection to server failed.
                        </div>
                    </div>

                    <div class="modal-form">

                        <div class="form-group label-floating">
                            <label class="control-label">@lang('news.input_content')</label>
                            <textarea class="form-control" name="content"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">@lang('common.modal.button_close')</button>
                    <button type="submit" class="btn btn-primary btn-proceed">@lang('common.modal.button_save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





@section('javascript')
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {


    $('#addEditDeleteEntityModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var entityId = button.data('id');
        var modalTitle = "";
        var formAction = "";
        var btnProceed = "";
        switch (button.data('action')) {
            case "edit":
                formAction = "{{ route('news.update') }}";
                modalTitle = "@lang('news.edit_modal_title')";
                btnProceed = "@lang('common.modal.button_save')";
                break;
            case "delete":
                formAction = "{{ route('news.delete') }}";
                modalTitle = "@lang('news.delete_modal_title')";
                btnProceed = "@lang('common.modal.button_continue')";
                break;
            default:
                formAction = "{{ route('news.store') }}";
                modalTitle = "@lang('news.add_modal_title')";
                btnProceed = "@lang('common.modal.button_save')";
        }
        modal.find('.modal-title').html(modalTitle);
        modal.find('.btn-proceed').html(btnProceed);
        modal.find('form').prop('action', formAction);

        if (button.data('action') != "add") {
            $.post('{{ route("news.detail") }}', {
                id: entityId
            })
            .done(function( data ) {
                var entityContent = data.content;
                modal.find('.modal-body .ajax-error').hide();
                modal.find('.modal-body .modal-form, .modal-footer .btn-proceed').show();
                modal.find('.modal-footer .btn-proceed').prop('disabled', false);
                modal.find('.form-control').each(function() {
                    $(this).val('');
                });

                modal.find('input[name="id"]').val(entityId);
                modal.find('textarea[name="content"]').val(entityContent);


                modal.find('.form-control').filter(function() {
                    return this.value.length !== 0;
                }).parent().removeClass('is-empty');

            })
            .fail(function() {
                modal.find('.modal-body .ajax-error').show();
                modal.find('.modal-body .modal-form, .modal-footer .btn-proceed').hide();
                modal.find('.modal-footer .btn-proceed').prop('disabled', true);
            });
        } else {
            modal.find('.modal-body .ajax-error').hide();
            modal.find('.modal-body .modal-form, .modal-footer .btn-proceed').show();
            modal.find('.modal-footer .btn-proceed').prop('disabled', false);
            modal.find('.form-control').each(function() {
                $(this).val('');
            });

        }


    })

});
</script>
@endsection
