@extends('layouts.app-dashboard')



@section('page-title')
@lang('schedule.page_title')
@endsection



@section('style')
<link rel="stylesheet" href="{{ asset('css/jquery.typeahead.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" /> -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/fullcalendar.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/jquery.qtip.min.css') }}">
@endsection



@section('navbar-dashboard-title')
@lang('schedule.page_title')
@endsection



@section('navbar-dashboard-menu')
<!-- <li>
    <a href="#" data-toggle="modal" data-target="#addEntityModal">
        <i class="material-icons">add_circle_outline</i>
        <p class="hidden-lg hidden-md">Add New</p>
    </a>
</li> -->
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
                                <div id="calendar" class="fc fc-ltr fc-unthemed">
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






@section('javascript')
<script src="{{ asset('js/jquery.typeahead.min.js') }}"></script>
<!-- <script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script> -->
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.qtip.min.js') }}"></script>
<script>
$(document).ready(function() {

    /* initialize the calendar
    -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
    m = date.getMonth(),
    y = date.getFullYear();
    $('#calendar').fullCalendar({
        header: {
            // left: 'prev,next today',
            left: 'prev,next',
            center: 'title',
            right: 'today',
            // right: 'month,agendaWeek,agendaDay',
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },


        events: {
            url: '{{ route("schedule.list-active") }}',
            type: 'GET',
            data: {
                id: '{{ $masjid->hashed_id }}',
            },
            error: function() {
                alert('there was an error while fetching events!');
            },
        },

        // editable: true,
        // droppable: true, // this allows things to be dropped onto the calendar !!!
        // drop: function (date, allDay) { // this function is called when something is dropped
        //
        //     // retrieve the dropped element's stored Event Object
        //     var originalEventObject = $(this).data('eventObject');
        //
        //     // we need to copy it, so that multiple events don't have a reference to the same object
        //     var copiedEventObject = $.extend({}, originalEventObject);
        //
        //     // assign it the date that was reported
        //     copiedEventObject.start = date;
        //     copiedEventObject.allDay = allDay;
        //     copiedEventObject.backgroundColor = $(this).css("background-color");
        //     copiedEventObject.borderColor = $(this).css("border-color");
        //
        //     // render the event on the calendar
        //     // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        //     $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
        //
        //     // is the "remove after drop" checkbox checked?
        //     if ($('#drop-remove').is(':checked')) {
        //         // if so, remove the element from the "Draggable Events" list
        //         $(this).remove();
        //     }
        //
        // },


        eventRender: function(event, element) {
            element.qtip({
                content: {text: '<img src="' + event.image+'" style="width:250px;height:auto">'},
                // position: {my: 'top center', at: 'bottom center'},
                // position: {target: $('.fc-view-container')},
                position: {viewport: $('.fc-view-container'), my: 'top left', at: 'bottom center'},
                // placement: 'bottom',

            });
        },


        // eventMouseover: function( event, jsEvent, view ) {
        //     console.log(event);
        // },
    });

});
</script>
@endsection
