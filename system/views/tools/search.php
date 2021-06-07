<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Search</h1>
        <p class="fontTrebuchet">Searching for: <?php echo $this->search; ?></p>
    </div>
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h3 class="fontTrebuchet">Results Found: <?php echo number_format(count($this->relatedGames) + count($this->relatedStrategyGuides)); ?></h3>
        <?php
            if (count($this->relatedGames) + count($this->relatedStrategyGuides) == 0) {
                echo "<p class='fontVerdana'>There seems to be no results. Make sure you have spelled everything correctly and try using more broad terms/boraden your search.";
            }
        ?>
        <div class="spacer" data-size="large"></div>
        <?php
            foreach ($this->relatedGames as $game) {
                ?>
                    <h1 class="fontTrebuchet"><a href="<?php echo $game->getURL(); ?>"><?php echo $game->getName(); ?></a></h1>
                    <ul>
                        <li class="fontVerdana"><?php echo $game->getDescription(); ?></li>
                    </ul>
                <?php
            }

            if (count($this->relatedGames) > 0) echo "<div class='spacer' data-size='large'></div>";

            foreach ($this->relatedStrategyGuides as $strategyGuide) {
                $author = new \model\User($this->database, $strategyGuide->getUserId());
                ?>
                    <h1 class="fontTrebuchet"><a href="<?php echo $strategyGuide->getURL(); ?>""><?php echo $strategyGuide->getTitle(); ?></a></h1>
                    <p class="fontTrebuchet" data-fontsize="small">Posted by <?php echo $author->getUsername(); ?> on <?php echo date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()) ?></p>
                    <ul>
                        <li class="fontVerdana"><?php echo $strategyGuide->getDescriptionSnippet(250); ?></li>
                    </ul>
                <?php
            }
        ?>
        <div class="spacer" data-size="large"></div>

        <p class="fontTrebuchet">Not seeing a game? Add it <a href="<?php echo \URL; ?>game/submit/">here</a>.</p>
    </div>
</div>