@extends("layouts.app")

@section("pageTitle", "FAQ")

@section("content")
<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Frequently Asked Questions</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h1 class="fontTrebuchet">FAQ</h1>
        <p class="fontVerdana">
            <b>Q:</b> How can I contribute to {{ config("app.name") }}?<br>
            <b>A:</b> You can contribute by visiting our <a href="{{ env("GITHUB_URL") }}" target="_blank">GitHub page</a>
        </p>

        <div class="spacer" data-size="medium"></div>

        <p class="fontTrebuchet">Have any questions? <a href="{{ route("about.contact") }}">Contact Us</a>.</p>
    </div>
</div>
@endsection