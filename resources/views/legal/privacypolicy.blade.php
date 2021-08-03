@extends("layouts.app")

@section("pageTitle", "Privacy Policy")

@section("content")
<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Privacy Policy</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <p class="fontTrebuchet">Last Updated: June 16th, 2021</p>

        <h1 class="fontTrebuchet">Data We Collect</h1>
        <p class="fontVerdana">We only collect information that you provide. All information is either collected through forms or on button presses. We do not share any private information (see below) with any other third party services.</p>

        <div class="spacer" data-size="medium"></div>

        <h5 class="fontTrebuchet">Private information we collect</h5>
        <ol class="fontVerdana">
            <li>Email when you created an account. This is used to send an email to the user regarding changes to their account and strategy guides. Your email can be changed at any time under your Account and by filling out the Change Email form and confirming the decision in an email sent to your current email associated with your account before the change.</li>
            <li>The time you have last posted. This is used to prevent users from posting more than once an hour.</li>
            <li>We collect what strategy guides you have favorited. This is used to help the user easily go back to strategy guides they have favorited.</li>
            <li>We collect which games you have followed. This is used to recommend strategy guides to users on their recommended explore page.</li>
        </ol>

        <div class="spacer" data-size="medium"></div>
        
        <h5 class="fontTrebuchet">Publicly available information</h5>
        <ol class="fontVerdana">
            <li>Your username.</li>
            <li>Your posted strategy guides.</li>
            <li>Your favorited strategy guides.</li>
            <li>Your followed games.</li>
        </ol>
        <br>
        <p class="fontVerdana">Your email and the last time you have posted a strategy guide are all kept confidential and are not shared.</p>
    
        <div class="spacer" data-size="medium"></div>

        <h5 class="fontTrebuchet">Our Cookies</h5>
        <p class="fontVerdana">The only cookies we use specifically on our site are cookies that keep you logged in.</p>
    
        <div class="spacer" data-size="medium"></div>

        <p class="fontVerdana"><b>Our Privacy Policy may change with or without notice.</b></p>
    </div>
</div>
@endsection