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
    }

?>