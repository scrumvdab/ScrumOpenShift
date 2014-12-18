@extends('templates.default')
@section('content')
<div class="container" id="content">
    <div class="navbar">
        <div class="jumbotron" style="min-height:700px">
            <div class="container">
                <div id="popup_warning">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        {{ Session::get('success') }}
                    </div>
                    @elseif (Session::has('fail'))
                    <div class="alert alert-fail alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                </div>
                <h1>Nieuw onderwerp</h1>

                <form action="{{ URL::route('forum-store-thread', $id) }}" method="post">
                    <div class="form-group">
                        <label for="title">Titel: </label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>

                    <div class="form-group">
                        <label for="body">Boodschap: </label>
                        <textarea class="form-control" name="body" id="body"></textarea>
                    </div>
                    {{ Form::token() }}
                    <div class="form-group">
                        <input type="submit" value="Bewaar onderwerp" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{ HTML::script('http://code.jquery.com/jquery-2.1.1.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
@stop
