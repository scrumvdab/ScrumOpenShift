@extends('templates.default')

@section('content')
<!--begin inhoud-->

<!-- facebook like buttons -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }
    (document, 'script', 'facebook-jssdk'));
</script>
<!-- einde facebook buttons -->

<div class="container" id="content" style="min-height:700px">
    <figure id="carousel">
        <div class="jumbotron">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    @for ($i = 1; $i < 30; $i++)
                    <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">   
                    <div class="item active">
                        <img src="images/foto's WVA/0.jpg" alt="First slide">
                    </div>
                    @for ($i = 1; $i < 30; $i++)
                    <div class="item">
                        <img src="images/foto's WVA/{{ $i }}.jpg" alt="slide">
                    </div>
                    @endfor
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><img src="images/nav_arrow_L.png" alt="vorige foto" class="nav_icon_L" /></a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><img src="images/nav_arrow_R.png" alt="volgende foto" class="nav_icon_R" /></a>
            </div>
        </div> 
    </figure>
    <main>
        <div class="container content_home">
            <h1>Nieuws</h1>
            <div class="fb-like float_right" data-href="https://www.facebook.com/events/685580554852792/?fref=ts" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            <h2>Word onze vriend op Facebook!</h2>
            <p>Voeg 'WVA vzw' toe als vriend op Facebook om steeds van alle nieuwtjes op de hoogte te blijven! BENEFIETFEEST WVA Vzw</p>
            <p>Zoals je vast weet, veranderde WVA vzw onlangs van naam. Voortaan heten we niet langer Werkgroep Vorming en Aktie.</p>

            <p>Vanaf september 2014 zijn we 'Westhoek Vrijetijd Anders vzw' geworden. En met een nieuwe naam, gaat natuurlijk ook een feest gepaard! Daarom organiseert WVA vzw op zondag 26 oktober een heus Benefietfeest.</p>
            <p>Je kan hieronder het programma en alle nodige informatie terugvinden. Zie je liever de affiche? click dan <a href="https://www.facebook.com/events/685580554852792/?fref=ts" target="_blank">Hier</a></p>

            <h3>Van 12u tot 14u</h3>
            <ul>
                <li><p>Etentje met aperitief + keuzemenu + koffie voor 22 euro</p></li>
                <li><p>kinderen tot 12 jaar: 11 euro. In prijs inbegrepen:</p></li>
                <li><p>aperitief: cava of fruitsap</p></li>
                <li><p>vlees: varkenshaasje - kalkoen - cote à l’os</p></li>
                <li><p>sausen: béarnaisesaus, champignonsaus en pepersaus</p></li>
                <li><p>frietjes en kroketjes</p></li>
                <li><p>warme en koude groenten</p></li>
                <li><p>koffie</p></li>
            </ul>

            <h3>Doorlopend</h3>
            <ul>
                <li><p>kinderanimatie met springkasteel, grime, …</p></li>
                <li><p>verkoopsstandje met T-shirts, dekentjes, gadgets, …</p></li>
            </ul>
            <h3>Om 14 u</h3>
            <ul>
                <li><p>dessertbuffet en dansnamiddag met DJ Steve</p></li>
            </ul>

            <h3>Om 16 u</h3>
            <ul>
                <li><p>veiling van tweedehands hulpmiddelen voor mensen met beperking.</p></li>
                <li><p>De lijst van de te veilen materialen zal verschijnen in de kranten.</p></li>
            </ul>
            <br/>
            <p>Voor het etentje dient u vooraf in te schrijven !</p>
            <p>U kan eetkaarten en/of de veilinglijst komen ophalen op ons adres:</p>
            <p>WVA vzw, Rijselstraat 98 te Ieper</p>
            <p>of bestellen via mail info@wvavzw.be</p>
            <p>of telefoon: 057 215 535.</p>
            <p>Gelieve in te schrijven vóór 20 oktober 2014.</p>
            <p>Uw inschrijving voor de maaltijd is pas definitief na de ontvangst van</p>
            <p>betaling op het nummer BE03 4648 2101 1184 met de vermelding</p>
            <p>“maaltijd: …personen x €22 - … kinderen x €11”</p>
            <br/>  
            <p>U KAN OOK STEUNKAARTEN KOPEN VOOR 5 EURO</p>
            <p>DE OPBRENGST VAN DIT BENEFIETFEEST</p>
            <p>GAAT NAAR DE WERKING VAN WVA VZW</p>
            <br/>
            <p>Word zeker ook vriend van WVA vzw op <a href="https://www.facebook.com/events/685580554852792/?fref=ts" target="_blank">Facebook!</a> Daar kun je op de hoogte blijven van al onze activiteiten!</p>
            <p>Met steun van het <a href="http://www.vaph.be/vlafo/view/nl" target="_blank">Vlaams Agentschap voor personen met een beperking</a> en <a href="http://www.west-vlaanderen.be/Paginas/default.aspx" target="_blank">Provincie West-Vlaanderen.</a></p>
            <div class="float_center">
                <figure class="logo"><a href="http://www.vaph.be/vlafo/view/nl" target="_blank"><img src="images/vaph.jpg" alt="VAPH"/></a></figure>
                <figure class="logo"><a href="http://www.west-vlaanderen.be/Paginas/default.aspx" target="_blank"><img src="images/wvl.jpg" alt="wvl"/></a></figure>
            </div>
        </div>
    </main>
</div>



{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}

<script>
    $(document).ready(function () {
        $('.carousel').carousel({
            interval: 4000
        });
    });
</script>
<!--einde inhoud-->
@stop