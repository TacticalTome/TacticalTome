<?php

    namespace controller;

    class Ajax extends \core\Controller {
        // todo: refactor
        public function newstrategyguide() {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['gameID'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn) {
                        if (strlen($_POST['title']) <= 100 && strlen($_POST['content']) <= 65535) {
                            if (time() - $this->user->getTimeSinceLastPosted() >= 3600) {
                                if (!str_contains($_POST['content'], "<body") && !str_contains($_POST['content'], "<script") && !str_contains($_POST['content'], "<link")  && !str_contains($_POST['content'], "<meta")) {
                                    $this->loadModel("game", "strategyguide");

                                    $game = new \model\Game($this->database, $_POST['gameID']);
                                    if ($game->exists()) {
                                        $this->user->setTimeSinceLastPosted(time());
                                        \model\StrategyGuide::new($this->database, $this->user->getId(), $_POST['gameID'], $_POST['title'], $_POST['content']);
                                        echo "Successfully posted";
                                    } else {
                                        echo "No such game exists";
                                    }
                                } else {
                                    echo "Invalid text was supplied";
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

        // todo: refactor
        public function updatestrategyguide() {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['gameID']) && !empty($_POST['strategyGuideID'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn) {
                        if (strlen($_POST['title']) <= 100 && strlen($_POST['content']) <= 65535) {
                            if (!str_contains($_POST['content'], "<body") && !str_contains($_POST['content'], "<script") && !str_contains($_POST['content'], "<link")  && !str_contains($_POST['content'], "<meta")) {
                                $this->loadModel("game", "strategyguide");

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
                                echo "Invalid text was supplied";
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

        // todo: refactor
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

        // todo: refactor
        public function toggleBan() {
            if (!empty($_POST['userID']) && !empty($_POST['reason'])) {
                if ($this->userIsLoggedIn) {
                    if ($this->user->isModerator()) {
                        $this->loadModel("user");

                        $user = new \model\User($this->database, $_POST['userID']);
                        if ($user->isValid()) {
                            if ($user->isBanned()) {
                                $user->removeBan();
                                \utility\mailTo($user->getEmail(), "Your ban has been removed", "Your ban has been removed from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYour ban was lifted by: " . $this->user->getUsername());
                                echo "The user's ban has been removed";
                            } else {
                                $user->ban();
                                \utility\mailTo($user->getEmail(), "You have been banned", "You have been banned from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYou have been banned by: " . $this->user->getUsername() . "\nIf you feel you have been improperly or wrongly banned please contact us.");
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

        // todo: refactor
        public function forceDeleteStrategyGuide() {
            if (!empty($_POST['strategyGuideID']) && !empty($_POST['reason'])) {
                if ($this->userIsLoggedIn) {
                    if ($this->user->isModerator()) {
                        $this->loadModel("strategyguide");

                        $strategyGuide = new \model\StrategyGuide($this->database, $_POST['strategyGuideID']);
                        if ($strategyGuide->exists()) {
                            $user = new \model\User($this->database, $strategyGuide->getUserId());
                            \model\StrategyGuide::delete($this->database, $strategyGuide->getId());
                            if ($user->isValid()) \utility\mailTo($user->getEmail(), "Your strategy guide has been deleted", "Your strategy guide: " . $strategyGuide->getTitle() . " was deleted from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYour strategy guide was deleted by: " . $this->user->getUsername() . "\nIf you feel your strategy guide have been improperly or wrongly deleted please contact us.");
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

        // todo: refactor
        public function reply() {
            if (!empty($_POST['strategyGuideId']) && !empty($_POST['replyContent'])) {
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) === \URL) {
                    if ($this->userIsLoggedIn && !$this->user->isBanned()) {
                        if (strlen($_POST['replyContent']) <= 1000) {
                            $this->loadModel("strategyguide", "reply");

                            $strategyGuide = new \model\StrategyGuide($this->database, $_POST['strategyGuideId']);
                            if ($strategyGuide->exists()) {
                                \model\Reply::new($this->database, $this->user->getId(), $strategyGuide->getId(), $_POST['replyContent']);
                                echo "Successfully posted";
                            } else {
                                echo "The strategy guide you tried replying to does not exist";
                            }
                        } else {
                            echo "Your content must be under 1,000 characters (" . number_format(strlen($_POST['replyContent'])) . " characters used)";
                        }
                    } else {
                        echo "You must be logged in";
                    }
                } else {
                    echo "Something went wrong";
                }
            } else {
                echo "There was a problem when posting that reply";
            }
        }

        public function deletereply() {
            try {
                if (empty($_POST['replyId'])) throw new \Exception("There was a problem when deleting that reply");
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) !== \URL) throw new \Exception("Something went wrong");
                if (!$this->userIsLoggedIn || $this->user->isBanned()) throw new \Exception("You must be logged in");
                
                $this->loadModel("reply");
                $reply = new \model\Reply($this->database, $_POST['replyId']);

                if (!$reply->exists()) throw new \Exception("The reply you tried deleting does not exist");
                if ($reply->getUserId() != $this->user->getId()) throw new \Exception("You must be the owner of that reply");

                \model\Reply::delete($this->database, $reply->getId());
                echo "Successfully deleted";
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }

        public function forcedeletereply() {
            try {
                if (empty($_POST['replyId']) || empty($_POST['reason'])) throw new \Exception("There was a problem when deleting that reply");
                if (substr($_SERVER['HTTP_REFERER'], 0, strlen(\URL)) !== \URL) throw new \Exception("Something went wrong");
                if (!$this->userIsLoggedIn || $this->user->isBanned()) throw new \Exception("You must be logged in");
                
                $this->loadModel("reply");
                $reply = new \model\Reply($this->database, $_POST['replyId']);
                
                if (!$reply->exists()) throw new \Exception("The reply you tried deleting does not exist");
                if (!$this->user->isModerator()) throw new \Exception("You must be a moderator to delete that reply!");

                $author = new \model\User($this->database, $reply->getUserId());
                if ($author->isValid()) {
                    \utility\mailTo($author->getEmail(), "Your reply has been deleted", "Your reply: " . $reply->getContent() . " was deleted from " . \WEBSITE_NAME . " for the following reason(s): " . $_POST['reason'] . "\n\nYour strategy guide was deleted by: " . $this->user->getUsername() . "\nIf you feel your strategy guide have been improperly or wrongly deleted please contact us.");
                }

                \model\Reply::delete($this->database, $reply->getId());
                echo "Successfully deleted";
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }