<?php

	namespace library;
	
	require_once(\LIBRARY_DIRECTORY . "url.php");
	require_once(\LIBRARY_DIRECTORY . "controller.php");
	require_once(\LIBRARY_DIRECTORY . "utility.php");
	require_once(\MODEL_DIRECTORY . "database.php");
	
	class Application {
		private URL $URL;
		
		public function __construct(string $db_host, string $db_username, string $db_password, string $db_name) {
			$URL = new URL(\utility\getCurrentURL());
			
			if (file_exists(\CONTROLLER_DIRECTORY . strtolower($URL->getController()) . ".php")) {
				$controller = strtolower($URL->getController());
				$method = strtolower($URL->getMethod());
				$parameters = $URL->getParameters();
				$className = "\\controller\\" . $controller;
				
				require_once(\CONTROLLER_DIRECTORY . $controller . ".php");
				if (method_exists($className, $method)) {
					$database = new \model\Database($db_host, $db_username, $db_password, $db_name);
					
					$controllerClass = new $className($database);
					call_user_func_array(array($controllerClass, $method), $parameters);
				} else {
					self::unknownPage();
				}
			} else {
				self::unknownPage();
			}
		}
		
		public static function unknownPage() {
			require_once(VIEW_DIRECTORY . "error/unknownpage.php");
		}
	}