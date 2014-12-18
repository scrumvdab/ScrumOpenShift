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
                <ol class="breadcrumb">
                    <li><a href="{{ URL::route('forum-home') }}">Forums</a></li>
                    <li class="active">{{ $category->title }}</li>
                </ol>
                @if(Auth::check())
                <a href="{{ URL::route('forum-get-new-thread', $category->id) }}" class="btn btn-default">Voeg onderwerp toe</a>
                @endif

                <div class="panel panel-primary">
                    <div class="panel-heading">

                        @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="clearfix">
                            <h4 class="panel-title pull-left">{{ $category->title }}</h4>
                            <a href="{{ URL::route('forum-get-new-thread', $category->id) }}" class="btn btn-success btn-xs pull-right">Nieuw onderwerp</a>
                            <a id="{{ $category->id }}" href="#" data-toggle="modal" data-target="#category_delete" class="btn btn-danger btn-xs pull-right delete_category">Verwijder</a>
                        </div>
                        @else

                        <div class="clearfix">
                            <h3 class="panel-title pull-left">{{ $category->title }}</h3>
                            @if(Auth::user())
                            <a href="{{ URL::route('forum-get-new-thread', $category->id) }}" class="btn btn-success btn-xs pull-right">Nieuw onderwerp</a>
                            @endif
                        </div>
                        @endif


                    </div>
                    <div class="panel-body panel-list-group">
                        <div class="list-group">
                            @foreach($threads as $thread)
                            <a href="{{ URL::route('forum-thread', $thread->id) }}" class="list-group-item"><span style="text-decoration:underline">{{ $thread->title }}</span>
                                <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $thread->author_id)->first()->id}}.jpg">
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>

                                <span style="padding-top:300px;">{{ nl2br(BBCode::parse($thread->body)) }}</span>

                                <span class="pull-right">
                                    <h5>Verzonden door: {{$user = DB::table('users')->where('id', $thread->author_id)->first()->username}} op {{ $thread->created_at }}</h5>
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->isAdmin())
                <div class="modal fade" id="category_delete" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-dissen="true">&times;</span>
                                    <span class="sr-only">Sluiten</span>
                                </button>
                                <h4 class="modal-title">Verwijder categorie</h4>
                            </div>
                            <div class="modal-body">
                                <h3>Bent u zeker dat u deze categorie wenst te verwijderen?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Maak ongedaan</button>
                                <a href="" type="button" class="btn btn-primary" id="btn_delete_category">Verwijder</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/scrum/public/bootstrap/js/forumjs.js"></script>
@if(Session::has('modal'))
<script type="text/javascript">
$("{{Session::get('modal')}}").modal('show');
</script>
@endif
{{ HTML::script('http://code.jquery.com/jquery-2.1.1.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
@stop