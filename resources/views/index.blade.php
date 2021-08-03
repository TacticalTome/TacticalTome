@extends("layouts.app")

@section("pageTitle", "Home")

@section("content")

<!--
    Landing Container
-->
<div class="landingContainer fullscreen positionRelative">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">Tactical Tome</h1>
        <p class="fontVerdana">An encyclopedia for game strategies, guides, tutorials, news, and more!</p>
    </div>
</div>

<!--
    Carousel
    THEME > dark
    CYCLE > true
-->
<div class="carousel unselectable hideOnMobile" id="carousel1" data-theme="dark" data-cycle="true">
    <div class="imageContainer" data-size="cover">
        <img alt="Gameplay of Stronghold Crusader HD" src="{{ asset("img/screenshot1.jpg") }}" id="slide1" data-caption="caption1" alt="Screenshot #1">
        <img alt="Gameplay of Disciples II: Gallean's Return" src="{{ asset("img/screenshot2.jpg") }}" id="slide2" data-caption="caption2" alt="Screenshot #2">
        <img alt="Gameplay of American Conquest: Fight Back" src="{{ asset("img/screenshot3.jpg") }}" id="slide3" data-caption="caption3" alt="Screenshot #3">
        <img alt="Gameplay of Railroad Tycoon II" src="{{ asset("img/screenshot4.jpg") }}" id="slide4" data-caption="caption4" alt="Screenshot #4">
        <img alt="Gameplay of Stronghold HD" src="{{ asset("img/screenshot5.jpg") }}" id="slide5" data-caption="caption5" alt="Screenshot #5">
    </div>
    <div class="caption centered" id="caption1" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">Strategies</h4>
            <p class="fontVerdana">Upload and view strategies for any game.</p>
        </div>
    </div>
    <div class="caption" id="caption2" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">Guides</h4>
            <p class="fontVerdana">Upload and view guides for any game, and be rewarded for producing though-out and quality game guides.</p>
        </div>
    </div>
    <div class="caption" id="caption3" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">News</h4>
            <p class="fontVerdana">Find news regarding game updates, patches, etc. for any game.</p>
        </div>
    </div>
    <div class="caption" id="caption4" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">One place for everything</h4>
            <p class="fontVerdana">The one stop shop for all things regarding gaming strategies, guides, and news.</p>
        </div>
    </div>
    <div class="caption" id="caption5" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">Emphasis on old and new games alike</h4>
            <p class="fontVerdana">Want to know some strategies for an old game? Want to know some guides for a new game? This is your one stop shop for all of these.</p>
        </div>
    </div>
    <div id="navigateLeft"><</div>
    <div id="navigateRight">></div>
    <div id="positionIndicator"><span id="selected"></span></div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">Expository of Strategies</h1>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">Expository of Strategies</h1>
                <p class="fontVerdana">Find strategy guides that gamers like you have created. All strategy guides that users have written and submitted can be found here.</p>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">Colleciton of Guides & Tutorials</h1>
                <p class="fontVerdana">In {{ config("app.name") }} you are able to view any guide or tutorial for any game. Users are able to create and view any guide for any game.</p>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">Colleciton of Guides & Tutorials</h1>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">News Station for Games</h1>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">News Station for Games</h1>
                <p class="fontVerdana">{{ config("app.name") }}  contains news for every game on our website. All newer games will have a news section allowing you to easy access to upcoming or past information regarding the game you play.</p>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>

        <h1 class="fontTrebuchet colorOrange lineWithWords">Most Popular Games</h1>
        <center>
            <div class="row hideOnMobile" data-colcount="2">
            @foreach ($topGames as $game)
                <x-game-banner :game="$game" />
            @endforeach
            </div>

            <ol class="hideOnDesktop" style="text-align: left;">
            @foreach ($topGames as $game)
                <li class="fontVerdana"><a href="{{ route("game.view", $game->id) }}">{{ $game->name }}</a></li>
            @endforeach
            </ol>
        </center>

        <div class="spacer" data-size="large"></div>

        <h1 class="fontTrebuchet colorOrange lineWithWords">Today's Popular Strategy Guides</h1>
        @foreach ($topStrategyGuides as $strategyGuide)
            <x-strategy-guide-thumbnail :strategyGuide="$strategyGuide" :showAuthor="true" />
        @endforeach
    </div>
</div>

@endsection

@push("scripts")
<script type="module">
    import {Carousel} from "{{ asset("js/framework/carousel.js") }}";
    var carousel1 = new Carousel("carousel1");
    $("#navigateLeft").click(function(){
        carousel1.navigateLeft();
    });
    $("#navigateRight").click(function(){
        carousel1.navigateRight();
    });
    setInterval(function(){
        carousel1.cycle();
    }, 10000);
</script>
@endpush