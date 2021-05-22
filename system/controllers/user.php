<?php

    namespace controller;

    class User extends \library\Controller {
        public function login() {
            if (!empty($_POST['login'])) {
                if (!empty($_POST['usernameOrEmail']) && !empty($_POST['password'])) {
                    try {
                        \model\User::login($this->database, $_POST['usernameOrEmail'], $_POST['password']);
                        header("location: " . URL);
                    } catch (\Exception $exception) {
                        array_push($this->formErrors, $exception->getMessage());
                    }
                } else {
                    array_push($this->formErrors, "Please supply all the fields");
                }
            }

            $this->loadViewWithHeaderFooter("user", "login");
        }

        public function signup() { $this->register(); }
        public function register() {
            if (!empty($_POST['register'])) {
                if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmpassword'])) {
                    if ($_POST['password'] == $_POST['confirmpassword']) {
                        try {
                            \model\User::register($this->database, $_POST['email'], $_POST['username'], $_POST['password']);
                            header("location: " . URL . "user/login/");
                        } catch (\Exception $exception) {
                            array_push($this->formErrors, $exception->getMessage());
                        }
                    } else {
                        array_push($this->formErrors, "The passwords you have provided do not match.");
                    }
                } else {
                    array_push($this->formErrors, "Please supply all the fields");
                }
            }

            $this->loadViewWithHeaderFooter("user", "register");
        }

        public function logout() {
            session_destroy();
            header("location: " . URL);
        }

        public function explore(string $action = null, int $page = null) {
            $this->pageTitle = "Explore - " . \WEBSITE_NAME; 
            $this->pageIdentifier = "Explore";
            $this->loadModel("user");
            $this->loadModel("game");
            $this->loadModel("strategyguide");

            $offset = 0;
            if (!is_null($page)) $offset = intval($page) * 20;
            
            $randomGameGet = $this->database->query("SELECT * FROM games ORDER BY RAND() LIMIT 1");
            $randomGame = $randomGameGet->fetch_assoc();

            $this->randomGame = new \model\Game($this->database, $randomGame['id']);

            $this->featuredStrategyGuides = Array();
            $this->featuredStrategyGuideAuthors = Array();
            if (!is_null($action) && $action == "recommended" && $this->userIsLoggedIn) {
                $requiredId = "";
                for ($i = 0; $i < count($this->user->getFollowedGames()); $i++) {
                    if ($i == 0) $requiredId = " AND (";

                    if ($i != count($this->user->getFollowedGames()) - 1) {
                        $requiredId .= "gid='" . $this->user->getFollowedGames()[$i] . "' OR ";
                    } else {
                        $requiredId .= "gid='" . $this->user->getFollowedGames()[$i] . "'";
                    }

                    if ($i == count($this->user->getFollowedGames()) - 1) $requiredId .= ")";
                }
                $randomStrategyGuidesGet = $this->database->query("SELECT * FROM strategyguides WHERE timecreated > '".(time()-604800)."' ".$requiredId." ORDER BY favorites LIMIT 20 OFFSET " . $offset);
            } else {
                $randomStrategyGuidesGet = $this->database->query("SELECT * FROM strategyguides WHERE timecreated > '".(time()-604800)."' ORDER BY favorites LIMIT 20 OFFSET " . $offset);
            }
            while ($randomStrategyGuide = $randomStrategyGuidesGet->fetch_assoc()) {
                $strategyGuide = new \model\StrategyGuide($this->database, $randomStrategyGuide['id']);
                $author = new \model\User($this->database, $randomStrategyGuide['uid']);
                array_push($this->featuredStrategyGuides, $strategyGuide);
                array_push($this->featuredStrategyGuideAuthors, $author);
            }

            $this->featuredGames = Array();
            if ($this->userIsLoggedIn) {
                $randomGamesGet = $this->database->query("SELECT * FROM games ORDER BY RAND() LIMIT 20 OFFSET " . $offset);
            } else {
                $randomGamesGet = $this->database->query("SELECT * FROM games ORDER BY RAND() LIMIT 20 OFFSET " . $offset);
            }
            while ($randomGame = $randomGamesGet->fetch_assoc()) {
                $game = new \model\Game($this->database, $randomGame['id']);
                array_push($this->featuredGames, $game);
            }

            $this->loadViewWithHeaderFooter("user", "explore");
        }
    }

?>