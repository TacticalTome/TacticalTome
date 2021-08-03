@extends("layouts.app")

@section("pageTitle", "Favorite Strategy Guide")

@section("content")

<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('{{ $strategyGuide->game->cover[array_rand($strategyGuide->game->cover)] }}');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">You are now favoriting:</h1>
        <h3 class="fontTrebuchet">{{ $strategyGuide->title }} by {{ $strategyGuide->user->username }}</h3>
        <br>
        <p class="fontTrebuchet"><a data-color="yellow" href="{{ route("game.view", $strategyGuide->game->id) }}">{{ $strategyGuide->game->name }}</a></p>
        <div class="spacer" data-size="medium"></div>
        <button data-color="darkblue" data-size="medium" onclick="gotoLink('{{ route("strategyguide.view", $strategyGuide->id) }}');">Return</button>
    </div>
</div>

@endsection