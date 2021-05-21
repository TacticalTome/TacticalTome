<?php

    namespace model;

    class Game {
        private int $id;
        private string $name;
        private string $description;
        private string $developer;
        private array $tags;
        private string $banner;
        private string $cover;
        private int $steamAppId;
        private bool $hasNews = false;
        private int $followers;
        private bool $exists = false;

        private string $bannerURL;
        private string $coverURL;

        private Database $database;
        private array $mysqli;

        public function __construct(Database $database, int $id) {
            $this->database = $database;
            $id = $this->database->protect($id);

            $get = $this->database->query("SELECT * FROM games WHERE id='$id'");
            if ($get->num_rows == 1) {
                $this->exists = true;
                $this->mysqli = $get->fetch_assoc();

                $possibleCovers = explode(",", $this->mysqli['cover']);

                $this->id = $this->mysqli['id'];
                $this->name = $this->mysqli['name'];
                $this->description = $this->mysqli['description'];
                $this->developer = $this->mysqli['developer'];
                $this->tags = explode(",", $this->mysqli['tags']);
                $this->banner = $this->mysqli['banner'];
                $this->cover = $possibleCovers[array_rand($possibleCovers)];
                $this->steamAppId = $this->mysqli['steamappid'];
                $this->hasNews = $this->mysqli['news'];
                $this->followers = $this->mysqli['followers'];

                $this->bannerURL = \URL . "images/banners/" . $this->banner;
                $this->coverURL = \URL . "images/covers/" . $this->cover;
            }
        }

        public function getId(): int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function getDeveloper(): string {
            return $this->developer;
        }

        public function getShortDescription(): string {
            return substr($this->description, 0, 150) . " --";
        }

        public function getTags(): array {
            return $this->tags;
        }

        public function getBannerURL(): string {
            return $this->bannerURL;
        }

        public function getCoverURL(): string {
            return $this->coverURL;
        }

        public function getSteamAppId(): int {
            return $this->steamAppId;
        }

        public function hasNews(): bool {
            return $this->hasNews;
        }

        public function getFollowers(): int {
            return $this->followers;
        }

        public function exists(): bool {
            return $this->exists;
        }

        public function setFollowers(int $followers): void {
            $this->followers = $followers;
            $this->database->query("UPDATE games SET followers='".$this->followers."' WHERE id='".$this->id."'");
        }

        static public function existsWithSteamId(Database $database, int $steamId): bool {
            $steamId = $database->protect($steamId);
            $query = $database->query("SELECT * FROM games WHERE steamappid='$steamId'");
            if ($query->num_rows > 0) return true;
            return false;
        }

        static public function getGameIdWithSteamId(Database $database, int $steamId): int {
            $steamId = $database->protect($steamId);
            $query = $database->query("SELECT * FROM games WHERE steamappid='$steamId'");
            $result = $query->fetch_assoc();
            return $result['id'];
        }

        static public function new(Database $database, string $name, string $description, string $developer, string $tags, string $banner, string $cover, int $steamAppId): void {
            $name = $database->protect($name);
            $description = $database->protect($description);
            $developer = $database->protect($developer);
            $tags = $database->protect($tags);
            $banner = $database->protect($banner);
            $cover = $database->protect($cover);
            $steamAppId = $database->protect($steamAppId);

            $insert = $database->query("INSERT INTO games (name, description, developer, tags, banner, cover, steamappid, news) VALUES ('$name', '$description', '$developer', '$tags', '$banner', '$cover', '$steamAppId', '1')");
        }
    }

?>