@extends("layouts.app")

@section("pageTitle", "Profile")

@section("content")

<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
            <h1 class="centerText fontAlfaSlabOne colorOrange">{{ $user->username; }}</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;" id="changePasswordForm">
    <div class="content">
        <h1>{{ $user->username }}'s Strategy Guides</h1>
        @foreach ($user->strategyGuides as $strategyGuide)
            <x-strategy-guide-thumbnail :strategyGuide="$strategyGuide" />
        @endforeach
        <div class="spacer" data-size="large"></div>

        <h1>{{ $user->username }}'s Favorite Strategy Guides</h1>
        @foreach ($user->favoriteStrategyGuides as $strategyGuide)
            <x-strategy-guide-thumbnail :strategyGuide="$strategyGuide" :showAuthor="true" />
        @endforeach
        <div class="spacer" data-size="large"></div>

        <h1>{{ $user->username }}'s Followed Games</h1>
        @foreach ($user->followedGames as $game)
            <x-game-display :game="$game" />
        @endforeach

        <div class="spacer" data-size="large"></div>
    </div>
</div>

@endsection