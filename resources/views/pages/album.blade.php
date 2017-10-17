@extends('layouts.app-dashboard')



@section('page-title')
@lang('album.page_title')
@endsection



@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.typeahead.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection



@section('navbar-dashboard-title')
@lang('album.page_title')
@endsection



@section('navbar-dashboard-menu')
<li>
    <a href="#" data-toggle="modal" data-target="#addEntityModal">
        <i class="material-icons">add_circle_outline</i>
        <p class="hidden-lg hidden-md">Add New</p>
    </a>
</li>
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
                                @foreach ($albums->chunk(2) as $chunk)
                                <div class="row m-b-10">
                                    @foreach ($chunk as $album)
                                    <div class="col-sm-6">
                                        <div class="gallery-image">
                                            <div class="image-overlay">
                                                <button class="btn btn-primary"
                                                    data-id="{{ $album->hashed_id }}"
                                                    data-toggle="modal"
                                                    data-target="#addToScheduleModal"
                                                    >@lang('gallery.button_add_to_display')</button>
                                                <div class="clearfix"></div>
                                                <button class="btn btn-danger"
                                                    data-id="{{ $album->hashed_id }}"
                                                    data-toggle="modal"
                                                    data-target="#deleteEntityModal"
                                                    >@lang('gallery.button_delete')</button>
                                            </div>
                                            <!-- <img class="img img-thumbnail" src="{{ asset($album->images->first()->image_url) }}"> -->
                                            <div id="carousel-{{ $album->hashed_id }}" class="carousel slide" data-ride="carousel" data-interval="3000">
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                    @foreach ($album->images as $image)
                                                        @if ($loop->first)
                                                        <li data-target="#carousel-{{ $album->hashed_id }}" data-slide-to="{{ $loop->index }}" class="active"></li>
                                                        @else
                                                        <li data-target="#carousel-{{ $album->hashed_id }}" data-slide-to="{{ $loop->index }}"></li>
                                                        @endif
                                                    @endforeach
                                                </ol>

                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                    @foreach ($album->images as $image)
                                                    @if ($loop->first)
                                                    <div class="item active">
                                                        <img src="{{ asset($image->image_url) }}" alt="...">
                                                    </div>
                                                        @else
                                                    <div class="item">
                                                        <img src="{{ asset($image->image_url) }}" alt="...">
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>

                                                <!-- Controls -->
                                                <a class="left carousel-control" href="#carousel-{{ $album->hashed_id }}" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-{{ $album->hashed_id }}" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>

                                            <div class="image-caption">
                                                <p class="desc_content text-center">{{ $album->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {{ $albums->links() }}
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
            <form action="{{ route('album.add') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">@lang('album.add_album_title')</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group label-floating">
                        <label class="control-label">@lang('album.input_title')</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="album-images">
                        <div class="fileinput fileinput-new text-center master-row">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('img/placeholder.jpg') }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div>
                                <span class="btn btn-round btn-primary btn-file">
                                    <span class="fileinput-new">@lang('album.button_add_image')</span>
                                    <span class="fileinput-exists">@lang('album.button_change_image')</span>
                                    <input type="file" name="image[]" required="">
                                </span>
                                <br />
                                <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> @lang('album.button_remove_image')</a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-add-other-images" role="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;@lang('album.button_add_another_image')</button>
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
                    <input type="hidden" name="type" value="album">
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

    $('.fileinput').fileinput();

    $('#addEntityModal').on('click', '.btn-add-other-images', function() {
        var modalBody = $(this).closest('.modal-body');
        var albumImages = $(modalBody).find('.album-images');
        var masterRow = $(modalBody).find('.master-row').clone();
        $(masterRow).removeClass('master-row');
        $(masterRow).fileinput('clear');
        $(masterRow).find('input[type="file"]').prop('required', false);
        // console.log(masterRow);
        $(modalBody).find('.fileinput').fileinput();
        $(albumImages).append(masterRow);
    });

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
