@extends('templates.default')
{{ HTML::style('bootstrap/css/jquery-ui.css') }}
@section('content')
<div class="container" id="content">
    <div class="jumbotron">
        {{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
        <h2 class="form-signup-heading">Registreren</h2>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        
        {{ Form::label('firstname', 'Voornaam: '); }}
        {{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'Voornaam')) }}<br>
        {{ Form::label('lastname', 'Naam: '); }}
        {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Naam')) }}<br>
        {{ Form::label('username', 'Gebruikersnaam: '); }}
        {{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Gebruikersnaam')) }}<br>
        {{ Form::label('password', 'Wachtwoord: '); }}
        {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Wachtwoord ')) }}<br>
        {{ Form::label('password_confirmation', 'Wachtwoord bevestigen: '); }}
        {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Wachtwoord')) }}<br>
        {{ Form::label('adress', 'Adres: '); }}
        {{ Form::text('adress', null, array('class'=>'input-block-level', 'placeholder'=>'Straat en huisnummer')) }}<br>  
        {{ Form::label('zip', 'Postcode: '); }}
        {{ Form::text('zip', null, array('class'=>'input-block-level', 'placeholder'=>'Postcode')) }}<br>
        {{ Form::label('city', 'Gemeente: '); }}
        {{ Form::text('city', null, array('class'=>'input-block-level', 'placeholder'=>'Gemeente')) }}<br>
        {{ Form::label('email', 'E-mail: '); }}
        {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'E-mail')) }}<br>
        {{ Form::label('phone', 'Telefoonnummer: '); }}
        {{ Form::text('phone', null, array('class'=>'input-block-level', 'placeholder'=> 'Telefoonnummer')) }}<br>
        {{ Form::label('banknr', 'Rekeningnummer: '); }}
        {{ Form::text('banknr', null, array('class'=>'input-block-level', 'placeholder'=>'Rekeningnummer')) }}<br>
        {{ Form::label('message', 'Boodschap: '); }}
        {{ Form::textarea('message', null, array('class'=>'input-block-level', 'placeholder'=> 'Iets extra toe te voegen?')) }}<br><br>


        {{ Form::submit('Registreren', array('class'=>'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>
{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
@stop