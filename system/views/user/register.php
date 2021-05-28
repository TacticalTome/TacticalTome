<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%;">
        <?php if (\ALLOW_REGISTRATION) { ?>
            <h1 class="fontTrebuchet textShadowLight colorOrange">Register</h1><br>

            <br>
            <div id="outputContainer">
                <?php
                    for ($i = 0; $i < count($this->formErrors); $i++) {
                        $this->output($this->formErrors[$i]);
                    }
                ?>
            </div>
            <br>

            <form action="<?php echo URL; ?>user/register/" method="POST" autocomplete="off" onsubmit="return validateRegister();">
                <input type="email" name="email" placeholder="Email" id="email"><br><br>
                <input type="text" name="username" placeholder="Username" id="username"><br><br>
                <input type="password" name="password" placeholder="Password" id="password"><br><br>
                <input type="password" name="confirmpassword" placeholder="Confirm Password" id="confirmpassword"><br><br>
                <p>By clicking register you acknowledge that you are 13 years of age or older.</p>
                <input type="submit" name="register" value="Register" data-color="blue" id="submitRegister">
            </form>
        <?php } else { ?>
            <div class="output unselectable">Sorry but registration is currently disabled.</div>
        <?php } ?>
    </div>
</div>