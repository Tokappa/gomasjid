@extends('layouts.app-dashboard')



@section('page-title')
User Profile
@endsection



@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.typeahead.css') }}">
<style>
.thumbnail {
    border: 0 none;
    padding: 0;
}
.card img {
    height: auto;
    width: 100%;
}
.btn-file > input {
    cursor: pointer;
    direction: ltr;
    font-size: 23px;
    height: 100%;
    margin: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
}
.fileinput {
    display: inline-block;
    margin-bottom: 9px;
}

.fileinput .form-control {
    display: inline-block;
    padding-top: 7px;
    padding-bottom: 5px;
    margin-bottom: 0;
    vertical-align: middle;
    cursor: text;
}

.fileinput .thumbnail {
    display: inline-block;
    margin-bottom: 10px;
    overflow: hidden;
    text-align: center;
    vertical-align: middle;
    max-width: 250px;
    box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.fileinput .thumbnail.img-circle {
    border-radius: 50%;
    max-width: 100px;
}

.fileinput .thumbnail > img {
    max-height: 100%;
}

.fileinput .btn {
    vertical-align: middle;
}

.fileinput-exists .fileinput-new,
.fileinput-new .fileinput-exists {
    display: none;
}

.fileinput-inline .fileinput-controls {
    display: inline;
}

.fileinput-filename {
    display: inline-block;
    overflow: hidden;
    vertical-align: middle;
}

.form-control .fileinput-filename {
    vertical-align: bottom;
}

.fileinput.input-group {
    display: table;
}

.fileinput.input-group > * {
    position: relative;
    z-index: 2;
}

.fileinput.input-group > .btn-file {
    z-index: 1;
}

.fileinput-new.input-group .btn-file,
.fileinput-new .input-group .btn-file {
    border-radius: 0 4px 4px 0;
}

.fileinput-new.input-group .btn-file.btn-xs,
.fileinput-new .input-group .btn-file.btn-xs,
.fileinput-new.input-group .btn-file.btn-sm,
.fileinput-new .input-group .btn-file.btn-sm {
    border-radius: 0 3px 3px 0;
}

.fileinput-new.input-group .btn-file.btn-lg,
.fileinput-new .input-group .btn-file.btn-lg {
    border-radius: 0 6px 6px 0;
}

.form-group.has-warning .fileinput .fileinput-preview {
    color: #ff9800;
}

.form-group.has-warning .fileinput .thumbnail {
    border-color: #ff9800;
}

.form-group.has-error .fileinput .fileinput-preview {
    color: #f44336;
}

.form-group.has-error .fileinput .thumbnail {
    border-color: #f44336;
}

.form-group.has-success .fileinput .fileinput-preview {
    color: #4caf50;
}

.form-group.has-success .fileinput .thumbnail {
    border-color: #4caf50;
}
</style>
@endsection



@section('navbar-dashboard-title')
User Profile
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

                @include('layouts.notification')

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header" data-background-color="purple">
                                <h4 class="title">{{ $user->name }}</h4>
        						<p class="category">User profile</p>
                            </div>
                            <div class="card-content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
        									<div class="form-group label-floating">
        										<label class="control-label">Username</label>
        										<input type="text" class="form-control" name="name" value="{{ $user->name }}">
        									</div>
                                        </div>
                                        <div class="col-md-4">
        									<div class="form-group label-floating">
        										<label class="control-label">Email address</label>
                                                <input type="email" class="form-control" name="name" value="{{ $user->email }}">
        									</div>
                                        </div>
                                        <div class="col-md-3">
        									<div class="form-group label-floating">
        										<label class="control-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
        									</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <img src="{{ asset('img/placeholder.jpg') }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Add Photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="..." />
                                                    </span>
                                                    <br />
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
        			<div class="col-md-4">
        				<div class="card card-profile">


                            <div class="card-avatar">
                                <img class="img" src="{{ asset('img/faces/marc.jpg') }}" />
        					</div>

        					<div class="content">
        						<h6 class="category text-gray">CEO / Co-Founder</h6>
        						<h4 class="card-title">{{ $user->name }}</h4>
        						<p class="card-content">
        							<!-- Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is... -->
        						</p>

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
<script src="{{ asset('js/jquery.typeahead.min.js') }}"></script>
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


});
</script>
@endsection
