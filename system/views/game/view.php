<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?= $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="medium"><?= $this->game->getName(); ?></h1>
        <p class="fontVerdana">Followers: <?= number_format($this->game->getFollowers()); ?></p>
        <p class="fontVerdana hideOnMobile"><?= $this->game->getShortDescription(); ?></p>

        <?php if ($this->userIsLoggedIn) { ?>
            <?php if ($this->user->isFollowingGame($this->game->getId())) { ?>
                <button data-color="red" data-size="medium" title="Remove this game to your feed" onclick="gotoLink('<?= \URL . "game/unfollow/" . $this->game->getId() . "/"; ?>');">Unfollow</button>
                <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?= $this->game->getNewStrategyGuideURL(); ?>');">New Strategy Guide</button>
            <?php } else { ?>
                <button data-color="green" data-size="medium" title="Add this game to your feed" onclick="gotoLink('<?= \URL . "game/follow/" . $this->game->getId() . "/"; ?>');">Follow</button>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <div class="spacer" data-size="medium"></div>

        <center>
            <img class="hideOnMobile" alt="<?= $this->game->getName(); ?> Banner" src="<?= $this->game->getBannerURL(); ?>">
            <h1 class="fontTrebuchet"><?= $this->game->getName(); ?></h1>
        </center>
        <p class="fontVerdana"><?= $this->game->getDescription(); ?></p>
        <p class="fontVerdana"><b>Developer</b>: <?= $this->game->getDeveloper(); ?></p>
        <p class="fontVerdana"><b>Tags</b>: 
            <?php
                for ($i = 0; $i < count($this->game->getTags()); $i++) {
                    if ($i != 0) echo ", ";
                    echo $this->game->getTags()[$i];
                }
            ?>
        </p>
        <?php if ($this->game->getSteamAppId() != 0) { ?>
            <p class="fontVerdana"><b>Steam link</b>: <a href="https://store.steampowered.com/app/<?= $this->game->getSteamAppId(); ?>/" target="_blank"><?= $this->game->getName(); ?></a></p>
            <p class="fontVerdana"><b>Who's Playing</b>: <span id="currentSteamPlayerCount"><?= $this->game->getCurrentSteamPlayers(); ?></span> players</p>
        <?php } ?>
        <hr>

        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">News</h3>
        <?php if ($this->game->hasNews()) { ?>
            <ol id="gameNewsContainer">
                <?php
                    $index = 0;
                    $steamNewsArticles = $this->game->getSteamNews();
                    foreach ($steamNewsArticles as $news) {
                        if ($index > 4) break;
                        ?>
                            <li class="fontVerdana"><a href="<?= $news["url"]; ?>"><?= $news["title"]; ?></a></li>
                            <ul class='fontVerdana'>
                                <li>Posted by <?= $news["author"] ?> on <?= date("D. F d, Y @ g:i A", $news["date"]); ?></li>
                                <li><?= $news["feedlabel"]; ?></li>
                            </ul><br>
                        <?php
                        $index++;
                    }
                ?>
            </ol>
        <?php } else { ?>
            <p class="fontVerdana">This game is not found on steam and therefore does not support a news section or the provided news section is not used for this specific game. However if you have any news you would like posted here, please contact us.</p>
        <?php } ?>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">Most Popular Strategy Guides</h3>
        <ol>
        <?php
            foreach ($this->popularStrategyGuides as $strategyGuide) {
                $author = new \model\User($this->database, $strategyGuide->getUserId());

                ?>
                    <li class="fontVerdana"><a href="<?= $strategyGuide->getURL(); ?>"><?= $strategyGuide->getTitle(); ?></a></li>
                    <ul class='fontVerdana'>
                        <li>Posted by <a href="<?= $author->getProfileURL(); ?>"><?= $author->getUsername(); ?></a> on <?= date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()); ?></li>
                        <li><?= $strategyGuide->getPreview(); ?></li>
                    </ul><br>
                <?php
            }
        ?>
        </ol>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">Most Recent Strategy Guides</h3>
        <ol>
        <?php
            foreach ($this->recentStrategyGuides as $strategyGuide) {
                $author = new \model\User($this->database, $strategyGuide->getUserId());

                ?>
                    <li class="fontVerdana"><a href="<?= $strategyGuide->getURL(); ?>"><?= $strategyGuide->getTitle(); ?></a></li>
                    <ul class='fontVerdana'>
                        <li>Posted by <a href="<?= $author->getProfileURL(); ?>"><?= $author->getUsername(); ?></a> on <?= date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()); ?></li>
                        <li><?= $strategyGuide->getPreview(); ?></li>
                    </ul><br>
                <?php
            }
        ?>
        </ol>

        <div class="spacer" data-size="large"></div>

        <?php 
            echo \utility\getFacebookShareButton() . "&emsp;"; 
            echo \utility\getTwitterShareButton() . "&emsp;";
            echo \utility\getRedditShareButton($this->pageTitle);
        ?>

        <div class="spacer" data-size="large"></div>
    </div>
</div>