<?php

    namespace controller;

    class Ajax extends \library\Controller {
        public function newstrategyguide() {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['gameID'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn) {
                        if (strlen($_POST['title']) <= 100 && strlen($_POST['gameID']) <= 65535) {
                            $this->loadModel("game");
                            $this->loadModel("strategyguide");

                            $game = new \model\Game($this->database, $_POST['gameID']);
                            if ($game->exists()) {
                                \model\StrategyGuide::new($this->database, $this->user->getId(), $_POST['gameID'], $_POST['title'], $_POST['content']);
                                echo "Successfully posted";
                            } else {
                                echo "No such game exists";
                            }
                        } else {
                            echo "Your title (max 100 characters) or your content (max 65,535 characters) is too long";
                        }
                    } else {
                        echo "You must be logged in";
                    }
                } else {
                    echo "Something went wrong";
                }
            } else {
                echo "Please supply all the fields";
            }
        }

        public function updatestrategyguide() {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['gameID']) && !empty($_POST['strategyGuideID'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn) {
                        if (strlen($_POST['title']) <= 100 && strlen($_POST['gameID']) <= 65535) {
                            $this->loadModel("game");
                            $this->loadModel("strategyguide");

                            $game = new \model\Game($this->database, $_POST['gameID']);
                            $strategyGuide = new \model\StrategyGuide($this->database, $_POST['strategyGuideID']);
                            if ($game->exists() && $strategyGuide->exists()) {
                                if ($this->user->getId() == $strategyGuide->getUserId()) {
                                    \model\StrategyGuide::update($this->database, $strategyGuide->getId(), $_POST['title'], $_POST['content']);
                                    echo "Successfully posted";
                                } else {
                                    echo "You are not the author of that post";
                                }
                            } else {
                                echo "No such game or strategy guide exists";
                            }
                        } else {
                            echo "Your title (max 100 characters) or your content (max 65,535 characters) is too long";
                        }
                    } else {
                        echo "You must be logged in";
                    }
                } else {
                    echo "Something went wrong";
                }
            } else {
                echo "Please supply all the fields";
            }
        }

        public function deletestrategyguide() {
            if (!empty($_POST['strategyGuideID'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn) {
                        $this->loadModel("strategyguide");
                        $strategyGuide = new \model\StrategyGuide($this->database, $_POST['strategyGuideID']);

                        if ($strategyGuide->exists()) {
                            if ($this->user->getId() == $strategyGuide->getUserId()) {
                                \model\StrategyGuide::delete($this->database, $_POST['strategyGuideID']);
                                echo "Successfully deleted";
                            }
                        } else {
                            echo "No such strategy guide exists";
                        }
                    } else {
                        echo "You must be logged in";
                    }
                } else {
                    echo "Something went wrong";
                }
            } else {
                echo "Please supply all the fields";
            }
        }
    }

?>