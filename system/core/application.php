<?php

	namespace core;
	
	require_once(LIBRARY_DIRECTORY . "utility.php");

	class Application {
		private URL $URL;
		
		public function __construct() {
			$URL = new \model\URL(\utility\getCurrentURL());
			
			if (file_exists(\CONTROLLER_DIRECTORY . strtolower($URL->getController()) . ".php")) {
				$controller = strtolower($URL->getController());
				$method = strtolower($URL->getMethod());
				$controllerClassName = "\\controller\\" . $controller;
				
				require_once(\CONTROLLER_DIRECTORY . $controller . ".php");
				if (method_exists($controllerClassName, $method)) {
					$database = new \model\Database(\DATABASE_HOST, \DATABASE_USERNAME, \DATABASE_PASSWORD, \DATABASE_NAME);
					
					$controllerClass = new $controllerClassName($database);
					call_user_func_array(array($controllerClass, $method), $URL->getParameters());
				} else {
					self::unknownPage();
				}
			} else {
				self::unknownPage();
			}
		}
		
		public static function unknownPage(): void {
			require_once(VIEW_DIRECTORY . "error/unknownpage.php");
		}
	}