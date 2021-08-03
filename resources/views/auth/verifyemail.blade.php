@extends("layouts.app")

@section("pageTitle", "Verify Email")

@section("content")

<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">You need to verify your email</h1>
        <p class="fontTrebuchet">While your email is not verified, you are not able to make strategy guides, comment, and submit steam games.</p>
        @guest
            <p class="fontTrebuchet">You must be <a href="{{ route("auth.login") }}">logged in</a>, in order to verify your account.</p>
        @endguest
    </div>
</div>

@endsection