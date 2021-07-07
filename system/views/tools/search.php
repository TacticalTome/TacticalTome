<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Search</h1>
        <p class="fontTrebuchet">Searching for: <?= $this->search; ?></p>
    </div>
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h3 class="fontTrebuchet">Results Found: <?= number_format(count($this->relatedGames) + count($this->relatedStrategyGuides)); ?></h3>
        <?php
            if (count($this->relatedGames) + count($this->relatedStrategyGuides) == 0) {
                echo "<p class='fontVerdana'>There seems to be no results. Make sure you have spelled everything correctly and try using more broad terms/boraden your search.";
            }
        ?>
        <div class="spacer" data-size="large"></div>
        <?php
            foreach ($this->relatedGames as $game) {
                ?>
                    <h1 class="fontTrebuchet"><a href="<?= $game->getURL(); ?>"><?= $game->getName(); ?></a></h1>
                    <ul>
                        <li class="fontVerdana"><?= $game->getDescription(); ?></li>
                    </ul>
                <?php
            }

            if (count($this->relatedGames) > 0) echo "<div class='spacer' data-size='large'></div>";

            foreach ($this->relatedStrategyGuides as $strategyGuide) {
                $author = new \model\User($this->database, $strategyGuide->getUserId());
                ?>
                    <h1 class="fontTrebuchet"><a href="<?= $strategyGuide->getURL(); ?>""><?= $strategyGuide->getTitle(); ?></a></h1>
                    <p class="fontTrebuchet" data-fontsize="small">Posted by <?= $author->getUsername(); ?> on <?= date("D. F d, Y @ g:i A", $strategyGuide->getTimeCreated()) ?></p>
                    <ul>
                        <li class="fontVerdana"><?= $strategyGuide->getDescriptionSnippet(250); ?></li>
                    </ul>
                <?php
            }
        ?>
        <div class="spacer" data-size="large"></div>

        <p class="fontTrebuchet">Not seeing a game? Add it <a href="<?= \URL; ?>game/submit/">here</a>.</p>
    </div>
</div>