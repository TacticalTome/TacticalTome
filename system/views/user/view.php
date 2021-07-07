<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange"><?= $this->userProfile->getUsername(); ?></h1>
        <?php
            if ($this->userIsLoggedIn) {
                if ($this->user->isModerator() && $this->user->getId() != $this->userProfile->getId() && !$this->userProfile->isModerator()) {
                    if ($this->userProfile->isBanned()) {
                        ?>
                            <center><button data-color="green" onclick="toggleBan();">Unban</button></center>
                        <?php
                    } else {
                        ?>
                            <center ><button data-color="red" onclick="toggleBan();">Ban</button></center>
                        <?php
                    }
                }
            }
        ?>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;" id="changePasswordForm">
    <div class="content">
        <h1><?= $this->userProfile->getUsername(); ?>'s Strategy Guides</h1>
        <?php
            foreach ($this->userStrategyGuides as $strategyGuide) {
                $game = new \model\Game($this->database, $strategyGuide->getGameId());
                ?>
                    <div class="row" data-colcount="2">
                        <div class="column hideOnMobile">
                            <center>    
                                <div class="positionRelative hoverOverlayContainer cursorPointer" style="width: 350px; height: 200px;" onclick="gotoLink('<?= $game->getURL(); ?>');" title="<?= $game->getName(); ?>">
                                    <img alt="<?= $game->getName(); ?> Banner" src="<?= $game->getBannerUrl(); ?>" style="width: 100%; height: 100%;"></a>
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

            if (count($this->userStrategyGuides) == 0) {
                echo "<p class='fontVerdana'>" . $this->userProfile->getUsername() . " does not seem to have any strategy guides.</p>";
            }
        ?>
        <div class="spacer" data-size="large"></div>
        
        <h1><?= $this->userProfile->getUsername(); ?>'s Favorite Strategy Guides</h1>
        <?php
            foreach ($this->userFavoriteStrategyGuides as $strategyGuide) {
                $game = new \model\Game($this->database, $strategyGuide->getGameId());
                ?>
                    <div class="row" data-colcount="2">
                        <div class="column hideOnMobile">
                            <center>    
                                <div class="positionRelative hoverOverlayContainer cursorPointer" style="width: 350px; height: 200px;" onclick="gotoLink('<?= $game->getURL(); ?>');" title="<?= $game->getName(); ?>">
                                    <img alt="<?= $game->getName(); ?> Banner" src="<?= $game->getBannerUrl(); ?>" style="width: 100%; height: 100%;"></a>
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

            if (count($this->userFavoriteStrategyGuides) == 0) {
                echo "<p class='fontVerdana'>" . $this->userProfile->getUsername() . " does not seem to have favorited any strategy guides.</p>";
            }
        ?>
        <div class="spacer" data-size="large"></div>

        <h1><?= $this->userProfile->getUsername(); ?>'s Followed Games</h1>
        <?php
            foreach ($this->userFollowedGames as $game) {
                ?>
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
                <?php
            }

            if (count($this->userFollowedGames) == 0) {
                echo "<p class='fontVerdana'>" . $this->userProfile->getUsername() . " does not seem to follow any games.</p>";
            }
        ?>
    </div>
</div>

<?php
    if ($this->userIsLoggedIn) {
        if ($this->user->isModerator() && $this->user->getId() != $this->userProfile->getId() && !$this->userProfile->isModerator()) {
            ?>
                <script>
                    function toggleBan() {
                        if (confirm("Are you sure you want to toggle this user's ban?")) {
                            const reason = prompt("What is the reason?");
                            if (reason === "" || !reason) return;
                            $.ajax({
                                url: "<?= \URL; ?>ajax/toggleBan/",
                                data: {userID: <?= $this->userProfile->getId(); ?>, reason: reason},
                                type: "POST",
                                success: function(data) {
                                    alert(data);
                                    if (data == "The user has been banned" || data == "The user's ban has been removed") window.location.reload();
                                }
                            });
                        }
                    }
                </script>
            <?php
        }
    }
?>