<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Account</h1>
        <center>
            <button data-color="red" data-length="long" id="logoutButton">Logout</button>
            <button data-color="blue" data-length="long" id="changePasswordButton">Change Password</button>
            <button data-color="green" data-length="long" id="changeEmailButton">Change Email</button>
        </center>
    </div>
</div>

<div id="outputContainer">
        <?php
            for ($i = 0; $i < count($this->formErrors); $i++) {
                $this->output($this->formErrors[$i]);
            }
        ?>  
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto; display: none;" id="changePasswordForm">
    <div class="content">
        <div class="spacer" data-size="small"></div>
        <h1 class="fontTrebuchet">Change Password</h1>
        <form action="<?php echo \URL; ?>user/account/" method="POST" onsubmit="return validateChangePassword();">
            <input type="password" name="password" placeholder="Old Password" id="password" data-border="true" /><br><br>
            <input type="password" name="newpassword" placeholder="New Password" id="newpassword" data-border="true" /><br><br>
            <input type="password" name="confirmnewpassword" placeholder="Confirm New Password" id="confirmnewpassword" data-border="true" /><br><Br>
            <input type="submit" name="changepassword" value="Change Password" id="submitChangePassword" data-color="blue" />
        </form>
        <div class="spacer" data-size="small"></div>
    </div>
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto; display: none;" id="changeEmailForm">
    <div class="content">
        <div class="spacer" data-size="small"></div>
        <h1 class="fontTrebuchet">Change Email</h1>
        <p class="fontVerdana"><b>Current Email</b>: <?php echo $this->user->getEmail(); ?></p>
        <form action="<?php echo \URL; ?>user/account/" method="POST" onsubmit="return validateChangeEmail();">
            <input type="email" name="newemail" placeholder="New Email" id="newemail" data-border="true" /><br><br>
            <input type="submit" name="changeemail" value="Change Email" id="submitChangeEmail" data-color="blue" />
        </form>
        <div class="spacer" data-size="small"></div>
    </div>
</div>

<script>
    $("#logoutButton").on("click", function(){
        window.location.href = "<?php echo \URL; ?>user/logout/";
    });

    $("#changePasswordButton").on("click", function(){
        if ($("#changeEmailForm").is(":visible")) $("#changeEmailForm").fadeOut();
        $("#changePasswordForm").fadeToggle();
    });

    $("#changeEmailButton").on("click", function(){
        if ($("#changePasswordForm").is(":visible")) $("#changePasswordForm").fadeOut();
        $("#changeEmailForm").fadeToggle();
    });
</script>