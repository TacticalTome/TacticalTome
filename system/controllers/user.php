<?php

    namespace controller;

    class User extends \core\Controller {
        public function login() {
            if ($this->userIsLoggedIn) header("location: " . \URL);

            $this->pageIdentifier = "Login";
            $this->pageTitle = "Login - " . \WEBSITE_NAME;

            if (!empty($_POST['login'])) {
                try {
                    if (empty($_POST['usernameOrEmail']) || empty($_POST['password'])) throw new \Exception("Please supply all the fields");
                    \model\User::login($this->database, $_POST['usernameOrEmail'], $_POST['password']);
                    header("location: " . \URL);
                } catch (\Exception $exception) {
                    array_push($this->formErrors, $exception->getMessage());
                }
            }

            $this->loadViewWithHeaderFooter("user", "login");
        }

        public function signup() { $this->register(); }
        public function register() {
            if ($this->userIsLoggedIn) header("location: " . \URL);

            $this->pageIdentifier = "Register";
            $this->pageTitle = "Register - " . \WEBSITE_NAME;

            $this->loadModel("confirmation");

            if (!empty($_POST['register'])) {
                try {
                    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['confirmpassword']) || empty($_POST['g-recaptcha-response'])) throw new \Exception("Please supply all the fields");
                    if ($_POST['password'] != $_POST['confirmpassword']) throw new \Exception("Passwords do no match");
                    if (!\utility\isReCaptchaValid($_POST['g-recaptcha-response'])) throw new \Exception("The captcha needs to be completed correctly");

                    \model\User::register($this->database, $_POST['email'], $_POST['username'], $_POST['password']);
                    \model\Confirmation::new($this->database, \model\User::getWithEmail($this->database, $_POST['email'])->getId(), "activateaccount", \model\Confirmation::generatePassword(), $_POST['email'], $_POST['email']);
                    
                    header("location: " . \URL . "user/login/");
                } catch (\Exception $exception) {
                    array_push($this->formErrors, $exception->getMessage());
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

            $this->loadModel("strategyguide");

            $offset = 0;
            if (!is_null($page)) $offset = intval($page) * 20;

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

            $this->action = $action;
            $this->page = $page;
            if (is_null($this->page)) $this->page = 0;

            $this->featuredStrategyGuides = Array();
            while ($randomStrategyGuide = $randomStrategyGuidesGet->fetch_assoc()) {
                $strategyGuide = new \model\StrategyGuide($this->database, $randomStrategyGuide['id']);
                array_push($this->featuredStrategyGuides, $strategyGuide);
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

        public function account() {
            if (!$this->userIsLoggedIn) header("location: " . \URL . "user/login/");

            $this->pageIdentifier = "Account";
            $this->pageTitle = "Your Account - " . \WEBSITE_NAME;

            $this->loadModel("strategyguide", "confirmation");

            if (!empty($_POST['changepassword'])) {
                try {
                    if (empty($_POST['password']) || empty($_POST['newpassword']) || empty($_POST['confirmnewpassword'])) throw new \Exception("Please supply all the fields");
                    if (!password_verify($_POST['password'], $this->user->getPassword())) throw new \Exception("Incorrect Password");
                    if ($_POST['newpassword'] != $_POST['confirmnewpassword']) throw new \Exception("Passwords do no match");

                    $this->user->setPassword(password_hash($_POST['newpassword'], PASSWORD_DEFAULT));
                    array_Push($this->formErrors, "Password updated");
                } catch (\Exception $exception) {
                    array_push($this->formErrors, $exception->getMessage());
                }
            }

            if (!empty($_POST['changeemail'])) {
                try {
                    if (empty($_POST['newemail'])) throw new \Exception("Please supply all the fields");
                    if (!\model\User::isEmailValid($_POST['newemail'])) throw new \Exception("Email is invalid");
                    if (\model\User::isEmailTaken($this->database, $_POST['newemail'])) throw new \Exception("Email is already in use");

                    \model\Confirmation::new($this->database, $this->user->getId(), "newemail", \model\Confirmation::generatePassword(), $_POST['newemail'], $this->user->getEmail());
                    array_push($this->formErrors, "You have been sent an email to confirm your request");
                } catch (\Exception $exception) {
                    array_push($this->formErrors, $exception->getMessage());
                }
            }

            $this->userStrategyGuides = Array();
            $query = $this->database->query("SELECT * FROM strategyguides WHERE uid='".$this->user->getId()."'");
            while ($get = $query->fetch_assoc()) {
                $guide = new \model\StrategyGuide($this->database, $get['id']);
                array_push($this->userStrategyGuides, $guide);
            }

            $this->loadViewWithHeaderFooter("user", "account");
        }

        public function confirm(string $action = null, string $password = null, string $value = null) {
            if (is_null($action) || is_null($password) || is_null($value)) return $this->unknownPage();

            $this->loadModel("confirmation");

            $confirmation = new \model\Confirmation($this->database, $action, $password, $value);
            if ($confirmation->exists()) {
                \model\Confirmation::delete($this->database, $confirmation->getId());
                $this->actionText = "Confirmed";

                switch ($action) {
                    case "activateaccount":
                        $this->database->query("UPDATE user SET activated='1' WHERE id='".$confirmation->getUserId()."'");
                        $this->actionText = "Activated account";
                        break;

                    case "newemail":
                        if ($this->userIsLoggedIn && $this->user->getId() == $confirmation->getUserId()) {
                            $this->user->setEmail($value);
                            $this->actionText = "Changed email";
                        }
                        break;
                }

                $this->loadViewWithHeaderFooter("user", "confirm");
            } else {
                $this->unknownPage();
            }
        }

        public function view(int $id = null) {
            if (is_null($id)) return $this->unknownPage();

            $this->userProfile = new \model\User($this->database, $id);
            if ($this->userProfile->isValid()) {
                $this->pageIdentifier = "Profile";
                $this->pageTitle = $this->userProfile->getUsername() . " - " . \WEBSITE_NAME;

                $this->loadModel("strategyguide");

                $this->userStrategyGuides = Array();
                $query = $this->database->query("SELECT * FROM strategyguides WHERE uid='".$this->userProfile->getId()."'");
                while ($get = $query->fetch_assoc()) {
                    array_push($this->userStrategyGuides, new \model\StrategyGuide($this->database, $get['id']));
                }

                $this->userFollowedGames = Array();
                foreach ($this->userProfile->getFollowedGames() as $followedGame) {
                    if (!empty($followedGame)) array_push($this->userFollowedGames, new \model\Game($this->database, $followedGame));
                }

                $this->userFavoriteStrategyGuides = Array();
                foreach ($this->userProfile->getFavoriteStrategyGuides() as $strategyGuide) {
                    if (!empty($strategyGuide)) array_push($this->userFavoriteStrategyGuides, new \model\StrategyGuide($this->database, $strategyGuide));
                }

                $this->loadViewWithHeaderFooter("user", "view");
            } else {
                return $this->unknownPage();
            }
        }

        public function followedGames() {
            if (!$this->userIsLoggedIn) return $this->unknownPage();

            $this->pageIdentifier = "View Followed Games";
            $this->pageTitle = "Your Followed Games - " . \WEBSITE_NAME;

            $this->followedGames = Array();
            foreach ($this->user->getFollowedGames() as $gameId) {
                if (!empty($gameId)) {
                    array_push($this->followedGames, new \model\Game($this->database, $gameId));
                }
            }

            $this->loadViewWithHeaderFooter("user", "followedgames");
        }
    }