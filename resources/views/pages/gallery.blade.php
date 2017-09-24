@extends('layouts.app-dashboard')



@section('page-title')
@lang('gallery.page_title')
@endsection



@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.typeahead.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection



@section('navbar-dashboard-title')
@lang('gallery.page_title')
@endsection



@section('navbar-dashboard-menu')
<li>
    <a href="#" data-toggle="modal" data-target="#addEntityModal">
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
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <div class="card-header" data-background-color="orange">

                                <h4 class="title">User List</h4>
                                <p class="category">New employees on 15th September, 2016</p>
                            </div> -->
                            <div class="card-content table-responsive">
                                @foreach ($galleries->chunk(2) as $chunk)
                                <div class="row m-b-10">
                                    @foreach ($chunk as $gallery)
                                    <div class="col-sm-6">
                                        <div class="gallery-image">
                                            <div class="image-overlay">
                                                <button class="btn btn-primary"
                                                    data-id="{{ $gallery->hashed_id }}"
                                                    data-toggle="modal"
                                                    data-target="#addToScheduleModal"
                                                    >@lang('gallery.button_add_to_display')</button>
                                                <div class="clearfix"></div>
                                                <button class="btn btn-danger"
                                                    data-id="{{ $gallery->hashed_id }}"
                                                    data-toggle="modal"
                                                    data-target="#deleteEntityModal"
                                                    >@lang('gallery.button_delete')</button>
                                            </div>
                                            <img class="img img-thumbnail" src="{{ asset($gallery->image_url) }}">
                                            <div class="image-caption">
                                                <p class="desc_content text-center">{{ $gallery->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {{ $galleries->links() }}
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
<div class="modal fade" id="addEntityModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('gallery.add') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('gallery.add_gallery_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset('img/placeholder.jpg') }}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-round btn-primary btn-file">
                                <span class="fileinput-new">@lang('gallery.button_add_image')</span>
                                <span class="fileinput-exists">@lang('gallery.button_change_image')</span>
                                <input type="file" name="image" required="">
                            </span>
                            <br />
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> @lang('gallery.button_remove_image')</a>
                        </div>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">@lang('gallery.input_title')</label>
                        <input type="text" class="form-control" name="title">
                    </div>




                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">@lang('common.modal.button_close')</button>
                    <button type="submit" class="btn btn-info btn-primary">@lang('common.modal.button_save')</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="addToScheduleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('schedule.add') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('gallery.add_to_display_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">@lang('gallery.input_daterange')</label>
                        <input type="text" class="form-control" name="display_schedule">
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">@lang('common.modal.button_close')</button>
                    <button type="submit" class="btn btn-info btn-primary">@lang('common.modal.button_continue')</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteEntityModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('gallery.delete') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('gallery.delete_gallery_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <div class="container-fluid">
                    	  <div class="alert-icon">
                    	    <i class="material-icons">error_outline</i>
                    	  </div>
                          @lang('gallery.delete_confirmation')
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
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

    $('input[name="q"]').typeahead({
        display: ["formatted_result"],
        dynamic: true,
        minLength: 2,
        delay: 500,
        group: false,
        filter: false,
        emptyTemplate: function (query) {
            return  'No result for "'+ query + '"';
        },
        // template: function (query, item) {
        //     var template = '<span data-bedroom="'+ item.bedroom +'"';
        //     template += ' data-bathroom="'+ item.bathroom +'"';
        //     template += ' data-finished-lotsize="'+ item.finished_size +'"';
        //     template += '>' + item.address_complete + '</span>';
        //     return template;
        // },
        templateValue: '@{{name}}',
        source: {
            ajax: function (query) {
                return {
                    type: "GET",
                    url: "{{ route('user.search') }}",
                    data: {
                        q: query
                    },
                    // path: 'data',
                    callback: {
                        done: function (response) {
                            return response;
                        }
                    }
                }
            }
        },
        callback: {
            // onSendRequest: function (node, query) {
            //     console.log('request is sent')
            // },
            onClickAfter: function (node, a, item, event) {
                event.preventDefault();
                // alert(item.bedroom);
                // $(' #inputBedroom ').val(item.bedroom);
                // $(' #inputBathroom ').val(item.bathroom);
                // $(' #inputSize ').val(item.finished_size);

                // $(' #firstStepNextButton ').prop('disabled', false);
                // this.hideLayout();
            },
            onCancel: function (node, event) {
                // $(' input[type="text"] ').val('');
            }
        },
        selector: {
            list: "dropdown-menu",
            item: "dropdown-item",

        },
        debug: false,

    });

    $('input[name="display_schedule"]').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD'
        },
    });

    $('#addToScheduleModal, #deleteEntityModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var fieldId = button.data('id');
        modal.find('.form-control').each(function() {
            $(this).val('');
        });
        modal.find('input[name="id"]').val(fieldId);

        modal.find('.form-control[value=""]').each(function() {
            $(this).parent().removeClass('is-empty');
        });

    })
});
</script>
@endsection
