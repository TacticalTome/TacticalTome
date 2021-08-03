@extends ("layouts.app")

@section("pageTitle", "Search")

@section("content")

<!--
    Jumbotron
    theme          > dark
    stickynavabove > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Search</h1>
        <p class="fontTrebuchet">Searching for: {{ $searchQuery }}</p>
    </div>
</div>

<!--
    Content Container
    theme > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h3 class="fontTrebuchet">Results Found: {{ number_format($resultsFound) }}</h3>
        @if ($resultsFound == 0) 
            <p class="fontVerdana">There seems to be no results. Make sure you have spelled everything correctly and try using more broad terms/boraden your search.</p>
        @endif
        <div class="spacer" data-size="large"></div>

        @foreach ($relatedGames as $game)
            <h1 class="fontTrebuchet"><a href="{{ route("game.view", $game->id) }}">{{ $game->name }}</a></h1>
            <ul>
                <li class="fontVerdana">{{ $game->description }}</li>
            </ul>
        @endforeach

        {!! count($relatedGames) !== 0 ? "<div class='spacer' data-size='large'></div>" : "" !!}

        @foreach ($relatedStrategyGuides as $strategyGuide)
            <h1 class="fontTrebuchet"><a href="{{ route("strategyguide.view", $strategyGuide->id) }}">{{ $strategyGuide->title }}</a></h1>
            <p class="fontTrebuchet" data-fontsize="small">Posted by {{ $strategyGuide->user->username }} on {{ \Carbon\Carbon::parse($strategyGuide->created_at)->format("D. F d, Y @ g:i A") }}</p>
            <ul>
                <li class="fontVerdana">{{ $strategyGuide->getPreview() }}</li>
            </ul>
        @endforeach

        <div class="spacer" data-size="large"></div>

        <p class="fontTrebuchet">Not seeing a game? Add it <a href="{{ route("steam.submitgame") }}">here</a>.</p>
    </div>
</div>

@endsection