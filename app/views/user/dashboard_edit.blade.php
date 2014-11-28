@extends('templates.default')
{{ HTML::style('bootstrap/css/jquery-ui.css') }}
@section('content')
<div class="container" id="content">
    <div class="jumbotron">
        {{ Form::open(array('url'=>'user/update', 'class'=>'form-edit', 'method' => 'put')) }}
        <h2 class="form-signup-heading">Veranderingen aanbrengen aan je profielgegevens</h2>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        {{ Form::label('firstname', 'Voornaam: '); }}
        {{ Form::text('firstname', Input::old('firstname', $user->firstname), array('class'=>'input-block-level', 'placeholder'=>'Voornaam')) }}<br>
        {{ Form::label('lastname', 'Naam: '); }}
        {{ Form::text('lastname', Input::old('lastname', $user->lastname), array('class'=>'input-block-level', 'placeholder'=>'Naam')) }}<br>
        {{ Form::label('username', 'Gebruikersnaam: '); }}
        {{ Form::text('username', Input::old('username', $user->username), array('class'=>'input-block-level', 'placeholder'=>'Gebruikersnaam')) }}<br>
        {{ Form::label('password', 'Wachtwoord: '); }}
        {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Wachtwoord ')) }}<br>
        {{ Form::label('password_confirmation', 'Wachtwoord bevestigen: '); }}
        {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Wachtwoord')) }}<br>
        {{ Form::label('adress', 'Adres: '); }}
        {{ Form::text('adress', Input::old('adress', $user->adress), array('class'=>'input-block-level', 'placeholder'=>'Straat en huisnummer')) }}<br>  
        {{ Form::label('zip', 'Postcode: '); }}
        {{ Form::text('zip', Input::old('zip', $user->zip), array('class'=>'input-block-level', 'placeholder'=>'Postcode')) }}<br>
        {{ Form::label('city', 'Gemeente: '); }}
        {{ Form::text('city', Input::old('city', $user->city), array('class'=>'input-block-level', 'placeholder'=>'Gemeente')) }}<br>
        {{ Form::label('email', 'E-mail: '); }}
        {{ Form::text('email', Input::old('email', $user->email), array('class'=>'input-block-level', 'placeholder'=>'E-mail')) }}<br>
        {{ Form::label('phone', 'Telefoonnummer: '); }}
        {{ Form::text('phone', Input::old('phone', $user->phone), array('class'=>'input-block-level', 'placeholder'=> 'Telefoonnummer')) }}<br>
        {{ Form::label('banknr', 'Rekeningnummer: '); }}
        {{ Form::text('banknr', Input::old('banknr', $user->banknr), array('class'=>'input-block-level', 'placeholder'=>'Rekeningnummer')) }}<br>

        {{ Form::submit('Aanpassen', array('class'=>'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>
{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
@stop