<?php

	namespace model;
	
	class URL {
		private string $content;
		private string $controller = "index";
		private string $method = "index";
		private Array $parameters = array();
		
		public function __construct(string $URL) {
			$this->content = str_replace(\URL, "", $URL);

			$this->parseContent();
		}
		
		private function parseContent() {
			$content = explode("/", $this->content);
			
			if (isset($content[0]) && !empty($content[0])) $this->controller = $content[0];
			if (isset($content[1]) && !empty($content[1])) $this->method = $content[1];
			if (isset($content[2]) && !empty($content[2])) {
				for ($i = 2; $i < count($content); $i++) {
					if (!empty($content[$i])) array_push($this->parameters, $content[$i]);
				}
			}
		}
		
		public function getController(): string {
			return $this->controller;
		}
		
		public function getMethod(): string {
			return $this->method;
		}
		
		public function getParameters(): Array {
			return $this->parameters;
		}
	}