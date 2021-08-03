@extends("layouts.app")

@section("pageTitle", "Contact")

@section("content")
<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Contact Us</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h1 class="fontTrebuchet">Our email: <a href="mailto:{{ env("MAIL_USERNAME") }}">{{ env("MAIL_USERNAME") }}</a></h1>
        <p class="fontVerdana">Please use the above email to ask us any questions or email us any concerns.</p>
    </div>
</div>
@endsection