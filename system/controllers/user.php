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

                            $email = $this->database->protect($_POST['email']);
                            $password = md5(rand(time()/2, time()));

                            $userGet = $this->database->query("SELECT * FROM user WHERE email='$email'");
                            $user = $userGet->fetch_assoc();

                            $this->database->query("INSERT INTO confirmations (uid, action, password, value, time) VALUES ('".$user['id']."', 'activateaccount', '$password', '$email', '".time()."')");
                            mail($user['email'], "Confirm Account", "Please confirm your account by clicking the link below.\n" . \URL . "user/confirm/activateaccount/" . $password . "/". $email . "/");

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

        public function account() {
            if ($this->userIsLoggedIn) {
                if (!empty($_POST['changepassword'])) {
                    if (!empty($_POST['password']) && !empty($_POST['newpassword']) && !empty($_POST['confirmnewpassword'])) {
                        if (password_verify($_POST['password'], $this->user->getPassword())) {
                            if ($_POST['newpassword'] == $_POST['confirmnewpassword']) {
                                $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                                $this->user->setPassword($password);
                                array_push($this->formErrors, "Password updated");
                            } else {
                                array_push($this->formErrors, "Passwords do not match");
                            }
                        } else {
                            array_push($this->formErrors, "Incorrect Password");
                        }
                    } else {
                        array_push($this->formErrors, "Please supply all the fields");
                    }
                } else if (!empty($_POST['changeemail'])) {
                    if (!empty($_POST['newemail'])) {
                        if (\model\User::isEmailValid($_POST['newemail']) && !\model\User::isEmailTaken($this->database, $_POST['newemail'])) {
                            $email = $this->database->protect($_POST['newemail']);
                            $password = md5(rand(time()/2, time()));

                            $this->database->query("INSERT INTO confirmations (uid, action, password, value, time) VALUES ('".$this->user->getId()."', 'newemail', '$password', '$email', '".time()."')");
                            mail($this->user->getEmail(), "Change Email", "You have been requested to change your email to: " . $email . "\nClick the link below to confirm this action.\n" . \URL . "user/confirm/newemail/" . $password . "/". $email . "/");
                            array_push($this->formErrors, "You have been sent an email to confirm your request");
                        } else {
                            array_push($this->formErrors, "The email you have provided is either invalid or already in use");
                        }
                    } else {
                        array_push($this->formErrors, "Please supply all the fields");
                    }
                }

                $this->loadViewWithHeaderFooter("user", "account");
            } else {
                header("location: " . \URL . "user/login/");
            }
        }

        public function confirm(string $action = null, string $password = null, string $value = null) {
            if (!is_null($action) && !is_null($password) && !is_null($value)) {
                $action = $this->database->protect($action);
                $password = $this->database->protect($password);
                $value = $this->database->protect($value);

                $query = $this->database->query("SELECT * FROM confirmations WHERE action='$action' AND password='$password' AND value='$value'");
                if ($query->num_rows > 0) {
                    $confirmation = $query->fetch_assoc();
                    $this->database->query("DELETE FROM confirmations WHERE id='".$confirmation['id']."'");

                    $this->actionText = "Confirmed";

                    switch ($action) {
                        case "activateaccount":
                            $this->database->query("UPDATE user SET activated='1' WHERE id='".$confirmation['uid']."'");
                            $this->actionText = "Activated account";
                            break;

                        case "newemail":
                            if ($this->userIsLoggedIn && $this->user->getId() == $confirmation['uid']) {
                                $this->user->setEmail($value);
                                $this->actionText = "Changed email";
                            }
                            break;
                    }

                    $this->loadViewWithHeaderFooter("user", "confirm");
                } else {
                    $this->unknownpage();
                }
            } else {
                $this->unknownPage();
            }
        }
    }

?>