<?php

    namespace controller;

    class Index extends \library\Controller {
        public function index() {
            $this->pageTitle = \WEBSITE_NAME;
            $this->pageIdentifier = "Home";

            $this->loadModel("game");
            $this->loadModel("strategyguide");

            $this->topGames = Array();
            $topGamesGet = $this->database->query("SELECT * FROM games ORDER BY followers DESC LIMIT 6");
            while ($game = $topGamesGet->fetch_assoc()) {
                array_push($this->topGames, new \Model\Game($this->database, $game['id']));
            }

            $this->topStrategyGuides = Array();
            $topStrategyGuidesGet = $this->database->query("SELECT * FROM strategyguides WHERE timecreated>'".(time()-86400)."' ORDER BY favorites DESC LIMIT 5");
            while ($strategyGuide = $topStrategyGuidesGet->fetch_assoc()) {
                array_push($this->topStrategyGuides, new \Model\StrategyGuide($this->database, $strategyGuide['id']));
            }

            $this->loadViewWithHeaderFooter("index", "index");
        }
    }

?>