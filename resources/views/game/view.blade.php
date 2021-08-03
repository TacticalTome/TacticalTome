@extends ("layouts.app")

@section("pageTitle", $game->name)

@section("content")

<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('{{ $game->cover[array_rand($game->cover)] }}');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="medium">{{ $game->name }}</h1>
        <p class="fontVerdana">Followers: {{ $game->follows->count() }}</p>
        <p class="fontVerdana hideOnMobile">{{ substr($game->description, 0, 150) }} --</p>
        @auth
            @if (Auth::user()->isFollowingGame($game))
                <button data-color="darkblue" onclick="gotoLink('{{ route("strategyguide.create", $game->id) }}');">New Strategy Guide</button>
                <button data-color="red" onclick="gotoLink('{{ route("game.unfollow", $game->id) }}');">Unfollow</button>
            @else
                <button data-color="green" onclick="gotoLink('{{ route("game.follow", $game->id) }}');">Follow</button>
            @endif
        @endauth
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="spacer" data-size="medium"></div>

    <div class="content">
        <center>
            <img class="hideOnMobile" alt="{{ $game->name }} Banner" src="{{ $game->banner }}">
            <h1 class="fontTrebuchet">{{ $game->name }}</h1>
        </center>

        <p class="fontVerdana">{{ $game->description }}</p>
        <p class="fontVerdana"><b>Developer</b>: {{ $game->developer }}</p>
        <p class="fontVerdana"><b>Tags</b>: {{ implode(", ", $game->tags) }}</p>
        @if ($game->steamappid != 0)
            <p class="fontVerdana"><b>Steam link</b>: <a href="https://store.steampowered.com/app/{{ $game->steamappid }}" target="_blank">{{ $game->name }}</a></p>
            <p class="fontVerdana"><b>Current Players</b>: <span id="currentSteamPlayerCount">{{ number_format($currentPlayerCount) }}</span></p>
        @endif
        <hr>

        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">News</h3>
        @if ($game->steamappid == 0 || !$game->news) 
            <p class="fontVerdana">This game is not found on steam and therefore does not support a news section or the provided news section is not used for this specific game. However if you have any news you would like posted here, please contact us.</p>
        @else
            {!! count($steamNews) === 0 ? "<p class='fontVerdana'>This game doesn't have any steam news to display.</p>" : "" !!}
            <ol>
                @foreach (array_slice($steamNews, 0, 5) as $news)
                    <li class="fontVerdana"><a href="{{ $news["url"] }}">{{ $news["title"] }}</a></li>
                    <ul class='fontVerdana'>
                        <li>Posted by {{ $news["author"] }} on {{ \Carbon\Carbon::parse($news["date"])->format("D. F d, Y @ g:i A") }}</li>
                        <li>{{ $news["feedlabel"]; }}</li>
                    </ul><br>
                @endforeach
            </ol>
        @endif

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">Most Popular Strategy Guides</h3>
        {!! count($game->recentStrategyGuides) === 0 ? "<p class='fontVerdana'>There are currently no strategy guides to dsiplay. Fix this by creating one!</p>" : "" !!}
        <ol>
            @foreach ($topStrategyGuides as $strategyGuide)
                <li class="fontVerdana"><a href="{{ route("strategyguide.view", $strategyGuide->id) }}">{{ $strategyGuide->title }}</a></li>
                <ul class="fontVerdana">
                    <li>Posted by <a href="{{ route("user.profile", $strategyGuide->user->id) }}">{{ $strategyGuide->user->username }}</a> on {{ \Carbon\Carbon::parse($strategyGuide->created_at)->format("D. F d, Y @ h:i A") }}</li>
                    <li>{{ $strategyGuide->getPreview() }}</li>
                </ul>
            @endforeach
        </ol>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">Most Recent Strategy Guides</h3>
        {!! count($game->recentStrategyGuides) === 0 ? "<p class='fontVerdana'>There are currently no strategy guides to dsiplay. Fix this by creating one!</p>" : "" !!}
        <ol>
            @foreach ($game->recentStrategyGuides as $strategyGuide)
                <li class="fontVerdana"><a href="{{ route("strategyguide.view", $strategyGuide->id) }}">{{ $strategyGuide->title }}</a></li>
                <ul class="fontVerdana">
                    <li>Posted by <a href="{{ route("user.profile", $strategyGuide->user->id) }}">{{ $strategyGuide->user->username }}</a> on {{ \Carbon\Carbon::parse($strategyGuide->created_at)->format("D. F d, Y @ h:i A") }}</li>
                    <li>{{ $strategyGuide->getPreview() }}</li>
                </ul>
            @endforeach
        </ol>

        <div class="spacer" data-size="large"></div>

        <!-- Social Media Share Buttons -->
        <button data-color="blue" onclick="gotoLinkInNewTab('https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}');" title="Share on Facebook"><i class="fab fa-facebook"></i> Share</button>&emsp;
        <button data-color="blue" onclick="gotoLinkInNewTab('http://twitter.com/share?url={{ url()->full() }}')" title="Share on Twitter"><i class="fab fa-twitter"></i> Tweet</button>&emsp;
        <button data-color="blue" onclick="gotoLinkInNewTab('https://www.reddit.com/submit?title={{ $game->name }} - {{ config("app.name") }}&url={{ url()->full() }}');" title="Share on Reddit"><i class="fab fa-reddit-alien"></i> Share</button>

        <div class="spacer" data-size="large"></div>
    </div>
</div>

@endsection