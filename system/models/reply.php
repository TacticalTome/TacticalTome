<?php

    namespace model;

    class Reply {
        private int $id;
        private int $userId;
        private int $strategyGuideId;
        private string $content;
        private int $timeCreated;
        private bool $exists = false;

        private Database $database;
        private Array $mysqli;

        public function __construct(Database &$database, int $id, Array $mysqli = array()) {
            $this->database = $database;
            $this->id = $this->database->protect($id);

            if (isset($mysqli) && !empty($mysqli)) {
                $this->mysqli = $mysqli;
            } else {
                $get = $this->database->query("SELECT * FROM replies WHERE id='".$this->id."'");
                if ($get->num_rows > 0) {
                    $this->mysqli = $get->fetch_assoc();
                }
            }

            if (isset($this->mysqli) && !empty($this->mysqli)) {
                $this->userId = $this->mysqli['uid'];
                $this->strategyGuideId = $this->mysqli['sid'];
                $this->content = $this->mysqli['content'];
                $this->timeCreated = $this->mysqli['timecreated'];

                $this->exists = true;
            }
        }

        public function getId(): int {
            return $this->id;
        }

        public function getUserId(): int {
            return $this->userId;
        }

        public function getStrategyGuideId(): int {
            return $this->strategyGuideId;
        }

        public function getContent(): string {
            return $this->content;
        }

        public function getTimeCreated(): int {
            return $this->timeCreated;
        }

        public function exists(): bool {
            return $this->exists;
        }

        public static function delete(Database &$database, int $id): void {
            $id = $database->protect($id);
            $database->query("DELETE FROM replies WHERE id='$id'");
        }

        public static function getAllStrategyGuideReplies(Database &$database, int $strategyGuideId): Array {
            $result = Array();
            $strategyGuideId = $database->protect($strategyGuideId);
            $get = $database->query("SELECT * FROM replies WHERE sid='$strategyGuideId'");
            while ($reply = $get->fetch_assoc()) {
                array_push($result, new Reply($database, $reply['id'], $reply));
            }
            return $result;
        }

        public static function new(Database $database, int $userId, int $strategyGuideId, string $content): void {
            $userId = $database->protect($userId);
            $strategyGuideId = $database->protect($strategyGuideId);
            $content = $database->protect($content);

            $database->query("INSERT INTO replies (uid, sid, content, timecreated) VALUES ('$userId', '$strategyGuideId', '$content', '".time()."')");
        }
    }