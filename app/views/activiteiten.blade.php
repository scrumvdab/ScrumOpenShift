@extends('templates.default')
@section('content')
<!--begin inhoud-->


<div class="jumbotron container cf" id="content">
    <main>
        @if (Auth::check() && Auth::user()->isAdmin())
        {{ Form::open(array('url'=>'add', 'method'=>'get')) }}
        {{ Form::submit('Activiteiten toevoegen', array('class'=>'send-btn')) }}
        {{ Form::close() }}
        <br>
        {{ Form::open(array('url'=>'upload_fotos', 'method'=>'get')) }}
        {{ Form::submit("Foto's toevoegen" , array('class'=>'send-btn')) }}
        {{ Form::close() }}
        @endif
        <h1 class="hoofding">Hieronder vind u info over de activiteiten:</h1>
        <div id="datepicker">
            <label for="from">Van</label>
            <input type="text" id="from" name="from">
        </div>
        <div id="activiteiten">
            <div id="accordion">
                @foreach($activities as $activity)
                <h3><a href="#"> {{ $activity->title }} te {{ $activity->place }} <br>
                        van {{ $activity->time_start }} u op {{ $activity->date_start }} tot {{ $activity->time_end }} u op {{ $activity->date_end }} </a></h3>
                <div id="content_accordion">
                    <div id="foto_button" style="float:right;">
                        {{ Form::open(array('url'=>'galery', 'method'=>'get')) }}
                        {{ Form::submit("Bekijk foto's", array('class'=>'send-btn')) }}
                        {{ Form::close() }}
                    </div>
                    <div id="edit_activity_button" style="float:right;">
                        {{ Form::open(array('url'=>'edit', 'method'=>'put')) }}
                        {{ Form::submit("aanpassen", array('class'=>'send-btn')) }}
                        {{ Form::close() }}
                    </div>
                    <div id="accordion_body">
                        {{ $activity->body }}
                    </div>
                    <div id="accordion_timestamps">
                        Gemaakt op: {{ $activity->created_at }}<br>
                        Laatst gewijzigd op: {{ $activity->updated_at }} 
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
<script type="text/javascript">
    $(function () {
        $.datepicker.regional['nl'] = {clearText: 'Wissen', clearStatus: '',
            closeText: 'Sluiten', closeStatus: 'Onveranderd sluiten ',
            prevText: '<vorige', prevStatus: 'Zie de vorige maand',
            nextText: 'volgende>', nextStatus: 'Zie de volgende maand',
            currentText: 'Huidige', currentStatus: 'Bekijk de huidige maand',
            monthNames: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni',
                'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
            monthNamesShort: ['jan', 'feb', 'mrt', 'apr', 'mei', 'jun',
                'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
            monthStatus: 'Bekijk een andere maand', yearStatus: 'Bekijk nog een jaar',
            weekHeader: 'Sm', weekStatus: '',
            dayNames: ['Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'],
            dayNamesShort: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],
            dayNamesMin: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],
            dayStatus: 'Gebruik DD als de eerste dag van de week', dateStatus: 'Kies DD, MM d',
            dateFormat: 'dd/mm/yy', firstDay: 1,
            initStatus: 'Kies een datum', isRTL: false};
        $.datepicker.setDefaults($.datepicker.regional['nl']);
        $("#from").datepicker({
            defaultDate: "+1w",
            showOtherMonths: true,
            selectOtherMonths: true,
            showButtonPanel: true,
            onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            showOtherMonths: true,
            selectOtherMonths: true,
            showButtonPanel: true,
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>
<script>$(function () {
        $("#accordion").accordion({
            active: false,
            collapsible: true,
            heightStyle: "content"
        });
    });</script>

<!--
<script type="text/javascript">
    $(document).ready(function () {
        /* initialize the external events
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        $('#external-events .fc-event').each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
        /* initialize the calendar
         -----------------------------------------------------------------*/

        $('#calendar').fullCalendar({
            // events
            events:
                    {
                        url: 'http://www.google.com/calendar/feeds/passchyn.maarten%40gmail.com/public/basic',
                        className: 'gcal-event'},
            // positie header (titel,knop vandaag,prev,next)
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            eventColor: '#f00',
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
            eventClick: function (event, element) {

                event.title = "CLICKED!";
                $('#calendar').fullCalendar('updateEvent', event);
            }
        });
    });
</script>
-->
{{ HTML::style('bootstrap/css/jquery-ui.css') }}
{{ HTML::style('fullcalendar/fullcalendar.css') }}
{{ HTML::script('http://code.jquery.com/jquery-1.10.2.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.11.1/jquery-ui.js') }}
<!--{{ HTML::script('fullcalendar/lib/moment.min.js') }}
{{ HTML::script('fullcalendar/fullcalendar.js') }}
{{ HTML::script('fullcalendar/lib/jquery-ui.custom.min.js') }}
{{ HTML::script('fullcalendar/gcal.js') }}-->

{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
@stop