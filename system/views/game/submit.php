<div class="fullscreen">
    <div class="centerHorizontalVertical centerText" style="width: 50%;">
        <h1 class="fontTrebuchet textShadowLight colorOrange">Submit a Steam game</h1><br>
        
        <br>
        <div id="outputContainer">
                <?php
                    for ($i = 0; $i < count($this->formErrors); $i++) {
                        $this->output($this->formErrors[$i]);
                    }
                ?>  
        </div>
        <br>
        
        <form action="<?php echo URL; ?>game/submit/" method="POST" autocomplete="off" onsubmit="return validateSubmitGame();">
            <input type="text" name="steamLink" placeholder="Steam Link" id="steamLink"><br><br>
            <input type="submit" data-color="blue" name="submitGame" value="Submit" id="submitGame">
        </form>
    </div>
</div>