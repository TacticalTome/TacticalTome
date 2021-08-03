<div class="row hideOnMobile" data-colcount="2">
    <div class="column">
        <h5 class="fontTrebuchet colorOrange centerHorizontalVertical">{{ $game->name }}</h5>
    </div>
    <div class="column">
        <x-game-banner :game="$game" />
    </div>
</div>
<div class="hideOnDesktop">
    <h1><a href="{{ route("game.view", $game->id) }}">{{ $game->name }}</a></h1>
</div>