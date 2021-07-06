<?php

    namespace model;

    class Game {
        private int $id;
        private string $name;
        private string $description;
        private string $developer;
        private array $tags;
        private string $banner;
        private array $cover;
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

                $this->id = $this->mysqli['id'];
                $this->name = $this->mysqli['name'];
                $this->description = $this->mysqli['description'];
                $this->developer = $this->mysqli['developer'];
                $this->tags = explode(",", $this->mysqli['tags']);
                $this->banner = $this->mysqli['banner'];
                $this->cover = explode(",", $this->mysqli['cover']);
                $this->steamAppId = $this->mysqli['steamappid'];
                $this->hasNews = $this->mysqli['news'];
                $this->followers = $this->mysqli['followers'];

                $this->bannerURL = $this->banner;
                $this->coverURL = $this->cover[array_rand($this->cover)];
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

        public function getCovers(): array {
            return $this->cover;
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

        public function getRecentStrategyGuides(int $amount): array {
            $recentStrategyGuides = Array();
            $query = $this->database->query("SELECT * FROM strategyguides WHERE gid='".$this->id."' ORDER BY timecreated DESC LIMIT ".$amount);
            while ($get = $query->fetch_assoc()) {
                array_push($recentStrategyGuides, new StrategyGuide($this->database, $get['id']));
            }

            return $recentStrategyGuides;
        }

        public function getPopularStrategyGuides(int $amount): array {
            $popularStrategyGuides = Array();
            $query = $this->database->query("SELECT * FROM strategyguides WHERE gid='".$this->id."' ORDER BY favorites DESC LIMIT ".$amount);
            while ($get = $query->fetch_assoc()) {
                array_push($popularStrategyGuides, new StrategyGuide($this->database, $get['id']));
            }

            return $popularStrategyGuides;
        }

        public function setFollowers(int $followers): void {
            $this->followers = $followers;
            $this->database->query("UPDATE games SET followers='".$this->followers."' WHERE id='".$this->id."'");
        }

        public function getURL() {
            return \URL . "game/view/" . $this->id . "/";
        }

        public function getNewStrategyGuideURL() {
            return \URL . "strategyguide/new/" . $this->id . "/";
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

        static public function getMostPopular(Database $database, int $amount): array {
            $mostPopularGames = Array();
            $query = $database->query("SELECT * FROM games ORDER BY followers DESC LIMIT ".$amount);
            while ($get = $query->fetch_assoc()) {
                array_push($mostPopularGames, new Game($database, $get['id']));
            }

            return $mostPopularGames;
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