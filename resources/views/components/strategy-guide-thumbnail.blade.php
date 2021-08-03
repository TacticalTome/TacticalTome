<div class="row" data-colcount="2">
    <div class="column hideOnMobile">
        <center>    
            <x-game-banner :game="$strategyGuide->game" />
        </center>
    </div>
    <div class="column">
        <h1 class="fontTrebuchet"><a href="{{ route("strategyguide.view", $strategyGuide->id) }}">{{ $strategyGuide->title }}</a></h1>
        <p class="fontTrebuchet" data-fontsize="small">{{ \Carbon\Carbon::parse($strategyGuide->created_at)->format("D. F d, Y @ h:i A") }}</p>
        @if ($showAuthor)
            <p class="fontTrebuchet">By: <a href="{{ route("user.profile", $strategyGuide->user->id) }}" target="_blank">{{ $strategyGuide->user->username }}</a></p>
        @endif
        <p class="fontTrebuchet hideOnDesktop"><a href="{{ route("game.view", $strategyGuide->game->id) }}">{{ $strategyGuide->game->name }}</a></p>
        <p class="fontVerdana" data-fontsize="medium" style="overflow-wrap: break-word;">{{ substr(strip_tags($strategyGuide->content), 0, 250) }}</p>
    </div>    
</div>