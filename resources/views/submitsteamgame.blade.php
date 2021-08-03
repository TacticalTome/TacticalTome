@extends("layouts.app")

@section("pageTitle", "Submit a Steam Game")

@section("content")

<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%">
        <h1 class="fontTrebuchet textShadowLight colorOrange">Submit a Steam game</h1><br>
        <p class="fontVerdana">Want to write a strategy guide for a game, but don't see it? Here you are able to add the game to the Tactical Tome using it's steam store page link.</p>

        <div id="outputContainer">
            <div id="outputContainer">
                @if($errors->any())
                    <div class="output unselectable">{{ $errors->first() }}</div>
                @endif
            </div>
        </div>

        <form action="{{ route("steam.submitgame") }}" method="POST" autocomplete="off" onsubmit="return validateSubmitGame();">
            @csrf
            {!! app('captcha')->render(); !!}
            <input type="text" name="steamLink" placeholder="Steam Link" id="steamLink"><br><br>
            <input type="submit" data-color="blue" name="submitGame" value="Submit" id="submitGame">
        </form>
    </div>
</div>

@endsection