@extends('layouts.app-dashboard')



@section('page-title')
User Management
@endsection



@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.typeahead.css') }}">
@endsection



@section('navbar-dashboard-title')
User Management
@endsection



@section('navbar-dashboard-menu')
<li>
    <a href="#" data-toggle="modal" data-target="#addEntityModal">
        <i class="material-icons">person_add</i>
        <p class="hidden-lg hidden-md">Add New</p>
    </a>
</li>
@endsection



@section('navbar-dashboard-search')
<form class="navbar-form navbar-right typeahead__container" method="get" role="search" action="{{ route('user.search') }}">
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
</form>
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
                                <table class="table table-hover">
                                    <thead class="text-warning">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td class="td-actions text-right">
                                                <a role="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="View Profile"
                                                    href="{{ route('user.profile', ['id' => $optimus->encode($user->id)]) }}">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                                <button type="button"
                                                    rel="tooltip"
                                                    title=""
                                                    class="btn btn-success btn-simple btn-xs"
                                                    data-original-title="Edit Profile"
                                                    data-toggle="modal"
                                                    data-target="#editEntityModal"
                                                    data-field-id="{{ $optimus->encode($user->id) }}"
                                                    data-field-name="{{ $user->name }}"
                                                    data-field-email="{{ $user->email }}"
                                                    data-field-phone="{{ $user->phone }}"
                                                    >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button"
                                                    rel="tooltip"
                                                    title=""
                                                    class="btn btn-danger btn-simple btn-xs"
                                                    data-original-title="Remove"
                                                    data-toggle="modal"
                                                    data-target="#deleteEntityModal"
                                                    data-field-id="{{ $optimus->encode($user->id) }}"
                                                    data-field-name="{{ $user->name }}"
                                                    data-field-email="{{ $user->email }}"
                                                    data-field-phone="{{ $user->phone }}"
                                                    >
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                {{ $users->links() }}
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
<script src="{{ asset('js/jquery.typeahead.min.js') }}"></script>
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
