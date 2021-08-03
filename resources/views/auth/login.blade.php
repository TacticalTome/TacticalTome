@extends("layouts.app")

@section("pageTitle", "Login")

@section("content")

<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%">
        <h1 class="fontTrebuchet textShadowLight colorOrange">Login</h1><br>

        <div id="outputContainer">
            @if($errors->any())
                <div class="output unselectable">{{ $errors->first() }}</div>
            @endif
        </div>

        <form action="{{ route("auth.login") }}" method="POST" autocomplete="off">
            @csrf
            <input type="email" name="email" placeholder="Email" id="email"><br><br>
            <input type="password" name="password" placeholder="Password" id="password"><br><br>
            <input type="checkbox" name="remember_me"><label class="fontTrebuchet" for="remember_me">Remember Me?</label><br><br>
            <input type="submit" name="login" value="Login" data-color="blue" id="submitLogin">
        </form>
    </div>
</div>

@endsection