<?php

    namespace model;

    class StrategyGuide {
        private int $id;
        private int $uid; // user id
        private int $gid; // game id
        private string $title;
        private string $content;
        private int $timeCreated;
        private int $favorites;
        private bool $exists = false;

        private Database $database;
        private Array $mysqli;

        public function __construct(Database $database, int $id) {
            $this->database = $database;
            $id = $this->database->protect($id);

            $get = $this->database->query("SELECT * FROM strategyguides WHERE id='$id'");
            if ($get->num_rows == 1) {
                $this->exists = true;
                $this->mysqli = $get->fetch_assoc();

                $this->id = $this->mysqli['id'];
                $this->uid = $this->mysqli['uid'];
                $this->gid = $this->mysqli['gid'];
                $this->title = $this->mysqli['title'];
                $this->content = $this->mysqli['content'];
                $this->timeCreated = $this->mysqli['timecreated'];
                $this->favorites = $this->mysqli['favorites'];
            }
        }

        public function getId(): int {
            return $this->id;
        }

        public function getUserId(): int {
            return $this->uid;
        }

        public function getGameId(): int {
            return $this->gid;
        }

        public function getTitle(): string {
            return $this->title;
        }

        public function getContent(): string {
            return $this->content;
        }

        public function getTimeCreated(): string {
            return $this->timeCreated;
        }

        public function getFavorites(): int {
            return $this->favorites;
        }

        public function exists(): bool {
            return $this->exists;
        }

        public function getPreview(): string {
            return substr(strip_tags(str_replace("<br>", "\n", $this->content)), 0, 100) . "--";
        }

        public function setFavorites(int $favorites): void {
            $this->favorites = $favorites;
            $this->database->query("UPDATE strategyguides SET favorites='".$this->favorites."' WHERE id='".$this->id."'");
        }

        static public function new(Database $database, int $uid, int $gid, string $title, string $content) {
            $uid = $database->protect($uid);
            $gid = $database->protect($gid);
            $title = $database->protect($title);
            $content = $database->protect($content);

            $insert = $database->query("INSERT INTO strategyguides (uid, gid, title, content, timecreated) VALUES ('$uid', '$gid', '$title', '$content', '".time()."')");
        }

        static public function update(Database $database, int $id, string $title, string $content) {
            $id = $database->protect($id);
            $title = $database->protect($title);
            $content = $database->protect($content);

            $update = $database->query("UPDATE strategyguides SET title='$title', content='$content' WHERE id='$id'");
        }

        static public function delete(Database $database, int $id) {
            $id = $database->protect($id);

            $delete = $database->query("DELETE FROM strategyguides WHERE id='$id'");
        }
    }

?>