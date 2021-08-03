@extends("layouts.app")

@section("pageTitle", "Register")

@section("content")

<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%">
        <h1 class="fontTrebuchet textShadowLight colorOrange">Register</h1><br>

        <div id="outputContainer">
            @if($errors->any())
                <div class="output unselectable">{{ $errors->first() }}</div>
            @endif
        </div>

        <form action="{{ route("auth.register") }}" method="POST" autocomplete="off">
            @csrf
            {!! app('captcha')->render(); !!}
            <input type="email" name="email" placeholder="Email" id="email">
            <input type="text" name="username" placeholder="Username" id="username"><br><br>
            <input type="password" name="password" placeholder="Password" id="password">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" id="confirmpassword"><br><br>
            <input type="submit" name="register" value="Register" data-color="blue" id="submitRegister">
        </form>
    </div>
</div>

@endsection