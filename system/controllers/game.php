<?php

    namespace controller;

    class Game extends \library\Controller {
        public function view(int $gameID = null) {
            if (!is_null($gameID)) {
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->game = new \model\Game($this->database, $gameID);
                if ($this->game->exists()) {
                    $this->loadViewWithHeaderFooter("game", "view");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function follow(int $gameID = null) {
            if (!is_null($gameID) && $this->userIsLoggedIn) {
                $this->loadModel("game");

                $this->game = new \model\Game($this->database, $gameID);
                if ($this->game->exists()) {
                    $this->user->addFollowedGame($gameID);

                    $this->loadViewWithHeaderFooter("game", "follow");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function unfollow(int $gameID = null) {
            if (!is_null($gameID) && $this->userIsLoggedIn) {
                $this->loadModel("game");

                $this->game = new \model\Game($this->database, $gameID);
                if ($this->game->exists()) {
                    $this->user->removeFollowedGame($gameID);

                    $this->loadViewWithHeaderFooter("game", "unfollow");
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
                    $this->user->addFavoriteStrategyGuide($strategyGuideID);

                    $this->loadViewWithHeaderFooter("game", "favorite");
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
                    $this->user->removeFavoriteStrategyGuide($strategyGuideID);

                    $this->loadViewWithHeaderFooter("game", "unfavorite");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function newstrategyguide(int $gameID = null) {
            if (!is_null($gameID) && $this->userIsLoggedIn) {
                $this->loadModel("game");

                $this->game = new \model\Game($this->database, $gameID);
                if ($this->game->exists() && $this->user->isFollowingGame($this->game->getId())) {
                    $this->loadViewWithHeaderFooter("game", "newstrategyguide");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function editstrategyguide(int $strategyGuideID = null) {
            if (!is_null($strategyGuideID) && $this->userIsLoggedIn) {
                $this->loadModel("user");
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->strategyGuide = new \model\StrategyGuide($this->database, $strategyGuideID);
                if ($this->strategyGuide->exists() && $this->user->getId() == $this->strategyGuide->getUserId()) {
                    $this->game = new \model\Game($this->database, $this->strategyGuide->getGameId());
                    $this->loadViewWithHeaderFooter("game", "editstrategyguide");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }

        public function strategyguide(int $strategyGuideID = null) {
            if (!is_null($strategyGuideID)) {
                $this->loadModel("user");
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->strategyGuide = new \model\StrategyGuide($this->database, $strategyGuideID);
                if ($this->strategyGuide->exists()) {
                    $this->game = new \model\Game($this->database, $this->strategyGuide->getGameId());
                    $this->author = new \model\User($this->database, $this->strategyGuide->getUserId());
                    $this->loadViewWithHeaderFooter("game", "strategyguide");
                } else {
                    $this->unknownPage();
                }
            } else {
                $this->unknownPage();
            }
        }
    }

?>