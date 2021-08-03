<div class="column positionRelative hoverOverlayContainer cursorPointer" onclick="gotoLink('{{ route("game.view", $game->id) }}')" title="{{ $game->name }}" style="width: 16em; height: 8em;">
    <img src="{{ $game->banner }}" style="width: 100%; height: 100%;"></a>
    <div class="hoverOverlay" style="width: 100%; height: 100%;"></div>
</div>