<?php

    namespace model;

    class Game {
        private int $id;
        private string $name;
        private string $description;
        private array $tags;
        private string $banner;
        private string $cover;
        private bool $hasNews = false;
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
                $this->tags = explode(",", $this->mysqli['tags']);
                $this->banner = $this->mysqli['banner'];
                $this->cover = $possibleCovers[array_rand($possibleCovers)];
                $this->hasNews = $this->mysqli['news'];

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

        public function getTags(): array {
            return $this->tags;
        }

        public function getBannerURL(): string {
            return $this->bannerURL;
        }

        public function getCoverURL(): string {
            return $this->coverURL;
        }

        public function hasNews(): bool {
            return $this->hasNews;
        }

        public function exists(): bool {
            return $this->exists;
        }
    }

?>