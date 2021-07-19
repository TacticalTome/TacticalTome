<?php

    namespace model;

    class Confirmation {
        private int $id;
        private int $uid;
        private string $action;
        private string $password;
        private string $value;
        private int $time;
        private bool $exists = false;

        private Database $database;
        private Array $mysqli;

        public function __construct(Database $database, string $action, string $password, string $value) {
            $this->database = $database;
            $action = $this->database->protect($action);
            $password = $this->database->protect($password);
            $value = $this->database->protect($value);

            $query = $this->database->query("SELECT * FROM confirmations WHERE action='$action' AND password='$password' AND value='$value'");
            if ($query->num_rows == 1) {
                $this->exists = true;
                $this->mysqli = $query->fetch_assoc();

                $this->id = $this->mysqli['id'];
                $this->uid = $this->mysqli['uid'];
                $this->action = $this->mysqli['action'];
                $this->password = $this->mysqli['password'];
                $this->value = $this->mysqli['value'];
                $this->time = $this->mysqli['time'];
            }
        }

        public function getId(): int {
            return $this->id;
        }

        public function getUserId(): int {
            return $this->uid;
        }

        public function getAction(): string {
            return $this->action;
        }

        public function getPassword(): string {
            return $this->password;
        }

        public function getValue(): string {
            return $this->value;
        }

        public function getTime(): int {
            return $this->time;
        }

        public function exists(): bool {
            return $this->exists;
        }

        public static function new(Database $database, int $uid, string $action, string $password, string $value, string $email): void {
            $uid = $database->protect($uid);
            $action = $database->protect($action);
            $password = $database->protect($password);
            $value = $database->protect($value);
            
            switch ($action) {
                case "activateaccount":
                    $emailTitle = "Activate Account";
                    $emailContent = "Please confirm your account by clicking the link below.\n" . \URL . "user/confirm/activateaccount/" . $password . "/". $value . "/";
                    break;

                case "newemail":
                    $emailTitle = "Change Email";
                    $emailContent = "You have been requested to change your email to: " . $value . "\nClick the link below to confirm this action (If this was not you change your password and ignore this email).\n" . \URL . "user/confirm/newemail/" . $password . "/". $value . "/";
                    break;

                default:
                    $emailTitle = "Unknown action: $action";
                    $emailContent = "Please contact us at: " . \WEBSITE_EMAIL;
                    break;
            }

            $database->query("INSERT INTO confirmations (uid, action, password, value, time) VALUES ('$uid', '$action', '$password', '$value', '".time()."')");
            \utility\mailTo($email, $emailTitle, $emailContent);
        }

        public static function delete(Database $database, int $id): void {
            $database->query("DELETE FROM confirmations WHERE id='$id'");
        }

        public static function generatePassword() {
            return md5(rand(time()/2, time()*2));
        }
    }