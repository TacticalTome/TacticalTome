@extends("layouts.app")

@section("pageTitle", "Explore")

@section("content")

<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Explore</h1>
        @auth
            @if ($routeName == "explore.recommended.offset")
                <p class="centerText fontVerdana"><a href="{{ route("explore.popular") }}" data-color="yellow">Switch to popular</a></p>
            @else
                <p class="centerText fontVerdana"><a href="{{ route("explore.recommended") }}" data-color="yellow">Switch to recommended</a></p>
            @endif
        @endauth
    </div>
</div>

<!--
    Content Container
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        @for ($i = 0; $i < 10; $i++)
            @isset($strategyGuides[$i])
                <x-strategy-guide-thumbnail :strategyGuide="$strategyGuides[$i]" :showAuthor="true" />
                <div class="spacer" data-size="medium"></div>
            @endisset

            @isset($games[$i])
                <x-game-display :game="$games[$i]" />
                <div class="spacer" data-size="medium"></div>
            @endisset
        @endfor

        <div class="spacer" data-size="medium"></div>

        <center>
            <p class="fontTrebuchet">Not seeing a game? Add it <a href="{{ route("steam.submitgame") }}">here</a>.</p>

            @if ($offset > 0)
                <button data-color="red" onclick="gotoLink('{{ route(Route::currentRouteName(), $offset-1) }}');">Previous</button>
            @endif
            <button data-color="green" onclick="gotoLink('{{ route(Route::currentRouteName(), $offset+1) }}');" style="margin-left: 10px;">Next</button>
        </center>

        <div class="spacer" data-size="medium"></div>
    </div>
</div>

@endsection