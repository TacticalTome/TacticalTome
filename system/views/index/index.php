
<!--
    Landing Container
-->
<div class="landingContainer fullscreen positionRelative">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?php echo \WEBSITE_NAME; ?></h1>
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
        <img src="<?php echo URL; ?>/images/screenshot1.jpg" id="slide1" data-caption="caption1" alt="Screenshot #1">
        <img src="<?php echo URL; ?>/images/screenshot2.jpg" id="slide2" data-caption="caption2" alt="Screenshot #2">
        <img src="<?php echo URL; ?>/images/screenshot3.jpg" id="slide3" data-caption="caption3" alt="Screenshot #3">
        <img src="<?php echo URL; ?>/images/screenshot4.jpg" id="slide4" data-caption="caption4" alt="Screenshot #4">
        <img src="<?php echo URL; ?>/images/screenshot5.jpg" id="slide5" data-caption="caption5" alt="Screenshot #5">
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

        <h1 class="fontTrebuchet colorOrange lineWithWords">Most Popular Games</h1>
        <center>
            <div class="row hideOnMobile" data-colcount="3">
            <?php
                $topGames = $this->database->query("SELECT * FROM games ORDER BY followers DESC LIMIT 6");
                while ($game = $topGames->fetch_assoc()) {
                    ?>
                        <div class="column positionRelative hoverOverlayContainer cursorPointer" onclick="gotoLink('<?php echo \URL . "game/view/" . $game['id'] . "/"; ?>');" title="<?php echo $game['name']; ?>">
                            <img src="<?php echo \URL; ?>images/banners/<?php echo $game['banner']; ?>" style="width: 16em; height: 8em;"></a>
                            <div class="hoverOverlay" style="width: 16em; height: 8em;"></div>
                        </div>
                    <?php
                }
            ?>
            </div>

            <ol class="hideOnDesktop" style="text-align: left;">
            <?php
                $topGames = $this->database->query("SELECT * FROM games ORDER BY followers DESC LIMIT 6");
                while ($game = $topGames->fetch_assoc()) {
                    ?>
                        <li class="fontVerdana"><a href="<?php echo \URL . "game/view/" . $game['id'] . "/"; ?>"><?php echo $game['name']; ?></a></li>
                    <?php
                }
            ?>
            </ol>
        </center>

        <hr data-color="black">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange centerHorizontalVertical hideOnMobile">Expository of Strategies</h1>
            </div>
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">Expository of Strategies</h1>
                <p class="fontVerdana">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla 
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <div class="row" data-colcount="2">
            <div class="column">
                <h1 class="fontTrebuchet colorOrange hideOnDesktop">Colleciton of Guides & Tutorials</h1>
                <p class="fontVerdana">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore 
                    veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni 
                    dolores eos qui ratione voluptatem sequi nesciunt.</p>
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
                <p class="fontVerdana">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et 
                    dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
            </div>
        </div>

        <div class="spacer" data-size="large"></div>
    </div>
</div>

<!--
    Script
-->
<script>
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