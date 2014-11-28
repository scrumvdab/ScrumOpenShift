@extends('templates.default')
@section('content')
<div class="container" id="content">
    <div class="navbar">
        <div class="jumbotron" style="min-height:700px">
            <div class="container">
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="clearfix">
                    <ol class="breadcrumb pull-left">
                        <li><a href="{{ URL::route('forum-home') }}">Forums</a></li>
                        <li><a href="{{ URL::route('forum-category', $thread->category_id) }}">{{ $thread->category->title }}</a></li>
                        <li class="active">{{ $thread->title }}</li>
                    </ol>
                    @if(Auth::user())
                    @if(Auth::user()->isAdmin() || Auth::user()->id == $thread->author_id)

                    <a href="{{ URL::route('forum-delete-thread', $thread->id) }}" class="btn btn-danger pull-right">Verwijder</a>
                    @endif
                    @endif

                </div>
                <div class="well">
                    <h2>{{ $thread->title }}</h2>
                    <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $thread->author_id)->first()->id}}.jpg">
                    <br>
                    <h4>Verzonden door: {{ $author }} op {{ $thread->created_at }}</h4>
                    <hr>
                    <p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
                </div>

                <!-- geen output indien geen comments!!! Niet dat de admin dient ingelogd te zijn -->
                <!--@if ($thread->comments()->count() > 0)-->
                @foreach ($thread->comments()->get() as $comment)
                <div class="well" style="overflow:auto;">
                    <div class="pull-right">
                        <h4>Verzonden door: {{ $comment->author->username }} op {{ $comment->created_at }}</h4>
                        <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $comment->author_id)->first()->id}}.jpg">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                    <p>{{ nl2br(BBCode::parse($comment->body)) }}</p>
                    @if (Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ URL::route('forum-delete-comment', $comment->id) }}" class="btn btn-danger">Verwijder commentaar</a>
                    @endif
                </div>
                @endforeach
                <!--@else-->
                <!--@endif-->

                @if(Auth::check())
                <form action="{{ URL::route('forum-store-comment', $thread->id) }}" method="post">
                    <div class="form-group">
                        <label for="body">Body: </label>
                        <textarea class="form-control" name="body" id="body"></textarea>
                    </div>
                    {{ Form::token() }}
                    <div class="form-group">
                        <input type="submit" value="Bewaar commentaar" class="btn btn-primary">
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
{{ HTML::script('http://code.jquery.com/jquery-2.1.1.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
@stop
