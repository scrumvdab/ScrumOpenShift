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
                        <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $comment->author_id)->first()->id}}.jpg"/>
                        <br>
                    </div>
                    <!-- code like dislike -->
                    <div class='ld-container'>
                        {{ Form::open(array('url'=>'vote', 'tid'=>'demo1')) }}
                        <div style='float:left;'>
                            {{ Form::image('like_dislike/images/thumbs-up-s.png', 'I like it', ['class' => 'ld-btn-like']) }}
                            {{ Form::image('like_dislike/images/thumbs-down-s.png', 'I dislike it', ['class' => 'ld-btn-dislike']) }}
                        </div>
                        <div style='float:right;'>
                            <div class='ld-stats-bar'></div>
                            <span class='ld-stats-txt'></span>
                        </div>
                        <div class='ld-clear-both'></div>
                        <button type="button" class='ld-btn-reset' title='Reset it'>
                            Reset Cookie
                        </button>
                        {{ Form::close() }}
                    </div>
                    <!-- einde like dislike -->
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

{{ HTML::script ('like_dislike/jquery.js') }}
{{ HTML::script ('like_dislike)/ajax_likes.js') }}
{{ HTML::script('http://code.jquery.com/jquery-2.1.1.min.js') }}
{{HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js')}}

@stop
