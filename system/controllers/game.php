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
                    if (!$this->user->isFollowingGame($gameID)) {
                        $this->game->setFollowers($this->game->getFollowers() + 1);
                        $this->user->addFollowedGame($gameID);
                    }

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
                    if ($this->user->isFollowingGame($gameID)) {
                        $this->game->setFollowers($this->game->getFollowers() - 1);
                        $this->user->removeFollowedGame($gameID);
                    }

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
                    $this->author = new \model\User($this->database, $this->strategyGuide->getUserId());
                    if (!$this->user->isStrategyGuideFavorite($strategyGuideID)) {
                        $this->strategyGuide->setFavorites($this->strategyGuide->getFavorites() + 1);
                        $this->user->addFavoriteStrategyGuide($strategyGuideID);
                    }

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
                    $this->author = new \model\User($this->database, $this->strategyGuide->getUserId());
                    if ($this->user->isStrategyGuideFavorite($strategyGuideID)) {
                        $this->strategyGuide->setFavorites($this->strategyGuide->getFavorites() - 1);
                        $this->user->removeFavoriteStrategyGuide($strategyGuideID);
                    }

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

        public function submit() {
            $this->loadModel("game");

            if (!empty($_POST['submitGame'])) {
                if (!empty($_POST['steamLink'])) {
                    $url = $_POST['steamLink'];
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                        $url = parse_url($url);
                        if ($url['host'] == "store.steampowered.com") {
                            $urlParameters = explode("/", $url['path']);
                            $appId = intval($urlParameters[2]);

                            if (!\model\Game::existsWithSteamId($this->database, $appId)) {
                                $steam = json_decode(file_get_contents("https://store.steampowered.com/api/appdetails/?appids=" . $appId), true);
                                if (!empty($steam[$appId]["success"])) {
                                    $gameFileName = strtolower(str_replace(" ", "", $steam[$appId]["data"]["name"]));
                                    $gameFileName = preg_replace('/[^A-Za-z0-9\-]/', '', $gameFileName);

                                    $tags = Array();
                                    foreach ($steam[$appId]["data"]["genres"] as $genre) {
                                        array_push($tags, $genre["description"]);
                                    }
                                    $tags = implode(",", $tags);

                                    file_put_contents(BANNER_DIRECTORY . $gameFileName . ".jpg", file_get_contents($steam[$appId]["data"]["header_image"]));

                                    $covers = Array();
                                    for ($i = 0; $i < count($steam[$appId]["data"]["screenshots"]); $i++) {
                                        file_put_contents(COVER_DIRECTORY . $gameFileName . $i . ".jpg", file_get_contents($steam[$appId]["data"]["screenshots"][$i]["path_full"]));
                                        array_push($covers, $gameFileName . $i . ".jpg");
                                    }
                                    $covers = implode(",", $covers);

                                    \model\Game::new(
                                        $this->database,
                                        $steam[$appId]["data"]["name"],
                                        $steam[$appId]["data"]["short_description"],
                                        $steam[$appId]["data"]["developers"][0],
                                        $tags,
                                        $gameFileName . ".jpg",
                                        $covers,
                                        $appId
                                    );

                                    $gameId = \model\Game::getGameIdWithSteamId($this->database, $appId);

                                    array_push($this->formErrors, "The game is now added. View it <a href='" . \URL . "game/view/" . $gameId . "/'>here</a>");
                                } else {
                                    array_push($this->formErrors, "There was a probelm when trying to find that game");
                                }
                            } else {
                                array_push($this->formErrors, "That game is already in our database");
                            }
                        } else {
                            array_push($this->formErrors, "The link you have provided is not a steam link");
                        }
                    } else {
                        array_push($this->formErrors, "Please supply a valid link");
                    }
                } else {
                    array_push($this->formErrors, "Please supply all the fields");
                }
            }

            $this->loadViewWithHeaderFooter("game", "submit");
        }
    }

?>