<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%;">
        <h1 class="fontTrebuchet textShadowLight colorOrange">Submit a Steam game</h1><br>
        <p class="fontVerdana">Want to write a strategy guide for a game, but don't see it? Here you are able to add the game to the <?= \WEBSITE_NAME; ?> using it's steam store page link.</p>
        
        <br>
        <div id="outputContainer">
                <?php
                    for ($i = 0; $i < count($this->formErrors); $i++) {
                        $this->outputAlert($this->formErrors[$i]);
                    }
                ?>  
        </div>
        <br>
        
        <form action="<?= URL; ?>game/submit/" method="POST" autocomplete="off" onsubmit="return validateSubmitGame();">
            <input type="text" name="steamLink" placeholder="Steam Link" id="steamLink"><br><br>
            <center><?= \utility\getReCaptchaFormHTML(); ?></center><br>
            <input type="submit" data-color="blue" name="submitGame" value="Submit" id="submitGame">
        </form>
    </div>
</div>