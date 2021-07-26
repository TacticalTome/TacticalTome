<?php

    namespace controller;

    class Tools extends \core\Controller {
        public function search(string $search = null) {
            if (!is_null($search)) {
                $search = $this->database->protect(urldecode($search));

                $search_games = $this->database->query("SELECT * FROM games WHERE name LIKE '%$search%' OR description LIKE '%$search%' ORDER BY followers DESC");
                $search_strategyguides = $this->database->query("SELECT * FROM strategyguides WHERE title LIKE '%$search%' OR content LIKE '%$search%' ORDER by favorites DESC");

                $this->relatedGames = Array();
                while ($game = $search_games->fetch_assoc()) {
                    $gameObject = new \model\Game($this->database, $game['id']);
                    array_push($this->relatedGames, $gameObject);
                }

                $this->relatedStrategyGuides = Array();
                while ($strategyGuide = $search_strategyguides->fetch_assoc()) {
                    $strategyGuideObject = new \model\StrategyGuide($this->database, $strategyGuide['id']);
                    array_push($this->relatedStrategyGuides, $strategyGuideObject);
                }

                $this->search = $search;

                $this->pageIdentifier = "Search";
                $this->pageTitle = "Search: " . $search . " - " . \WEBSITE_NAME;

                $this->loadViewWithHeaderFooter("tools", "search");

            } else {
                $this->unknownPage();
            }
        }
    }