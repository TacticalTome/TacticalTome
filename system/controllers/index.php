<?php

    namespace controller;

    class Index extends \library\Controller {
        public function index() {
            $this->pageTitle = \WEBSITE_NAME;
            $this->pageIdentifier = "Home";

            $this->loadModel("game", "strategyguide");
            
            $this->topGames = \model\Game::getMostPopular($this->database, 6);
            $this->topStrategyGuides = \model\StrategyGuide::getTodaysMostPopular($this->database, 5);

            $this->loadViewWithHeaderFooter("index", "index");
        }
    }

?>