<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%;">
        <h1 class="fontTrebuchet textShadowLight colorOrange">Login</h1><br>
        
        <br>
        <div id="outputContainer">
                <?php
                    for ($i = 0; $i < count($this->formErrors); $i++) {
                        $this->outputAlert($this->formErrors[$i]);
                    }
                ?>  
        </div>
        <br>

        <form action="<?= URL; ?>user/login/" method="POST" autocomplete="off" onsubmit="return validateLogin();">
            <input type="text" name="usernameOrEmail" placeholder="Username or Email" id="username"><br><br>
            <input type="password" name="password" placeholder="Password" id="password"><br><br>
            <input type="submit" name="login" value="Login" data-color="blue" id="submitLogin">
        </form>
    </div>
</div>