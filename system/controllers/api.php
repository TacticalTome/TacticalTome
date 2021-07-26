<?php

    namespace controller;

    class API extends \core\Controller {
        public function index(): void {
            $this->pageIdentifier = "Api";
            $this->pageTitle = "API Documentation - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("api", "index");
        }

        public function game(string $action = null, int|string $value = null): void {
            header("Content-Type: application/json");

            $result =  new \model\ApiResult();

            if (is_null($action)) $result->addError("Action is not set");
            if (is_null($value)) $result->addError("Value is not set");

            if (!is_null($action)) {
                switch ($action) {
                    case "get":
                        if (!is_null($value)) {
                            $game = new \model\Game($this->database, $value);
                            
                            if ($game->exists()) {
                                $result->addData("id", $game->getId());
                                $result->addData("name", $game->getName());
                                $result->addData("description", $game->getDescription());
                                $result->addData("developer", $game->getDeveloper());
                                $result->addData("developer", $game->getTags());
                                $result->addData("banner", $game->getBannerURL());
                                $result->addData("cover", $game->getCovers());
                                $result->addData("steamappid", $game->getSteamAppId());
                                $result->addData("followers", $game->getFollowers());
                                $result->addData("url", $game->getURL());
                                $result->addData("newstrategyguideurl", $game->getNewStrategyGuideURL());
                                $result->setSuccess(true);
                            } else {
                                $result->addError("No game with that ID exists");
                            }
                        }
                        break;
                }
            }

            echo $result->getDataAsJSON();
        }

        public function strategyGuide(string $action = null, int|string $value = null) {
            header("Content-Type: application/json");

            $result = new \model\ApiResult();

            if (is_null($action)) $result->addError("Action is not set");
            if (is_null($value)) $result->addError("Value is not set");

            if (!is_null($action)) {
                switch ($action) {
                    case "get":
                        if (!is_null($value)) {
                            $strategyGuide = new \model\StrategyGuide($this->database, $value);

                            if ($strategyGuide->exists()) {
                                $result->addData("id", $strategyGuide->getId());
                                $result->addData("authorid", $strategyGuide->getUserId());
                                $result->addData("gameid", $strategyGuide->getGameId());
                                $result->addData("title", $strategyGuide->getTitle());
                                $result->addData("content", $strategyGuide->getContent());
                                $result->addData("timeposted", $strategyGuide->getTimeCreated());
                                $result->addData("favorites", $strategyGuide->getFavorites());
                                $result->setSuccess(true);
                            } else {
                                $result->addError("No strategy guide with that ID exists");
                            }
                        }
                        break;

                    case "getreplies":
                        if (!is_null($value)) {
                            $strategyGuideReplies = \model\Reply::getAllStrategyGuideReplies($this->database, $value);

                            $index = 0;
                            foreach ($strategyGuideReplies as $reply) {
                                $result->addArray(Array(
                                    "id" => $reply->getId(),
                                    "authorid" => $reply->getUserId(),
                                    "strategyguideid" => $reply->getStrategyGuideId(),
                                    "content" => $reply->getContent(),
                                    "timeposted" => $reply->getTimeCreated()
                                ));
                                $index++;
                            }
                            $result->setSuccess(true);
                        } else {
                            $result->addError("No strategy guide with that ID exists");
                        }
                        break;
                }
            }

            echo $result->getDataAsJSON();
        }

        public function user(string $action = null, int|string $value = null) {
            header("Content-Type: application/json");

            $result =  new \model\ApiResult();

            if (is_null($action)) $result->addError("Action is not set");
            if (is_null($value)) $result->addError("Value is not set");

            if (!is_null($action)) {
                switch ($action) {
                    case "get":
                        if (!is_null($value)) {
                            $user = new \model\User($this->database, $value);

                            if ($user->isValid()) {
                                $result->addData("id", $user->getId());
                                $result->addData("username", $user->getUsername());
                                $result->addData("timeregistered", $user->getTimeCreated());
                                $result->addData("followedgameids", $user->getFollowedGames());
                                $result->addData("favoritestrategyguideids", $user->getFavoriteStrategyGuides());
                                $result->setSuccess(true);
                            } else {
                                $result->addError("No user with that ID exists");
                            }
                        }
                        break;
                }
            }

            echo $result->getDataAsJSON();
        }
    }