<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?= $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">You are no longer following:</h1>
        <h3 class="fontTrebuchet"><?= $this->game->getName(); ?></h3>
        <div class="spacer" data-size="medium"></div>
        <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?= $this->game->getURL(); ?>');">Return</button>
    </div>
</div>