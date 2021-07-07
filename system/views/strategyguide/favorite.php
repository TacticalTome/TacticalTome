<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?= $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">You are now favoriting:</h1>
        <h3 class="fontTrebuchet"><?= $this->strategyGuide->getTitle(); ?> by <?= $this->author->getUsername(); ?></h3>
        <br>
        <p class="fontTrebuchet"><a data-color="yellow" href="<?= $this->game->getURL(); ?>"><?= $this->game->getName(); ?></a></p>
        <div class="spacer" data-size="medium"></div>
        <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?= $this->strategyGuide->getURL(); ?>');">Return</button>
    </div>
</div>