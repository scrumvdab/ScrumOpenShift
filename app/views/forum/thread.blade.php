@extends('templates.default')
@section('content')
<div class="container" id="content">
    <?php
    $c = -1;
    $r = -1;
    $rr = -1;
    ?>
    <div class="navbar">
        <div class="jumbotron" style="overflow:auto;">
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
                    <!-- knop toevoegen comment aan thread (begin code)-->
                    <div id="form_thread">
                        @if(Auth::user())
                        <button type="button" class="btn btn-success" id="bo">Beantwoord onderwerp</button>
                        @endif
                        <!-- knop verwijder thread staat al hierboven
                        @if (Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ URL::route('forum-delete-thread', $thread->id) }}" class="btn btn-danger">Verwijder onderwerp</a>
                        @endif
                        -->
                    </div>
                    <!-- knop toevoegen comment aan thread (einde code)-->
                </div>

                <!-- commentaar geven op het onderwerp (begin code formulier)-->
                @if(Auth::check())
                <div id="formcomment" style="border:2px solid red; display:none;">
                    <form style="margin:10px;" action="{{ URL::route('forum-store-comment', $thread->id) }}" method="post">
                        <div class="form-group">
                            <label for="body">Body: </label>
                            <textarea class="form-control" name="body" id="body"></textarea>
                        </div>
                        {{ Form::token() }}
                        <div class="form-group">
                            <input type="submit" value="Bewaar commentaar" class="btn btn-primary">
                            <button type="button" class="btn btn-danger" id="formcommentannuleer">Annuleren</button>
                        </div>
                    </form>
                </div>
                @endif
                <!-- commentaar geven op het onderwerp (einde code formulier)-->

                <!-- begin tonen van de comments-->
                @foreach ($thread->comments()->get() as $comment)

                <div id="comment"  style="overflow:auto; border:1px solid orange;">
                    <div class="well" style="overflow:auto;">

                        <div class="pull-right">

                            <h4>Verzonden door: {{ $comment->author->username }} op {{ $comment->created_at }}</h4>
                            <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $comment->author_id)->first()->id}}.jpg"/>
                            <br>
                        </div>
                        <br>
                        <div style="" class="pull-right">
                            <a href="#">
                                <img class="like" onclick="Wijzigen('L{{ $comment->id }}')" id="L{{ $comment->id }}" style="border:1px red; height:40px; width:40px;" src='/Scrum/public/uploads/like.jpg'>
                            </a>
                            <br>
                            <h4 class="L{{ $comment->id }}">{{ $comment->like }}</h4>
                            <a href="#">
                                <img class="dislike" onclick="Wijzigen('D{{ $comment->id }}')" id="D{{ $comment->id }}" style="border:1px red; height:40px; width:40px;" src="/Scrum/public/uploads/dislike.jpg">
                            </a>
                            <br>
                            <h4 class="D{{ $comment->id }}">{{ $comment->dislike }}</h4>
                            <br>
                            <br>
                            <br>
                        </div>
                        <p style="<?php
                        if (nl2br(BBCode::parse($comment->body)) == '(verwijderd)') {
                            print("color:lightgrey");
                        } else {
                            print("color:black");
                        }
                        ?>
                           ">{{ nl2br(BBCode::parse($comment->body)) }}</p>
                        <!-- knoppen toevoegen reply aan comment/verwijderen comment (begin code)-->
                        <div class="form_comment">
                            @if(Auth::user())
                            <?php
                            if (isset($c)) {
                                $c++;
                                print("comment: " + $c);
                            }
                            ?>
                            <button type="button" data-klik="<?php print($c); ?>" class="btn btn-success bc">Beantwoord commentaar</button>
                            @endif
                            @if (Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ URL::route('forum-delete-comment', $comment->id) }}" class="btn btn-danger">Verwijder commentaar</a>
                            @endif
                        </div>
                        <!-- knoppen toevoegen reply /verwijderen comment (einde code)-->
                    </div>


                    <!-- tonen van de replies-->
                    <!-- reply geven op een comment (begin code formulier)-->
                    @if(Auth::check())
                    <div class="formreply" style="width:80%; float:right; border:2px solid purple;  display:none;">
                        <form style="overflow:auto; margin:10px;" action="{{ URL::route('forum-store-reply', $comment->id) }}" method="post">
                            <div class="form-group">
                                <label for="body">Body: </label>
                                <textarea class="form-control" name="body" id="body"></textarea>
                            </div>
                            {{ Form::token() }}
                            <div class="form-group">
                                <input type="submit" value="Bewaar reply" class="btn btn-primary">
                                <button type="button" class="btn btn-danger formreplyannuleer">Annuleren</button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <!-- reply geven op een comment (einde code formulier)-->

                    <!-- begin tonen van de replies-->
                    @foreach ($comment->replies()->get() as $reply)


                    <div id="reply">

                        <div class="well pull-right" style="overflow:auto; width:80%;">
                            <div class="pull-right">

                                <h4>Verzonden door: {{ $reply->author->username }} op {{ $reply->created_at }}</h4>
                                <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $reply->author_id)->first()->id}}.jpg"/>
                                <br>
                            </div>
                            <br>
                            <div style="" class="pull-right">
                                <a href="#">
                                    <img class="like" onclick="Wijzigen('L{{ $reply->id }}')" id="L{{ $reply->id }}" style="border:1px red; height:40px; width:40px;" src='/Scrum/public/uploads/like.jpg'>
                                </a>
                                <br>
                                <h4 class="L{{ $reply->id }}">{{ $reply->like }}</h4>
                                <a href="#">
                                    <img class="dislike" onclick="Wijzigen('D{{ $reply->id }}')" id="D{{ $reply->id }}" style="border:1px red; height:40px; width:40px;" src="/Scrum/public/uploads/dislike.jpg">
                                </a>
                                <br>
                                <h4 class="D{{ $reply->id }}">{{ $reply->dislike }}</h4>
                                <br>
                                <br>
                                <br>
                            </div>
                            <p style="<?php
                            if (nl2br(BBCode::parse($reply->body)) == '(verwijderd)') {
                                print("color:lightgrey");
                            } else {
                                print("color:black");
                            }
                            ?>
                               ">{{ nl2br(BBCode::parse($reply->body)) }}</p>
                            <!-- knoppen toevoegen replyreply aan reply/verwijderen reply (begin code)-->
                            <div class="form_reply">
                                @if(Auth::user())
                                <div class="">
                                    <?php
                                    if (isset($r)) {
                                        $r++;
                                        print("reply : " + $r);
                                    }
                                    ?>
                                    <button data-klik="<?php print($r); ?>" type="button" class="btn btn-success br">Beantwoord reply</button>
                                </div>
                                @endif
                                @if (Auth::check() && Auth::user()->isAdmin())
                                <div class="">
                                    <a href="{{ URL::route('forum-delete-reply', $reply->id) }}" class="btn btn-danger">Verwijder reply</a>

                                </div>
                                @endif
                            </div>
                            <!-- knoppen toevoegen replyreply aan reply/verwijderen reply (einde code)-->
                            <!-- reply geven op een reply (begin code formulier)-->
                            @if(Auth::check())
                            <div class="formreplyreply" style="width:60%; float:right; border:2px solid brown; display:none;">
                                <form style="overflow:auto; margin:10px;" action="{{ URL::route('forum-store-reply-reply', $reply->id) }}" method="post">
                                    <div class="form-group">
                                        <label for="body">Body: </label>
                                        <textarea class="form-control" name="body" id="body"></textarea>
                                    </div>
                                    {{ Form::token() }}
                                    <div class="form-group">
                                        <input type="submit" value="Bewaar reply reply" class="btn btn-primary">
                                        <button type="button" class="btn btn-danger formreplyreplyannuleer">Annuleren</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                            <!-- reply geven op een reply (einde code formulier)-->

                            <!-- begin tonen van de repliesreplies-->
                            @foreach ($reply->repliesreplies()->get() as $replyreply)

                            <div id="replyreply">
                                <div class="well pull-right" style="overflow:auto; width:60%;">
                                    <div class="pull-right">
                                        <?php
                                        if (isset($rr)) {
                                            $rr++;
                                            print($rr);
                                        }
                                        ?>
                                        <h4>Verzonden door: {{ $replyreply->author->username }} op {{ $replyreply->created_at }}</h4>
                                        <img style="border:1px red; height:100px; width:100px; float:right;" src="/Scrum/public/uploads/{{$user = DB::table('users')->where('id', $replyreply->author_id)->first()->id}}.jpg"/>
                                        <br>
                                    </div>
                                    <br>
                                    
                                    <div style="" class="pull-right">
                                        <a href="#">
                                            <img class="like" onclick="Wijzigen('L{{ $replyreply->id }}')" id="L{{ $replyreply->id }}" style="border:1px red; height:40px; width:40px;" src='/Scrum/public/uploads/like.jpg'>
                                        </a>
                                        <br>
                                        <h4 class="L{{ $replyreply->id }}">{{ $replyreply->like }}</h4>
                                        <a href="#">
                                            <img class="dislike" onclick="Wijzigen('D{{ $replyreply->id }}')" id="D{{ $replyreply->id }}" style="border:1px red; height:40px; width:40px;" src="/Scrum/public/uploads/dislike.jpg">
                                        </a>
                                        <br>
                                        <h4 class="D{{ $replyreply->id }}">{{ $replyreply->dislike }}</h4>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    
                                    <p style="<?php
                                    if (nl2br(BBCode::parse($replyreply->body)) == '(verwijderd)') {
                                        print("color:lightgrey");
                                    } else {
                                        print("color:black");
                                    }
                                    ?>
                                       ">{{ nl2br(BBCode::parse($replyreply->body)) }}</p>
                                    <!-- knoppen toevoegen replyreplyreply aan reply/verwijderen replyreply (begin code)-->
                                    <!-- geen reply reply reply by reply reply
                                    <div id="form_reply_reply">
                                    @if(Auth::user())
                                    <div class="">
                                        <a href="{{ URL::route('forum-store-reply-reply', $replyreply->id)}}" class="btn btn-success">Beantwoord reply reply</a>
                                    </div>
                                    @endif
                                    </div>
                                    -->
                                    <!-- knoppen toevoegen replyreplyreply aan reply/verwijderen replyreply (einde code)-->                                    
                                    @if (Auth::check() && Auth::user()->isAdmin())
                                    <div class="">
                                        <a href="{{ URL::route('forum-delete-reply-reply', $replyreply->id) }}" class="btn btn-danger">Verwijder reply reply</a>

                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <!-- einde tonen van de repliesreplies-->                      
                        </div>
                    </div>
                    @endforeach
                    <!-- einde tonen van de replies-->                    
                </div>
                @endforeach
                <!-- einde tonen van de comments-->  
            </div>
        </div>
    </div>
</div>

<script>
            function Wijzigen(id) {
            var a = document.getElementsByClassName(id);
                    console.log("a : " + a[0]);
                    console.log("id : " + id);
                    var idtest = id.replace('L', '');
                    console.log("idtest : " + idtest);
                    if (id = idtest)
            {
            Lweg = id.replace('L', '');
                    id = Lweg;
                    console.log("id na aanpassing: " + id);
                    idd = parseInt(id);
                    console.log("idd : " + idd);
                    console.log(window.location.href);
                    window.location.href = window.location.href;
<?php
DB::table('forum_comments')->where('id', 4)->increment('like');
?>
            }
            else {
            var a = document.getElementsByClassName('id');
                    console.log("a : " + a[0]);
                    console.log("id : " + id);
                    Dweg = id.replace('D', '');
                    console.log("Dweg : " + Dweg);
                    id = Dweg;
                    console.log("id na aanpassing: " + id);
                    idd = parseInt(id);
                    console.log("idd : " + idd);
<?php
DB::table('forum_comments')->where('id', 4)->increment('dislike');
?>
            }
            }
</script>

{{ HTML::script('http://code.jquery.com/jquery-2.1.1.min.js') }}
{{HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js')}}
@stop


