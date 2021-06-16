<?php

    namespace controller;

    class Game extends \library\Controller {
        public function view(int $gameID = null) {
            if (!is_null($gameID)) {
                $this->loadModel("game");
                $this->loadModel("strategyguide");

                $this->game = new \model\Game($this->database, $gameID);
                if ($this->game->exists()) {
                    $this->recentStrategyGuides = Array();
                    $recentStrategyGuidesGet = $this->database->query("SELECT * FROM strategyguides WHERE gid='".$this->game->getId()."' ORDER BY timecreated DESC LIMIT 10");
                    while ($strategyGuide = $recentStrategyGuidesGet->fetch_assoc()) {
                        array_push($this->recentStrategyGuides, new \model\StrategyGuide($this->database, $strategyGuide['id']));
                    }

                    $this->popularStrategyGuides = Array();
                    $popularStrategyGuidesGet = $this->database->query("SELECT * FROM strategyguides WHERE gid='".$this->game->getId()."' ORDER BY favorites DESC LIMIT 10");
                    while ($strategyGuide = $popularStrategyGuidesGet->fetch_assoc()) {
                        array_push($this->popularStrategyGuides, new \model\StrategyGuide($this->database, $strategyGuide['id']));
                    }

                    $this->pageTitle = $this->game->getName() . " - " . \WEBSITE_NAME;
                    $this->pageIdentifier = "View Game";
                    $this->pageDescription = $this->game->getShortDescription();

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

                                    $covers = Array();
                                    for ($i = 0; $i < count($steam[$appId]["data"]["screenshots"]); $i++) {
                                        if ($i < 5) {
                                            array_push($covers, $steam[$appId]["data"]["screenshots"][$i]["path_full"]);
                                        }
                                    }
                                    $covers = implode(",", $covers);

                                    \model\Game::new(
                                        $this->database,
                                        $steam[$appId]["data"]["name"],
                                        $steam[$appId]["data"]["short_description"],
                                        $steam[$appId]["data"]["developers"][0],
                                        $tags,
                                        $steam[$appId]["data"]["header_image"],
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