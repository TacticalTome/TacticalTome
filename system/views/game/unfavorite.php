<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?php echo $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">You are no longer favoriting:</h1>
        <h3 class="fontTrebuchet"><?php echo $this->strategyGuide->getTitle(); ?></h3>
        <div class="spacer" data-size="medium"></div>
        <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?php echo \URL . "game/view/" . $this->game->getId() . "/"; ?>');">Return</button>
    </div>
</div>