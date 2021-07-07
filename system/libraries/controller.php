<?php

	namespace library;
	
	class Controller {
		protected \model\Database $database;
		protected \model\User $user;
		protected Array $formErrors = array();
		protected string $pageTitle = \WEBSITE_NAME;
		protected string $pageIdentifier = "";
		protected string $pageDescription = \WEBSITE_NAME . " is an encyclopedia for game strategies, guides, tutorials, news, and more!";
		protected bool $userIsLoggedIn = false;
		
		public function __construct(\model\Database $database) {
			$this->database = $database;
			$this->loadModel("user", "game");

			if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
				$this->userIsLoggedIn = true;
				$this->user = new \model\User($this->database, $_SESSION['uid']);

				if ($this->user->isBanned()) {
					SESSION_DESTROY();
					header("location: " . \URL . "user/login/");
				}
			}
		}
		
		protected function loadModel(... $models) {	
			foreach ($models as $modelName) {
				$modelFile = MODEL_DIRECTORY . $modelName . ".php";

				if (file_exists($modelFile)) {
					require_once($modelFile);
				} else {
					throw new \Exception("Unkown model: " . $modelName);
				}
			}
		}

		protected function loadViewWithHeaderFooter($viewFolder, $viewName) {
			require_once(TEMPLATE_DIRECTORY . "header.php");
			$this->loadView($viewFolder, $viewName);
			require_once(TEMPLATE_DIRECTORY . "footer.php");
		}

		protected function loadView($viewFolder, $viewName) {
			$viewFile = VIEW_DIRECTORY . $viewFolder . "/" . $viewName . ".php";

			if (file_exists($viewFile)) {
				require_once($viewFile);
			} else {
				throw new \Exception("Unkown view: " . $viewFile);
			}
		}
		
		protected function output($string) {
			echo "<div class='output'>" . $string . "</div>";
		}

		protected function unknownPage() {
			Application::unknownPage();
		}
	}