<?php

    namespace controller;

    class Ajax extends \library\Controller {
        public function newstrategyguide() {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['gameID'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn) {
                        if (strlen($_POST['title']) <= 100 && strlen($_POST['gameID']) <= 65535) {
                            if (time() - $this->user->getTimeSinceLastPosted() >= 3600) {
                                $this->loadModel("game");
                                $this->loadModel("strategyguide");

                                $game = new \model\Game($this->database, $_POST['gameID']);
                                if ($game->exists()) {
                                    $this->user->setTimeSinceLastPosted(time());
                                    \model\StrategyGuide::new($this->database, $this->user->getId(), $_POST['gameID'], $_POST['title'], $_POST['content']);
                                    echo "Successfully posted";
                                } else {
                                    echo "No such game exists";
                                }
                            } else {
                                echo "You can only post a strategy guide once every hour";
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
                                \model\StrategyGuide::delete($this->database, $strategyGuide->getId());
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

        public function toggleBan() {
            if (!empty($_POST['userID']) && !empty($_POST['reason'])) {
                if ($this->userIsLoggedIn) {
                    if ($this->user->isModerator()) {
                        $this->loadModel("user");

                        $user = new \model\User($this->database, $_POST['userID']);
                        if ($user->isValid()) {
                            if ($user->isBanned()) {
                                $user->removeBan();
                                mail($user->getEmail(), "Your ban has been removed", "Your ban has been removed from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYour ban was lifted by: " . $this->user->getUsername());
                                echo "The user's ban has been removed";
                            } else {
                                $user->ban();
                                mail($user->getEmail(), "You have been banned", "You have been banned from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYou have been banned by: " . $this->user->getUsername() . "\nIf you feel you have been improperly or wrongly banned please contact us.");
                                echo "The user has been banned";
                            } 
                        } else { 
                            echo "That user does not seem to exist";
                        }
                    } else {
                        echo "You must be a moderator to execute this command";
                    }
                } else {
                    echo "You must be logged in";
                }
            } else {
                echo "There was a problem when banning that user";
            }
        }

        public function forceDeleteStrategyGuide() {
            if (!empty($_POST['strategyGuideID']) && !empty($_POST['reason'])) {
                if ($this->userIsLoggedIn) {
                    if ($this->user->isModerator()) {
                        $this->loadModel("strategyguide");

                        $strategyGuide = new \model\StrategyGuide($this->database, $_POST['strategyGuideID']);
                        if ($strategyGuide->exists()) {
                            $user = new \model\User($this->database, $strategyGuide->getUserId());
                            \model\StrategyGuide::delete($this->database, $strategyGuide->getId());
                            if ($user->isValid()) mail($user->getEmail(), "Your strategy guide has been deleted", "Your strategy guide: " . $strategyGuide->getTitle() . " was deleted from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYour strategy guide was deleted by: " . $this->user->getUsername() . "\nIf you feel your strategy guide have been improperly or wrongly deleted please contact us.");
                            echo "Successfully deleted";
                        } else {
                            echo "That strategy guide does not exist";
                        }
                    } else {
                        echo "You must be a moderator to execute this command";
                    }
                } else {
                    echo "You must be logged in";
                }
            } else {
                echo "There was a problem when banning that user";
            }
        }
    }