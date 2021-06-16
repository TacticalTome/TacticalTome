<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?php echo $this->game->getCoverURL(); ?>');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="large"><?php echo $this->game->getName(); ?></h1>
        <p class="fontVerdana">Followers: <?php echo number_format($this->game->getFollowers()); ?></p>
        <p class="fontVerdana hideOnMobile"><?php echo $this->game->getShortDescription(); ?></p>

        <?php if ($this->userIsLoggedIn) { ?>
            <?php if ($this->user->isFollowingGame($this->game->getId())) { ?>
                <button data-color="red" data-size="medium" title="Remove this game to your feed" onclick="gotoLink('<?php echo \URL . "game/unfollow/" . $this->game->getId() . "/"; ?>');">Unfollow</button>
                <button data-color="darkblue" data-size="medium" onclick="gotoLink('<?php echo $this->game->getNewStrategyGuideURL(); ?>');">New Strategy Guide</button>
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
            <img class="hideOnMobile" alt="<?php echo $this->game->getName(); ?> Banner" src="<?php echo $this->game->getBannerURL(); ?>">
            <h1 class="fontTrebuchet"><?php echo $this->game->getName(); ?></h1>
        </center>
        <p class="fontVerdana"><?php echo $this->game->getDescription(); ?></p>
        <p class="fontVerdana"><b>Developer</b>: <?php echo $this->game->getDeveloper(); ?></p>
        <p class="fontVerdana"><b>Tags</b>: 
            <?php
                for ($i = 0; $i < count($this->game->getTags()); $i++) {
                    if ($i != 0) echo ", ";
                    echo $this->game->getTags()[$i];
                }
            ?>
        </p>
        <?php if ($this->game->getSteamAppId() != 0) { ?>
            <p class="fontVerdana"><b>Steam link</b>: <a href="https://store.steampowered.com/app/<?php echo $this->game->getSteamAppId(); ?>/" target="_blank"><?php echo $this->game->getName(); ?></a></p>
        <?php } ?>
        <hr>

        <div class="spacer" data-size="large"></div>

        <h3 class="fontVerdana">News</h3>
        <?php if ($this->game->hasNews()) { ?>
            <ol id="gameNewsContainer">
                <p class="fontVerdana">Loading News...</p>
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
                    <li class="fontVerdana"><a href="<?php echo $strategyGuide->getURL(); ?>"><?php echo $strategyGuide->getTitle(); ?></a></li>
                    <ul class='fontVerdana'>
                        <li>Posted by <a href="<?php echo $author->getProfileURL(); ?>"><?php echo $author->getUsername(); ?></a> on <?php echo date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()); ?></li>
                        <li><?php echo $strategyGuide->getPreview(); ?></li>
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
                    <li class="fontVerdana"><a href="<?php echo $strategyGuide->getURL(); ?>"><?php echo $strategyGuide->getTitle(); ?></a></li>
                    <ul class='fontVerdana'>
                        <li>Posted by <a href="<?php echo $author->getProfileURL(); ?>"><?php echo $author->getUsername(); ?></a> on <?php echo date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()); ?></li>
                        <li><?php echo $strategyGuide->getPreview(); ?></li>
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

<?php if ($this->game->hasNews()) { ?>
    <script>
        function formatMonth(index) {
            let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            return months[index];
        }

        function formatDate(date) {
            if (date <= 9) {
                return "0" + date;
            }
            return date;
        }

        function formatTime(hours, minutes) {
            if (minutes <= 9) minutes = "0" + minutes;
            if (hours < 12) { // AM
                if (hours == 0) return "12:" + minutes + " AM";
                return hours + ":" + minutes + " AM";
            } else { // PM
                if (hours == 12) return "12:" + minutes + " PM";
                return (hours - 12) + ":" + minutes + " PM";
            }
        }

        $.get({
            url: "https://api.steampowered.com/ISteamNews/GetNewsForApp/v2/?appid=<?php echo $this->game->getSteamAppId(); ?>",
            dataType: "json",
            success: function(data) {
                $("#gameNewsContainer").empty();
                let maxNews = 5;
                for (let i = 0; i < maxNews; i++) {
                    if (typeof data.appnews.newsitems[i] !== "undefined") {
                        if (i > 0 && data.appnews.newsitems[i].date == data.appnews.newsitems[i-1].date) maxNews++;
                        else {
                            let datePosted = new Date(data.appnews.newsitems[i].date * 1000);
                            let datePostedAsString = formatMonth(datePosted.getMonth()) + " " + formatDate(datePosted.getDate()) + ", " + datePosted.getFullYear() + " @ " + formatTime(datePosted.getHours(), datePosted.getMinutes()); 
                            $("#gameNewsContainer").append("<li class='fontVerdana'><a href='" + data.appnews.newsitems[i].url + "' target='_blank'>" + data.appnews.newsitems[i].title + "</a></li><ul class='fontVerdana'><li>Posted by " + data.appnews.newsitems[i].author + " on " + datePostedAsString + "</li><li>" + data.appnews.newsitems[i].feedlabel + "</li></ul><br>");
                        }
                    }
                }
            }
        });
    </script>
<?php } ?>