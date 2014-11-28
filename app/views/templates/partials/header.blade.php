<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Website Scrum</title>
        <meta name="keywords" content="wva"/>
        {{ HTML::style("bootstrap/css/bootstrap.min.css") }}
        {{ HTML::style("css/scrum.css") }}
        {{ HTML::style("bootstrap/js/bootstrap.min.js") }}
        {{ HTML::style("http://fonts.googleapis.com/css?family=Tangerine") }}
        {{ HTML::style ("css/livepreview-demo.css") }}
        {{ HTML::script("http://code.jquery.com/jquery.js") }}
        {{ HTML::script("js/jquery-live-preview.js") }}
    </head>
    <body>      
        <div id="wrapper">
            <header>
                <div class="container" id="header">
                    <div class="col-md-4 col-xs-4" id="geg">
                        <div class="pull-l contactgegevens">
                            <p>
                                Werkgroep Vorming en Aktie vzw<br>
                                Rijselstraat 98<br>
                                8900 Ieper<br>
                                Tel. 057/21.55.35<br>
                                E-mail: <a href="mailto:wva@telenet.be" class="navGroen">wva@telenet.be</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <img style="margin: 0 auto;" alt="logo Werkgroep Vorming en Aktie WVA" class="hidden-xs img-responsive" src="{{asset('images/logo.png')}}"/>
                    </div>
                    <div class="navbar pull-right">
                        <ul class="nav nav-pills nav-stacked">
                            @if(!Auth::check())
                            <li>{{ HTML::link('user/login', 'Aanmelden') }}</li> 
                            <li>{{ HTML::link('user/register', 'Registreren' ) }}</li> 
                            @else
                            <li>{{ HTML::link('user/logout', 'Afmelden') }}</li>
                            <li>{{ HTML::link('user/dashboard', 'Profiel') }}</li>
                            @endif
                        </ul>   
                    </div> 
                    <div class="col-md-2 col-xs-2" id="popup_warning">
                        @if(Session::has('message'))
                        <div class="alert alert-warning alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            {{ Session::get('message') }}
                        </div>
                        @endif
                    </div>
                </div>
                
            </header>

            <div class="container" id="navigation">
                <nav id="navbar" class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav" id="buttons">
                            <li>{{ HTML::clever_link("home", 'home' ) }}</li>
                            <li>{{ HTML::clever_link("activiteiten", 'activiteiten' ) }}</li>
                            <li>{{ HTML::clever_link("contact", 'contact' ) }}</li>
                            <li>{{ HTML::clever_link("vrijwilligers", 'vrijwilligers' ) }}</li>
                            <li>{{ HTML::clever_link("forum", 'forum' ) }}</li>
                            <li>{{ HTML::clever_link("giften", 'giften' ) }}</li>
                            <li>{{ HTML::clever_link("links", 'links' ) }}</li>
                            <li>{{ HTML::clever_link("PDF", 'PDF' ) }}</li>
                        </ul>
                    </div> 
                </nav>
            </div>
            <!---------------- EINDE HEADER EN KNOPPEN-------------------------------------- -->