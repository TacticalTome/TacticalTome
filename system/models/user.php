<?php

    namespace model;

    class User {
        public static int $emailMaxLength = 100;
        public static int $usernameMaxLength = 20;

        private int $id;
        private string $email;
        private string $username;
        private string $password;
        private int $timeCreated;
        private bool $activated;
        private int $timeLastPosted;
        private array $followedGames;
        private array $favoriteStrategyGuides;
        private bool $moderator;
        private bool $banned;
        private bool $isValid = false;

        private Database $database;
        private array $mysqli; 

        public function __construct(Database $database, int $id) {
            $this->database = $database;
            $id = $this->database->protect($id);
            $get = $this->database->query("SELECT * FROM user WHERE id='$id'");
            if ($get->num_rows > 0) {
                $this->mysqli = $get->fetch_assoc();
                $this->isValid = true;

                $this->id = $this->mysqli['id'];
                $this->email = $this->mysqli['email'];
                $this->username = $this->mysqli['username'];
                $this->password = $this->mysqli['password'];
                $this->followedGames = explode(",", $this->mysqli['followedgames']);
                $this->favoriteStrategyGuides = explode(",", $this->mysqli['favoritestrategyguides']);
                $this->timeCreated = $this->mysqli['timecreated'];
                $this->activated = $this->mysqli['activated'];
                $this->timeLastPosted = $this->mysqli['lastposted'];

                for ($i = 0; $i < count($this->followedGames); $i++) {
                    $this->followedGames[$i] = intval($this->followedGames[$i]);
                }

                for ($i = 0; $i < count($this->favoriteStrategyGuides); $i++) {
                    $this->favoriteStrategyGuides[$i] = intval($this->favoriteStrategyGuides[$i]);
                }

                if (count($this->favoriteStrategyGuides) == 1 && $this->favoriteStrategyGuides[0] == 0) $this->favoriteStrategyGuides = Array();
                if (count($this->followedGames) == 1 && $this->followedGames[0] == 0) $this->followedGames = Array();

                $this->moderator = $this->mysqli['moderator'];
                $this->banned = $this->mysqli['banned'];
            }
        }

        public function addFollowedGame(int $id) {
            $id = $this->database->protect($id);
            if (!in_array($id, $this->followedGames)) {
                array_push($this->followedGames, $id);
                $this->updateFollowedGame();
            }
        }

        public function removeFollowedGame(int $id) {
            if (in_array($id, $this->followedGames)) {
                unset($this->followedGames[array_search($id, $this->followedGames)]);
                $this->updateFollowedGame(); 
            }
        }

        public function addFavoriteStrategyGuide(int $id) {
            $id = $this->database->protect($id);
            if (!in_array($id, $this->favoriteStrategyGuides)) {
                array_push($this->favoriteStrategyGuides, $id);
                $this->updateFavoriteStrategyGuides();
            }
        }

        public function removeFavoriteStrategyGuide(int $id) {
            if (in_array($id, $this->favoriteStrategyGuides)) {
                unset($this->favoriteStrategyGuides[array_search($id, $this->favoriteStrategyGuides)]);
                $this->updateFavoriteStrategyGuides(); 
            }
        }

        private function updateFollowedGame(): void {
            $this->followedGames = array_filter($this->followedGames);
            $pushToDatabase = implode(",", $this->followedGames);
            $update = $this->database->query("UPDATE user SET followedgames='$pushToDatabase' WHERE id='".$this->id."'");
        }

        private function updateFavoriteStrategyGuides(): void {
            $this->favoriteStrategyGuides = array_filter($this->favoriteStrategyGuides);
            $pushToDatabase = implode(",", $this->favoriteStrategyGuides);
            $update = $this->database->query("UPDATE user SET favoritestrategyguides='$pushToDatabase' WHERE id='".$this->id."'");
        }

        private function updateBanStatus(): void {
            $this->database->query("UPDATE user SET banned='".$this->banned."' WHERE id='".$this->id."'");
        }

        public function isValid(): bool {
            return $this->isValid;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getUsername(): string {
            return $this->username;
        }

        public function getPassword(): string {
            return $this->password;
        }

        public function getTimeCreated(): int {
            return $this->timeCreated;
        }

        public function isFollowingGame(int $id): bool {
            return in_array($id, $this->followedGames);
        }

        public function isStrategyGuideFavorite(int $id): bool {
            return in_array($id, $this->favoriteStrategyGuides);
        }

        public function getFollowedGames(): Array {
            return $this->followedGames;
        }

        public function getFavoriteStrategyGuides(): Array {
            return $this->favoriteStrategyGuides;
        }

        public function getTimeSinceLastPosted(): int {
            return $this->timeLastPosted;
        }

        public function isModerator(): bool {
            return $this->moderator;
        }

        public function isBanned(): bool {
            return $this->banned;
        }

        public function ban(): void {
            $this->banned = true;
            $this->updateBanStatus();
        }

        public function removeBan(): void {
            $this->banned = false;
            $this->updateBanStatus();
        }

        public function setTimeSinceLastPosted(int $time): void {
            $this->timeLastPosted = $time;
            $this->database->query("UPDATE user SET lastposted='$time' WHERE id='".$this->id."'");
        }

        public function setPassword(string $password): void {
            $this->password = $password;
            $this->database->query("UPDATE user SET password='$password' WHERE id='".$this->id."'");
        }

        public function setEmail(string $email): void {
            $this->email = $this->database->protect($email);
            $this->database->query("UPDATE user SET email='".$this->email."' WHERE id='".$this->id."'");
        }

        public function getProfileURL(): string {
            return \URL . "user/view/" . $this->id . "/";
        }

        static public function login(Database $database, string $identifier, string $password) {
            $identifier = $database->protect($identifier);

            $checkCredentials = $database->query("SELECT * FROM user WHERE email='$identifier' OR username='$identifier'");
            if ($checkCredentials->num_rows == 1) {
                $credentials = $checkCredentials->fetch_assoc();
                if (password_verify($password, $credentials['password'])) {
                    if ($credentials['activated']) {
                        if (!$credentials['banned']) {
                            $_SESSION['uid'] = $credentials['id'];
                        } else {
                            throw new \Exception("Your account has been banned and can no longer be accessed");
                        }
                    } else {
                        throw new \Exception("Your account is not activated. Please check your email for your activation code.");
                    }
                } else {
                    throw new \Exception("Password is incorrect");
                }
            } else {
                throw new \Exception("No such user with that email or username exists");
            }
        }

        static public function register(Database $database, string $email, string $username, string $password) {
            $email = $database->protect($email);
            $username = $database->protect($username);

            if (!self::isEmailValid($email)) throw new \Exception("Email is invalid");
            if (!self::isUsernameValid($username)) throw new \Exception("Username is invalid");

            $checkIfTaken = $database->query("SELECT * FROM user WHERE email='$email' OR username='$username'");
            if ($checkIfTaken->num_rows == 0) {
                $password = password_hash($password, PASSWORD_DEFAULT);

                $insert = $database->query("INSERT INTO user (email, username, password, timecreated) VALUES ('$email', '$username', '$password', '".time()."')");
            } else {
                throw new \Exception("Email or Username is already in use");
            }
        }

        static public function isEmailTaken(Database $database, string $email): bool {
            $email = $database->protect($email);
            $query = $database->query("SELECT * FROM user WHERE email='$email'");
            if ($query->num_rows > 0) return true;
            return false;
        }

        static public function isEmailValid(string $email): bool {
            if (strlen($email) <= self::$emailMaxLength) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $invalidEmails = file(\LIBRARY_DIRECTORY . "invalidemaildomains.txt", FILE_IGNORE_NEW_LINES);

                    if (!in_array(substr($email, strpos($email, "@") + 1), $invalidEmails)) {
                        return true;
                    }
                }
            }

            return false;
        }

        static private function isUsernameValid(string $username): bool {
            if (strlen($username) <= self::$usernameMaxLength) {
                if (!preg_match('/[^A-Za-z0-9]/', $username)) {
                    return true;
                }
            }

            return false;
        }
    }

?>