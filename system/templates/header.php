<!--
    <?= \WEBSITE_NAME ?>
    (c) 2021 - <?= date("Y") . " " . \WEBSITE_NAME; ?>. All Rights Reserved.
    v<?= \WEBSITE_VERSION; ?>
-->

<!DOCTYPE HTML>
<HTML>
    <head>
        <!--
            Site Data
        -->
        <title><?= $this->pageTitle; ?></title>
        <link rel="icon" href="<?= \URL; ?>images/icon.png" type="image/png">

        <!--
            Framework
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/framework.css?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["framework.css"]; ?>">
        <script src="<?= \URL; ?>javascript/framework.js?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["framework.js"]; ?>"></script>
        <script src="<?= \URL; ?>javascript/carousel.js?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["carousel.js"]; ?>"></script>

        <!--
            CSS and Form Validation
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/main.css?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["main.css"]; ?>" />
        <script src="<?= \URL; ?>javascript/formvalidation.js?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["formvalidation.js"]; ?>"></script>

        <!--
            FontAwesome
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/font-awesome/all.css" />
		<script src="<?= \URL; ?>javascript/font-awesome/all.js"></script>

        <!--
            JQuery
        -->
        <script src="<?= \URL; ?>javascript/jquery.js"></script>
        <script src="<?= \URL; ?>javascript/jquery-ui/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/jquery-ui/jquery-ui.css" />

        <?php if (($this->pageIdentifier == "Register" || $this->pageIdentifier == "Submit Steam Game") && \ENABLE_RECAPTCHA) { ?>
            <!--
                reCAPTCHA
            -->
            <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        <?Php } ?>

        <!--
            Metadata
        -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta name="baseurl" content="<?= \URL; ?>">
        <meta name="description" content="<?= $this->pageDescription; ?>">
        <meta name="keywords" content="strategy guides, collection, guides, gaming, games, encyclopedia, tutorials, news">
        <meta name="language" content="English">
        <meta name="og:url" property="og:url" content="<?= \utility\getCurrentURL(); ?>">
        <meta name="og:type" property="og:type" content="website">
        <meta name="og:title" property="og:title" content="<?= $this->pageTitle; ?>">
        <meta name="og:description" property="og:description" content="<?= $this->pageDescription; ?>">

        <?php
            switch( $this->pageIdentifier) {
                case "View Strategy Guide":
                    echo '<meta name="author" content="' . $this->author->getUsername() . '">';
                    echo '<meta name="copyright" content="' . $this->author->getUsername() . '">';
                    echo '<meta name="og:image" property="og:image" content="' . $this->game->getCoverURL() . '">';
                    echo '<meta name="gameurl" content="' . $this->game->getURL() . '">';
                    echo '<meta name="strategyguideid" content="' . $this->strategyGuide->getId() . '">';
                    break;

                case "View Game":
                    echo '<meta name="copyright" content="' . $this->game->getDeveloper() . '">';
                    echo '<meta name="og:image" property="og:image" content="' . $this->game->getCoverURL() . '">';
                    break;
                
                case "Register":
                case "Login":
                case "Explore":
                case "Account":
                case "Submit Steam Game":
                case "New Strategy Guide":
                case "Edit Strategy Guide":
                case "View Followed Games":
                    echo '<meta name="robots" content="nofollow">';
                    \utility\echoDefaultMetadata();
                    break;

                default:
                    \utility\echoDefaultMetadata();
                    break;
            }
        ?>
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
            <div class="brand hideOnMobile fontTrebuchet colorOrange"><?= \WEBSITE_NAME; ?></div>
            <div class="linkContainerRight">
                <div class="linkSection">
                    <div class="link fontVerdana" id="<?php if ($this->pageIdentifier == "Home") echo "active"; ?>"><a href="<?= \URL; ?>"><i class="fas fa-home"></i> Home</a></div>
                    <div class="link fontVerdana" id="<?php if ($this->pageIdentifier == "Explore") echo "active"; ?>"><a href="<?= \URL; ?>user/explore/"><i class="fab fa-wpexplorer"></i> Explore</a></div>
                    <?php if ($this->userIsLoggedIn) { ?>
                        <div class="dropdown hideOnMobile">
                            <span class="title fontVerdana"><i class="fas fa-shoe-prints"></i> Followed Games <i class="fas fa-chevron-down"></i></span>
                            <div class="content">
                                <?php
                                    foreach ($this->user->getFollowedGames() as $followedGameID) {
                                        if (!empty($followedGameID)) {
                                            $followedGame = new \model\Game($this->database, $followedGameID);
                                            if ($this->pageIdentifier == "View Game" && $this->game->getId() == $followedGame->getId()) {
                                                echo '<div class="link fontVerdana" id="active"><a href="' . \URL . 'game/view/' . $followedGameID . '/">' . $followedGame->getName() . '</a></div>';
                                            } else {
                                                echo '<div class="link fontVerdana" id=""><a href="' . \URL . 'game/view/' . $followedGameID . '/">' . $followedGame->getName() . '</a></div>';
                                            }
                                        }
                                    }
                                ?>
                                <br>
                                <hr data-align="left" data-length="short" data-color="white" style="margin-left: 10px;">
                                <div class="link fontVerdana" id="<?php if ($this->pageIdentifier == "Submit Steam Game") echo "active"; ?>"><a href="<?= \URL; ?>game/submit/">Submit a Game</a></div>
                            </div>
                        </div>
                        <div class="link fontVerdana hideOnDesktop" id="<?php if ($this->pageIdentifier == "View Followed Games") echo "active"; ?>"><a href="<?= \URL; ?>user/followedgames/"><i class="fas fa-shoe-prints"></i> Followed Games</a></div>
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
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('<?= \URL; ?>user/login/');"><i class="fas fa-sign-in-alt"></i> Login</button></div>
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('<?= \URL; ?>user/register/');"><i class="fas fa-user-plus"></i> Sign Up</button></div>
                    <?php } else { ?>
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('<?= \URL; ?>user/account/');"><i class="fas fa-user"></i> Account</button></div>
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