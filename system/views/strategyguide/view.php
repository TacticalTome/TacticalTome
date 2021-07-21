<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?= $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?= $this->strategyGuide->getTitle(); ?></h1>
        <p class="fontTrebuchet"><a data-color="yellow" href="<?= $this->game->getURL(); ?>"><?= $this->game->getName(); ?></a></p>
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

        <h2 class="fontTrebuchet" id="comments">Comments</h2>
        <hr>
        <ul>
        <?php
            if (!empty($this->allReplies)) {
                foreach ($this->allReplies as $reply) {
                    $author = new \model\User($this->database, $reply->getUserId());
                    ?>
                        <li>
                            <h5 class="fontTrebuchet"><a href="<?= $author->getProfileURL(); ?>"><?= $author->getUsername(); ?></a></h5>
                            <p class="fontTrebuchet" data-fontsize="small"><?= date("D. F d, Y @ g:i A", $reply->getTimeCreated()); ?></p>
                            <p class="fontVerdana"><?= $reply->getContent(); ?></p>
                            <?php if ($this->userIsLoggedIn) { ?>
                                <div class="linkButton fontTrebuchet" data-fontsize="small" data-float="left" onclick="openReplyContainer('<?= $reply->getId(); ?>');">Reply</div>
                                <?php if ($this->user->getId() == $author->getId()) { ?>
                                    <div class="linkButton fontTrebuchet" style="margin-left: 10px;" data-fontsize="small" data-float="left" onclick="deleteReply('<?= $reply->getId(); ?>');">Delete</div>
                                <?php } ?>
                                <?php if ($this->user->isModerator()) { ?>
                                <div class="linkButton fontTrebuchet" style="margin-left: 10px;" data-fontsize="small" data-float="left" onclick="forceDeleteReply('<?= $reply->getId(); ?>');">Force Delete</div>
                                <?php } ?>
                                <div style="clear: both;"></div>
                            <?php } ?>
                        </li>
                    <?php
                }
            } else {
                echo "<p class='fontVerdana'>There currently are no comments</p>";
            }
        ?>
        </ul>
        <div class="spacer" data-size="medium"></div>
        <?php if ($this->userIsLoggedIn) { ?>
            <button class="simple" data-color="green" id="showReplyContainer">Reply</button> 
        <?php } else { ?>
            <p class="fontVerdana">You must be <a href="<?= \URL; ?>user/login/" target="_blank">logged in</a> to reply.</p>
        <?php } ?>
        <div class="spacer" data-size="medium"></div>
    </div>
</div>

<!--
    Reply Container
-->
<div class="blurEntireBackground" id="replyContainer" data-theme="dark" style="display: none;">
    <div class="centerHorizontalVertical backgroundWhite roundedCorners centerText" style="padding: 2%;">
        <h1 class="fontTrebuchet">Reply</h1>
        <input name="replyContent" id="replyContent" type="text" value="" placeholder="Reply Here..." data-theme="dark" style="min-width: 25vw;"><br><br>
        <input name="replyId" id="replyId" type="hidden" value="">
        <button class="simple" data-color="green" style="min-width: 25vw;" id="replySubmit">Reply</button>
        <button class="simple" data-size="small" data-color="red" id="closeReplyContainer">Close</button>
    </div>
</div>

<script src="<?= \URL; ?>javascript/strategyguide.js?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["strategyguide.js"]; ?>"></script>