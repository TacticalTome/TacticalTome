<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?= $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?= $this->strategyGuide->getTitle(); ?></h1>
        <p class="fontTrebuchet"><a data-color="yellow" href="<?php $this->game->getURL(); ?>"><?= $this->game->getName(); ?></a></p>
        <p class="fontTrebuchet"><b>By: <a href="<?= $this->author->getProfileURL(); ?>" data-color="yellow"><?= $this->author->getUsername(); ?></a> on <?= date("D. F d, Y @ g:i A", $this->strategyGuide->getTimeCreated()); ?></b></p>
        <p class="fontVerdana hideOnMobile"><?= $this->strategyGuide->getPreview(); ?></p>
        <?php
            if ($this->userIsLoggedIn) {
                if ($this->user->isModerator()) {
                    ?>
                        <button data-color="red" onclick="forceDeleteStrategyGuide();">Delete (Moderator)</button>
                    <?php
                }
            }
        ?>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <div class="spacer" data-size="medium"></div>

        <h1><?= $this->strategyGuide->getTitle(); ?></h1>
        <p><?= $this->strategyGuide->getContent(); ?></h1>
        
        <div class="spacer" data-size="small"></div>
        

        <?php 
            echo \utility\getFacebookShareButton() . "&emsp;"; 
            echo \utility\getTwitterShareButton() . "&emsp;";
            echo \utility\getRedditShareButton($this->pageTitle);
        ?>

        <div class="spacer" data-size="medium"></div>

        <?php if ($this->userIsLoggedIn) { ?>
            <?php if ($this->user->getId() == $this->author->getId()) { ?>
                <button data-color="green" onclick="gotoLink('<?= $this->strategyGuide->getEditURL(); ?>');">Edit</button>
                <button data-color="red" onclick="deleteStrategyGuide();">Delete</button>
            <?php } else { ?>
                <?php if ($this->user->isStrategyGuideFavorite($this->strategyGuide->getId())) { ?>
                    <button data-color="red" onclick="gotoLink('<?= $this->strategyGuide->getUnfavoriteURL(); ?>');" title="Removes this post from your favorites"><i class="fas fa-star"></i> Unfavorite</button>
                <?php } else { ?>
                    <button data-color="yellow" onclick="gotoLink('<?= $this->strategyGuide->getFavoriteURL(); ?>');" title="Makes this post one of your favorites! Also helps promote this guide to others"><i class="fas fa-star"></i> Favorite</button>
                <?php } ?>
            <?php } ?>
            <div class="spacer" data-size="medium"></div>
        <?php } ?>
    </div>
</div>

<?php
    if ($this->userIsLoggedIn) {
        if ($this->user->getId() == $this->strategyGuide->getUserId()) {
            ?>
                <script>
                    function deleteStrategyGuide() {
                        if (confirm("Are you sure you want to delete this strategy guide?\n\nThis will not be able to be reverted")) {
                            $.ajax({ url: "<?= URL; ?>ajax/deletestrategyguide/",
                                    data: {strategyGuideID: <?= $this->strategyGuide->getId(); ?>},
                                    type: "POST",
                                    success: function(data) {
                                        alert(data);
                                        if (data == "Successfully deleted") window.location.href = "<?= $this->game->getURL(); ?>";
                                    }
                            });
                        }
                    }
                </script>
            <?php
        }

        if ($this->user->isModerator()) {
            ?>
                <script>
                    function forceDeleteStrategyGuide() {
                        if (confirm("Are you sure you want delete this strategy guide?\n\nThis is not reversible!")) {
                            const reason = prompt("What is the reason?");
                            if (reason === "" || !reason) return;
                            $.ajax({
                                url: "<?= \URL; ?>ajax/forceDeleteStrategyGuide/",
                                data: {strategyGuideID: <?= $this->strategyGuide->getId(); ?>, reason: reason},
                                type: "POST",
                                success: function(data) {
                                    alert(data);
                                    if (data == "Successfully deleted") window.location.href = "<?= $this->game->getURL(); ?>";
                                }
                            });
                        }
                    }
                </script>
            <?php
        }
    }
?>