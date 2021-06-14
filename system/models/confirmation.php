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

        public function __construct(Database $database, int $id) {
            $this->database = $database;
            $id = $this->database->protect($id);

            $query = $this->database->query("SELECT * FROM confirmations WHERE id='$id'");
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

        public static function new(Database $database, int $uid, string $action, string $password, string $value, string $email, string $emailTitle, string $emailContent): void {
            $uid = $database->protect($uid);
            $action = $database->protect($action);
            $value = $database->protect($value);

            $database->query("INSERT INTO confirmations (uid, action, password, value, time) VALUES ('$uid', '$action', '$password', '$value', '".time()."')");
            mail($email, $emailTitle, $emailContent);
        }

        public static function generatePassword() {
            return md5(rand(time()/2, time()*2));
        }
    }

?>