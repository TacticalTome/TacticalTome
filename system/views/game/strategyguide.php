<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?php echo $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?php echo $this->strategyGuide->getTitle(); ?></h1>
        <p class="fontTrebuchet"><a data-color="yellow" href="<?php echo \URL . "game/view/" . $this->game->getId() . "/"; ?>"><?php echo $this->game->getName(); ?></a></p>
        <p class="fontTrebuchet"><b>By: <?php echo $this->author->getUsername(); ?> on <?php echo date("D. F d, Y @ g:i A", $this->strategyGuide->getTimeCreated()); ?></b></p>
        <p class="fontVerdana hideOnMobile"><?php echo $this->strategyGuide->getPreview(); ?></p>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <div class="spacer" data-size="medium"></div>

        <h1><?php echo $this->strategyGuide->getTitle(); ?></h1>
        <p><?php echo $this->strategyGuide->getContent(); ?></h1>

        <div class="spacer" data-size="medium"></div>

        <?php if ($this->userIsLoggedIn) { ?>
            <?php if ($this->user->getId() == $this->author->getId()) { ?>
                <button data-color="green" onclick="gotoLink('<?php echo \URL . "game/editstrategyguide/" . $this->strategyGuide->getId() . "/"; ?>');">Edit</button>
                <button data-color="red" onclick="deleteStrategyGuide();">Delete</button>
            <?php } else { ?>
                <?php if ($this->user->isStrategyGuideFavorite($this->strategyGuide->getId())) { ?>
                    <button data-color="red" onclick="gotoLink('<?php echo \URL . "game/unfavorite/" . $this->strategyGuide->getId() . "/"; ?>');" title="Removes this post from your favorites"><i class="fas fa-star"></i> Unfavorite</button>
                <?php } else { ?>
                    <button data-color="yellow" onclick="gotoLink('<?php echo \URL . "game/favorite/" . $this->strategyGuide->getId() . "/"; ?>');" title="Makes this post one of your favorites! Also helps promote this guide to others"><i class="fas fa-star"></i> Favorite</button>
                <?php } ?>
            <?php } ?>
            <div class="spacer" data-size="medium"></div>
        <?php } ?>
    </div>
</div>

<script>
    function deleteStrategyGuide() {
        if (confirm("Are you sure you want to delete this strategy guide?\n\nThis will not be able to be reverted")) {
            $.ajax({ url: "<?php echo URL; ?>ajax/deletestrategyguide/",
                    data: {strategyGuideID: <?php echo $this->strategyGuide->getId(); ?>},
                    type: "POST",
                    success: function(data) {
                        alert(data);
                        if (data == "Successfully deleted") window.location.href = "<?php echo \URL . "game/view/" . $this->game->getId() . "/"; ?>";
                    }
            });
        }
    }
</script>