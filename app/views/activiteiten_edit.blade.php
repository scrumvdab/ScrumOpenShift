@extends('templates.default')
{{ HTML::style('bootstrap/css/jquery-ui.css') }}
@section('content')
<div class="container" id="content">
    <div class="jumbotron">
        <h2 class="form-signup-heading">Veranderingen aanbrengen aan je profielgegevens</h2>
        {{ Form::open(array('url'=>'edit_activity', 'class' => 'form-edit', 'method' => 'put')) }}
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        
        {{ Form::label('title', 'Naam: '); }}
        {{ Form::text('title', Input::old('title', $activities->title), array('class'=>'input-block-level', 'placeholder'=>'Naam activiteit')) }}<br>
        
        {{ Form::label('place', 'Plaats: '); }}
        {{ Form::text('place', Input::old('place', $activities->place), array('class'=>'input-block-level', 'placeholder'=>'Plaats activiteit')) }}<br>
        
        {{ Form::label('body', 'Beschrijving: '); }}
        {{ Form::textarea('body', Input::old('body', $activities->body), array('style' => 'width: 80%')) }}<br>
        
        {{ Form::label('date_start', 'Begin datum: '); }}
        {{ Form::date('date_start', Input::old('date_start', $activities->date_start), array('class'=>'input-block-level', 'placeholder'=>'Begin activiteit')) }}<br>
        
        {{ Form::label('time_start', 'Beginuur: '); }}
        {{ Form::time('time_start', Input::old('time_start', $activities->time_start), array('class'=>'input-block-level', 'placeholder'=>'Beginuur activiteit')) }}<br>
        
        {{ Form::label('date_end', 'Eind datum: '); }}
        {{ Form::date('date_end', Input::old('date_end', $activities->date_end), array('class'=>'input-block-level', 'placeholder'=>'Einde activiteit')) }}<br>
        
        {{ Form::label('time_end', 'Einduur: '); }}
        {{ Form::time('time_end', Input::old('time_end', $activities->time_end), array('class'=>'input-block-level', 'placeholder'=>'Beginuur activiteit')) }}<br>
        <div id="success"></div>
        {{ Form::submit('Activiteiten aanpassen', array('class'=>'btn btn-primary'))}}
        {{ Form::close() }}
        
    </div>
</div>
{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
{{ HTML::style('bootstrap/css/jquery-ui.css') }}
{{ HTML::style('fullcalendar/fullcalendar.css') }}
{{ HTML::script('http://code.jquery.com/jquery-1.10.2.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.11.1/jquery-ui.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
@stop