<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?php echo $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?php echo $this->game->getName(); ?></h1>
        <p class="fontVerdana hideOnMobile"><?php echo $this->game->getDescription(); ?></p>

        <?php if ($this->userIsLoggedIn) { ?>
            <?php if ($this->user->isFollowingGame($this->game->getId())) { ?>
                <button data-color="red" data-size="medium" title="Remove this game to your feed" onclick="gotoLink('<?php echo \URL . "game/unfollow/" . $this->game->getId() . "/"; ?>');">Unfollow</button>
                <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?php echo \URL . "game/newstrategyguide/" . $this->game->getId() . "/"; ?>');">New Strategy Guide</button>
            <?php } else { ?>
                <button data-color="green" data-size="medium" title="Add this game to your feed" onclick="gotoLink('<?php echo \URL . "game/follow/" . $this->game->getId() . "/"; ?>');">Follow</button>
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
            <img class="hideOnMobile" src="<?php echo $this->game->getBannerURL(); ?>">
            <h1 class="fontTrebuchet"><?php echo $this->game->getName(); ?></h1>
        </center>
        <p class="fontVerdana"><?php echo $this->game->getDescription(); ?></p>
        <p class="fontVerdana"><b>Tags</b>: 
            <?php
                for ($i = 0; $i < count($this->game->getTags()); $i++) {
                    if ($i != 0) echo ", ";
                    echo $this->game->getTags()[$i];
                }
            ?>
        </p>
        <hr>

        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">News</h3>
        <?php if ($this->game->hasNews()) { ?>
        <?php } else { ?>
            <p class="fontVerdana">This game is older and therefore there is no news section supported for this game, due to an absence of news. However if you do have any news you would like posted here please 
                contact us.</p>
        <?php } ?>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">Most Popular Strategy Guides</h3>

        <div class="spacer" data-size="large"></div>
        <hr data-length="short">
        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">Most Recent Strategy Guides</h3>
        <ol>
        <?php
            $recentPosts = $this->database->query("SELECT * FROM strategyguides WHERE gid='".$this->game->getId()."' ORDER BY timecreated DESC LIMIT 10");
            while ($post = $recentPosts->fetch_assoc()) {
                $strategyGuide = new \model\StrategyGuide($this->database, $post['id']);
                $user = new \model\User($this->database, $strategyGuide->getUserId());

                echo "<li class='fontVerdana'><a href='" . \URL . "game/strategyguide/" . $strategyGuide->getid() . "/'>" . $strategyGuide->getTitle() . "</a></li>";
                echo "<ul class='fontVerdana'>";
                echo "<li>Posted by " . $user->getUsername() . " on " . date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()) . "</li>";
                echo "<li>" . $strategyGuide->getPreview() . "</li>";
                echo "</ul>";
                echo "<br>";
            }
        ?>
        </ol>

        <div class="spacer" data-size="large"></div>
    </div>
</div>