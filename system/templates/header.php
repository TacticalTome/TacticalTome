<!--
<?php echo \WEBSITE_NAME; ?>
    (c) 2021 - <?php echo date("Y"); ?> Silas Carlson. All Rights Reserved.
-->

<!DOCTYPE HTML>
<HTML>
    <head>
        <!--
            Site Data
        -->
        <title><?php echo $this->pageTitle; ?></title>
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <!--
            Framework
        -->
        <link rel="stylesheet" href="<?php echo \URL; ?>stylesheets/framework.css">
        <script src="<?php echo \URL; ?>javascript/framework.js"></script>
        <script src="<?php echo \URL; ?>javascript/carousel.js"></script>

        <!--
            FontAwesome
        -->
        <link rel="stylesheet" href="<?php echo \URL; ?>stylesheets/font-awesome/all.css" />
		<script src="<?php echo \URL; ?>javascript/font-awesome/all.js"></script>

        <!--
            JQuery
        -->
        <script src="<?php echo \URL; ?>javascript/jquery.js"></script>
        <script src="<?php echo \URL; ?>javascript/jquery-ui/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?php echo \URL; ?>stylesheets/jquery-ui/jquery-ui.css" />

        <!--
            Other
        -->
        <link rel="stylesheet" href="<?php echo \URL; ?>stylesheets/main.css" />
        <script src="<?php echo \URL; ?>javascript/formvalidation.js"></script>
    </head>

    <!--
        Body
        THEME > light
    -->
    <body data-theme="light">
        <!--
            Top Navigation (FIXED)
            THEME    > dark
            SIZE     > large
            SCROLLTO > medium
        -->
        <div class="topNavigation fixed unselectable" data-theme="dark" data-size="extralarge" data-basesize="extralarge" data-scrollto="medium">
            <div class="brand hideOnMobile fontTrebuchet colorOrange"><?php echo \WEBSITE_NAME; ?></div>
            <div class="linkContainerRight">
                <div class="linkSection">
                    <div class="link fontVerdana" id="<?php if ($this->pageIdentifier == "Home") echo "active"; ?>"><a href="<?php echo \URL; ?>"><i class="fas fa-home"></i> Home</a></div>
                    <div class="link fontVerdana" id="<?php if ($this->pageIdentifier == "Explore") echo "active"; ?>"><a href="<?php echo \URL; ?>user/explore/"><i class="fab fa-wpexplorer"></i> Explore</a></div>
                    <?php if ($this->userIsLoggedIn) { ?>
                        <div class="dropdown hideOnMobile">
                            <span class="title fontVerdana"><i class="fas fa-shoe-prints"></i> Followed Games <i class="fas fa-chevron-down"></i></span>
                            <div class="content">
                                <?php
                                    foreach ($this->user->getFollowedGames() as $followedGameID) {
                                        if (!empty($followedGameID)) {
                                            $followedGame = new \model\Game($this->database, $followedGameID);
                                            echo '<div class="link fontVerdana" id=""><a href="' . \URL . 'game/view/' . $followedGameID . '/">' . $followedGame->getName() . '</a></div>';
                                        }
                                    }
                                ?>
                                <br>
                                <hr data-align="left" data-length="short" data-color="white" style="margin-left: 10px;">
                                <div class="link fontVerdana" id=""><a href="<?php echo \URL; ?>game/submit/">Submit a Game</a></div>
                            </div>
                        </div>
                        <div class="link fontVerdana hideOnDesktop" id=""><a href=""><i class="fas fa-shoe-prints"></i> Followed Games</a></div>
                    <?php } ?>
                </div>
                <div class="linkSection">
                    <div class="link">
                        <input type="text" class="fontVerdana" placeholder="Search" style="width: 75%;" id="searchWebsiteText"/>
                        <button class="simple fontVerdana" data-theme="dark" data-color="blue" id="searchWebsite"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="linkSection">
                    <?php if (!$this->userIsLoggedIn) { ?>
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('<?php echo \URL; ?>user/login/');"><i class="fas fa-sign-in-alt"></i> Login</button></div>
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('<?php echo \URL; ?>user/register/');"><i class="fas fa-user-plus"></i> Sign Up</button></div>
                    <?php } else { ?>
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('<?php echo \URL; ?>user/account/');"><i class="fas fa-user"></i> Account</button></div>
                    <?php } ?>
                </div>  
            </div>
            <div id="navigationCollapse">=</div>
        </div>

        <!--
            Spacer
            SIZE > medium
        -->
        <div class="spacer" data-size="medium"></div>