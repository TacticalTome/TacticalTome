<?php

    namespace controller;

    class StrategyGuide extends \library\Controller {
        public function view(int $strategyGuideID = null) {
            if (!is_null($strategyGuideID)) {
                $this->loadModel("user");
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->strategyGuide = new \model\StrategyGuide($this->database, $strategyGuideID);
                if ($this->strategyGuide->exists()) {
                    $this->game = new \model\Game($this->database, $this->strategyGuide->getGameId());
                    $this->author = new \model\User($this->database, $this->strategyGuide->getUserId());

                    $this->pageTitle = $this->strategyGuide->getTitle() . " - " . $this->game->getName() . " - " . \WEBSITE_NAME;
                    $this->pageIdentifier = "View Strategy Guide";
                    $this->pageDescription = $this->strategyGuide->getPreview();

                    $this->loadViewWithHeaderFooter("strategyguide", "view");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function favorite(int $strategyGuideID = null) {
            if (!is_null($strategyGuideID) && $this->userIsLoggedIn) {
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->strategyGuide = new \model\StrategyGuide($this->database, $strategyGuideID);
                $this->game = new \model\Game($this->database, $this->strategyGuide->getGameId());
                if ($this->game->exists() && $this->user->getId() != $this->strategyGuide->getUserId()) {
                    $this->author = new \model\User($this->database, $this->strategyGuide->getUserId());
                    if (!$this->user->isStrategyGuideFavorite($strategyGuideID)) {
                        $this->strategyGuide->setFavorites($this->strategyGuide->getFavorites() + 1);
                        $this->user->addFavoriteStrategyGuide($strategyGuideID);
                    }

                    $this->loadViewWithHeaderFooter("strategyguide", "favorite");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function unfavorite(int $strategyGuideID = null) {
            if (!is_null($strategyGuideID) && $this->userIsLoggedIn) {
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->strategyGuide = new \model\StrategyGuide($this->database, $strategyGuideID);
                $this->game = new \model\Game($this->database, $this->strategyGuide->getGameId());
                if ($this->game->exists() && $this->user->getId() != $this->strategyGuide->getUserId()) {
                    $this->author = new \model\User($this->database, $this->strategyGuide->getUserId());
                    if ($this->user->isStrategyGuideFavorite($strategyGuideID)) {
                        $this->strategyGuide->setFavorites($this->strategyGuide->getFavorites() - 1);
                        $this->user->removeFavoriteStrategyGuide($strategyGuideID);
                    }

                    $this->loadViewWithHeaderFooter("strategyguide", "unfavorite");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function new(int $gameID = null) {
            if (!is_null($gameID) && $this->userIsLoggedIn) {
                $this->loadModel("game");

                $this->game = new \model\Game($this->database, $gameID);
                if ($this->game->exists() && $this->user->isFollowingGame($this->game->getId())) {
                    $this->pageIdentifier = "New Strategy Guide";
                    $this->pageTitle = "New Strategy Guide - " . \WEBSITE_NAME;

                    $this->loadViewWithHeaderFooter("strategyguide", "new");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function edit(int $strategyGuideID = null) {
            if (!is_null($strategyGuideID) && $this->userIsLoggedIn) {
                $this->loadModel("user");
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->strategyGuide = new \model\StrategyGuide($this->database, $strategyGuideID);
                if ($this->strategyGuide->exists() && $this->user->getId() == $this->strategyGuide->getUserId()) {
                    $this->game = new \model\Game($this->database, $this->strategyGuide->getGameId());

                    $this->pageIdentifier = "Edit Strategy Guide";
                    $this->pageTitle = "Edit Strategy Guide - " . \WEBSITE_NAME;

                    $this->loadViewWithHeaderFooter("strategyguide", "edit");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }
    }