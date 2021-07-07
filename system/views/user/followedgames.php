<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Followed Games</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <?php foreach ($this->followedGames as $game) { ?>
            <div class="row hideOnMobile" data-colcount="2">
                <div class="column">
                    <h5 class="fontTrebuchet colorOrange centerHorizontalVertical"><?= $game->getName(); ?></h5>
                </div>
                <div class="column">
                    <div class="positionRelative hoverOverlayContainer cursorPointer" onclick="gotoLink('<?= $game->getURL(); ?>');" title="<?= $game->getName(); ?>">
                        <img alt="<?= $game->getName(); ?> Banner" src="<?= $game->getBannerUrl(); ?>" style="width: 16em; height: 8em;"></a>
                        <div class="hoverOverlay" style="width: 16em; height: 8em;"></div>
                    </div>
                </div>
            </div>
            <div class="hideOnDesktop">
                <h1><a href="<?= $game->getURL(); ?>"><?= $game->getName(); ?></a></h1>
            </div>
        <?php } ?>
    </div>
</div>