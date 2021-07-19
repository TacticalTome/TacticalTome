<?php

    namespace model;

    class ApiResult {
        private array $data;

        public function __construct() {
            $this->data["success"] = false;
            $this->data["errors"] = Array();
            $this->data["data"] = Array();
        }

        public function addError(string $error): void {
            array_push($this->data["errors"], $error);
        }

        public function addData(string $key, int|string|array $value): void {
            $this->data["data"][$key] = $value;
        }

        public function addArray(Array $array) {
            array_push($this->data["data"], $array);
        }

        public function setSuccess(bool $success): void {
            $this->data["success"] = $success;
        }

        public function getData(): array {
            return $this->data;
        }

        public function getDataAsJSON(): string {
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }