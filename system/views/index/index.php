
<!--
    Landing Container
-->
<div class="landingContainer fullscreen positionRelative">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?= \WEBSITE_NAME; ?></h1>
        <p class="fontVerdana">An encyclopedia for game strategies, guides, tutorials, news, and more!</p>
    </div>
</div>

<!--
    Carousel
    THEME > dark
    CYCLE > true
-->
<div class="carousel unselectable hideOnMobile" id="carousel1" data-theme="dark" data-cycle="true">
    <div class="imageContainer" data-size="cover">
        <img alt="Gameplay of Stronghold Crusader HD" src="<?= URL; ?>/images/screenshot1.jpg" id="slide1" data-caption="caption1" alt="Screenshot #1">
        <img alt="Gameplay of Disciples II: Gallean's Return" src="<?= URL; ?>/images/screenshot2.jpg" id="slide2" data-caption="caption2" alt="Screenshot #2">
        <img alt="Gameplay of American Conquest: Fight Back" src="<?= URL; ?>/images/screenshot3.jpg" id="slide3" data-caption="caption3" alt="Screenshot #3">
        <img alt="Gameplay of Railroad Tycoon II" src="<?= URL; ?>/images/screenshot4.jpg" id="slide4" data-caption="caption4" alt="Screenshot #4">
        <img alt="Gameplay of Stronghold HD" src="<?= URL; ?>/images/screenshot5.jpg" id="slide5" data-caption="caption5" alt="Screenshot #5">
    </div>
    <div class="caption centered" id="caption1" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">Strategies</h4>
            <p class="fontVerdana">Upload and view strategies for any game.</p>
        </div>
    </div>
    <div class="caption" id="caption2" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">Guides</h4>
            <p class="fontVerdana">Upload and view guides for any game, and be rewarded for producing though-out and quality game guides.</p>
        </div>
    </div>
    <div class="caption" id="caption3" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">News</h4>
            <p class="fontVerdana">Find news regarding game updates, patches, etc. for any game.</p>
        </div>
    </div>
    <div class="caption" id="caption4" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">One place for everything</h4>
            <p class="fontVerdana">The one stop shop for all things regarding gaming strategies, guides, and news.</p>
        </div>
    </div>
    <div class="caption" id="caption5" data-center="true">
        <div class="content">
            <h4 class="fontTrebuchet colorOrange">Emphasis on old and new games alike</h4>
            <p class="fontVerdana">Want to know some strategies for an old game? Want to know some guides for a new game? This is your one stop shop for all of these.</p>
        </div>
    </div>
    <div id="navigateLeft"><</div>
    <div id="navigateRight">></div>
    <div id="positionIndicator"><span id="selected"></span></div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">Expository of Strategies</h1>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">Expository of Strategies</h1>
                <p class="fontVerdana">Find strategy guides that gamers like you have created. All strategy guides that users have written and submitted can be found here.</p>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">Colleciton of Guides & Tutorials</h1>
                <p class="fontVerdana">In <?= \WEBSITE_NAME; ?> you are able to view any guide or tutorial for any game. Users are able to create and view any guide for any game.</p>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">Colleciton of Guides & Tutorials</h1>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">News Station for Games</h1>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">News Station for Games</h1>
                <p class="fontVerdana"><?= \WEBSITE_NAME; ?> contains news for every game on our website. All newer games will have a news section allowing you to easy access to upcoming or past information regarding the game you play.</p>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>

        <h1 class="fontTrebuchet colorOrange lineWithWords">Most Popular Games</h1>
        <center>
            <div class="row hideOnMobile" data-colcount="2">
            <?php
                foreach($this->topGames as $game) {
                    ?>
                        <div class="column positionRelative hoverOverlayContainer cursorPointer" onclick="gotoLink('<?= $game->getURL(); ?>')" title="<?= $game->getName(); ?>" style="width: 16em; height: 8em;">
                            <img src="<?= $game->getBannerURL(); ?>" style="width: 100%; height: 100%;"></a>
                            <div class="hoverOverlay" style="width: 100%; height: 100%;"></div>
                        </div>
                    <?php
                }
            ?>
            </div>

            <ol class="hideOnDesktop" style="text-align: left;">
            <?php
                foreach($this->topGames as $game) {
                    ?>
                        <li class="fontVerdana"><a href="<?= $game->getURL(); ?>"><?= $game->getName(); ?></a></li>
                    <?php
                }
            ?>
            </ol>
        </center>

        <div class="spacer" data-size="large"></div>

        <h1 class="fontTrebuchet colorOrange lineWithWords">Today's Popular Strategy Guides</h1>
        <?php
            foreach($this->topStrategyGuides as $strategyGuide) {
                $game = new \model\Game($this->database, $strategyGuide->getGameId());
                ?>
                    <div class="row" data-colcount="2">
                        <div class="column hideOnMobile">
                            <center>    
                                <div class="positionRelative hoverOverlayContainer cursorPointer" style="width: 350px; height: 200px;" onclick="gotoLink('<?= $game->getURL(); ?>');" title="<?= $game->getName(); ?>">
                                    <img src="<?= $game->getBannerUrl(); ?>" style="width: 100%; height: 100%;"></a>
                                    <div class="hoverOverlay" style="width: 100%; height: 100%;"></div>
                                </div>
                            </center>
                        </div>
                        <div class="column">
                            <h1 class="fontTrebuchet"><a href="<?= $strategyGuide->getURL(); ?>"><?= $strategyGuide->getTitle(); ?></a></h1>
                            <p class="fontTrebuchet hideOnDesktop"><a href="<?= $game->getURL(); ?>"><?= $game->getName(); ?></a></p>
                            <p class="fontVerdana" data-fontsize="medium" style="overflow-wrap: break-word;"><?= $strategyGuide->getDescriptionSnippet(250); ?></p>
                        </div>    
                    </div>
                    <div class="spacer" data-size="mdeium"></div>
                <?php
            }
        ?>

        <div class="spacer" data-size="large"></div>
    </div>
</div>

<!--
    Script
-->
<script type="module">
    import {Carousel} from "<?= \URL; ?>javascript/framework/carousel.js";
    var carousel1 = new Carousel("carousel1");
    $("#navigateLeft").click(function(){
        carousel1.navigateLeft();
    });
    $("#navigateRight").click(function(){
        carousel1.navigateRight();
    });
    setInterval(function(){
        carousel1.cycle();
    }, 10000);
</script>