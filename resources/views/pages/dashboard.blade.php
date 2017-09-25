@extends('layouts.app-dashboard')



@section('page-title')
Dashboard
@endsection



@section('navbar-dashboard-title')
Dashboard
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
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="fa fa-power-off"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">@lang('dashboard.status')</p>
                                <h3 class="title">ON</h3>
                                <!-- <h3 class="title">49/50<small>GB</small></h3> -->
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="fa fa-check-square-o"></i> @lang('dashboard.last_check'): 21/01/2017
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="orange">
                                <i class="fa fa-thermometer-empty"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">@lang('dashboard.temperature')</p>
                                <h3 class="title">33&deg;C</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="fa fa-line-chart"></i> @lang('dashboard.increased') 1&deg;C
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="fa fa-database"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">@lang('dashboard.disk_usage')</p>
                                <h3 class="title">31.2%</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <!-- <i class="material-icons">info_outline</i> -->
                                    <i class="fa fa-tasks"></i>
                                    @lang('dashboard.detail_usage', ['used' => '10G', 'space' =>'32G'])
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="blue">
                                <i class="fa fa-twitter"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">@lang('dashboard.bandwidth')</p>
                                <h3 class="title">300MB</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">update</i> @lang('dashboard.counted_since'): 21/01/2017
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="card-content">
                                <p class="category">@lang('dashboard.api_key')</p>
                                <button class="btn btn-danger btn-round btn-xs"><i class="fa fa-exclamation-circle"></i> &nbsp;@lang('dashboard.button_change_token')</button>
                                <!-- <h3 class="title">49/50<small>GB</small></h3> -->
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="fa fa-key"></i> {{ $user->api_token }}
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
<div class="modal fade" id="addEntityModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.add') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">Add New User</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group label-floating">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="editEntityModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.update') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">Edit User</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group label-floating">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" value="">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password (enter new password to change, otherwise leave empty)</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteEntityModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.update') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel">Delete User</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <div class="container-fluid">
                    	  <div class="alert-icon">
                    	    <i class="material-icons">error_outline</i>
                    	  </div>
                          <b>Delete User:</b> Are you sure to delete this user?
                        </div>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" value="">
                    </div>

                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





@section('javascript')
<script>
$(document).ready(function() {
    $('#editEntityModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var fieldId = button.data('field-id');
        var fieldName = button.data('field-name');
        var fieldEmail = button.data('field-email');
        var fieldPhone = button.data('field-phone');
        modal.find('.form-control').each(function() {
            $(this).val('');
        });
        modal.find('input[name="id"]').val(fieldId);
        modal.find('input[name="name"]').val(fieldName);
        modal.find('input[name="email"]').val(fieldEmail);
        modal.find('input[name="phone"]').val(fieldPhone);
        modal.find('.form-control[value=""]').each(function() {
            $(this).parent().removeClass('is-empty');
        });

    })


    $('#deleteEntityModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var fieldId = button.data('field-id');
        var fieldName = button.data('field-name');
        var fieldEmail = button.data('field-email');
        var fieldPhone = button.data('field-phone');
        modal.find('.form-control').each(function() {
            $(this).val('');
        });
        modal.find('input[name="id"]').val(fieldId);
        modal.find('input[name="name"]').val(fieldName);
        modal.find('input[name="email"]').val(fieldEmail);
        modal.find('input[name="phone"]').val(fieldPhone);
        modal.find('.form-control[value=""]').each(function() {
            $(this).parent().removeClass('is-empty');
        });

    })
});
</script>
@endsection
