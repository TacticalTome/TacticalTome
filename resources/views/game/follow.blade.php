@extends("layouts.app")

@section("pageTitle", "Follow Game")

@section("content")

<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('{{ $game->cover[array_rand($game->cover)] }}');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">You are now following:</h1>
        <h3 class="fontTrebuchet">{{ $game->name }}</h3>
        <div class="spacer" data-size="medium"></div>
        <button data-color="darkblue" data-size="medium" onclick="gotoLink('{{ route("game.view", $game->id) }}');">Return</button>
    </div>
</div>

@endsection