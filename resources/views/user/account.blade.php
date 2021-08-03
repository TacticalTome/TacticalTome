@extends("layouts.app")

@section("pageTitle", "Account")

@section("content")

<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > LARGE
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Account</h1>
        <p class=" centerText fontVerdana"><a href="{{ route("user.profile", $user->id) }}" data-color="yellow">Your Profile</a></p>
        <center>
            <form action="{{ route("auth.logout") }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" data-color="red" data-length="long">Logout</button>
            </form>
            <button data-color="blue" data-length="long" id="changePasswordButton">Change Password</button>
            <button data-color="green" data-length="long" id="changeEmailButton">Change Email</button>
            <button data-color="darkblue" data-length="long" id="showStartegyGuides">View My Strategy Guides</button>
        </center>
    </div>
</div>

<div id="outputContainer">
    @if($errors->any())
        <div class="output unselectable">{{ $errors->first() }}</div>
    @endif
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto; display: none;" id="changePasswordForm">
    <div class="content">
        <div class="spacer" data-size="small"></div>
        <h1 class="fontTrebuchet">Change Password</h1>
        <form action="{{ route("user.account") }}" method="POST">
            @csrf
            <input type="password" name="password" placeholder="Old Password" id="password" data-border="true" /><br><br>
            <input type="password" name="new_password" placeholder="New Password" id="newpassword" data-border="true" /><br><br>
            <input type="password" name="new_password_confirmation" placeholder="Confirm New Password" id="confirmnewpassword" data-border="true" /><br><Br>
            <input type="submit" name="changepassword" value="Change Password" id="submitChangePassword" data-color="blue" />
        </form>
        <div class="spacer" data-size="small"></div>
    </div>
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto; display: none;" id="changeEmailForm">
    <div class="content">
        <div class="spacer" data-size="small"></div>
        <h1 class="fontTrebuchet">Change Email</h1>
        <p class="fontVerdana"><b>Current Email</b>: {{ $user->email }}</p>
        <form action="{{ route("user.account") }}" method="POST">
            @csrf
            <input type="email" name="new_email" placeholder="New Email" id="newemail" data-border="true" /><br><br>
            <input type="submit" name="changeemail" value="Change Email" id="submitChangeEmail" data-color="blue" />
        </form>
        <div class="spacer" data-size="small"></div>
    </div>
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto; display: none;" id="strategyGuides">
    <div class="content">
        <h1>My Strategy Guides</h1>
        @foreach ($user->strategyGuides as $strategyGuide)
            <x-strategy-guide-thumbnail :strategyGuide="$strategyGuide" />
            <div class="spacer" data-size="medium"></div>
        @endforeach
    </div>
</div>

@endsection

@push("scripts")
<script>
    $("#changePasswordButton").on("click", function(){
        if ($("#changeEmailForm").is(":visible")) $("#changeEmailForm").fadeOut();
        if ($("#strategyGuides").is(":visible")) $("#strategyGuides").fadeOut();
        $("#changePasswordForm").fadeToggle();
    });

    $("#changeEmailButton").on("click", function(){
        if ($("#changePasswordForm").is(":visible")) $("#changePasswordForm").fadeOut();
        if ($("#strategyGuides").is(":visible")) $("#strategyGuides").fadeOut();
        $("#changeEmailForm").fadeToggle();
    });

    $("#showStartegyGuides").on("click", function(){
        if ($("#changePasswordForm").is(":visible")) $("#changePasswordForm").fadeOut();
        if ($("#changeEmailForm").is(":visible")) $("#changeEmailForm").fadeOut();
        $("#strategyGuides").fadeToggle();
    });
</script>
@endpush