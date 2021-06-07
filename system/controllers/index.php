<?php

    namespace controller;

    class Index extends \library\Controller {
        public function index() {
            $this->pageTitle = \WEBSITE_NAME;
            $this->pageIdentifier = "Home";

            $this->topGames = Array();
            $topGamesGet = $this->database->query("SELECT * FROM games ORDER BY followers DESC LIMIT 6");
            while ($game = $topGamesGet->fetch_assoc()) {
                array_push($this->topGames, new \Model\Game($this->database, $game['id']));
            }

            $this->loadViewWithHeaderFooter("index", "index");
        }
    }

?>