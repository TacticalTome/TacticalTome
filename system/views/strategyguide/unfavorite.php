<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?php echo $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large">You are no longer favoriting:</h1>
        <h3 class="fontTrebuchet"><?php echo $this->strategyGuide->getTitle(); ?> by <?php echo $this->author->getUsername(); ?></h3>
        <br>
        <p class="fontTrebuchet"><a data-color="yellow" href="<?php echo $this->game->getURL(); ?>"><?php echo $this->game->getName(); ?></a></p>
        <div class="spacer" data-size="medium"></div>
        <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?php echo $this->strategyGuide->getURL(); ?>');">Return</button>
    </div>
</div>