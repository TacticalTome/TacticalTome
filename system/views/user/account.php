<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Account</h1>
        <center>
            <button data-color="red" data-length="long" id="logoutButton">Logout</button>
            <button data-color="blue" data-length="long" id="changePasswordButton">Change Password</button>
            <button data-color="green" data-length="long" id="changeEmailButton">Change Email</button>
            <button data-color="darkblue" data-length="long" id="showStartegyGuides">View My Strategy Guides</button>
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

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto; display: none;" id="strategyGuides">
    <div class="content">
        <h1>My Strategy Guides</h1>
        <?php
            for ($i = 0; $i < count($this->userStrategyGuides); $i++) {
                ?>
                    <div class="row" data-colcount="2">
                        <div class="column hideOnMobile">
                            <center>    
                                <div class="positionRelative hoverOverlayContainer cursorPointer" style="width: 350px; height: 200px;" onclick="gotoLink('<?php echo \URL . "game/view/" . $this->userStrategyGuidesGames[$i]->getId() . "/"; ?>');" title="<?php echo $this->userStrategyGuidesGames[$i]->getName(); ?>">
                                    <img src="<?php echo $this->userStrategyGuidesGames[$i]->getBannerUrl(); ?>" style="width: 100%; height: 100%;"></a>
                                    <div class="hoverOverlay" style="width: 100%; height: 100%;"></div>
                                </div>
                            </center>
                        </div>
                        <div class="column">
                            <h1 class="fontTrebuchet"><a href="<?php echo \URL; ?>game/strategyguide/<?php echo $this->userStrategyGuides[$i]->getId(); ?>/"><?php echo $this->userStrategyGuides[$i]->getTitle(); ?></a></h1>
                            <p class="fontTrebuchet hideOnDesktop"><a href="<?php echo \URL; ?>game/view/<?php echo $this->userStrategyGuidesGames[$i]->getId(); ?>"><?php echo $this->userStrategyGuidesGames[$i]->getName(); ?></a></p>
                            <p class="fontVerdana" data-fontsize="medium" style="overflow-wrap: break-word;"><?php echo $this->userStrategyGuides[$i]->getDescriptionSnippet(250); ?></p>
                        </div>    
                    </div>
                    <div class="spacer" data-size="medium"></div>
                <?php
            }
        ?>
    </div>
</div>

<script>
    $("#logoutButton").on("click", function(){
        window.location.href = "<?php echo \URL; ?>user/logout/";
    });

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