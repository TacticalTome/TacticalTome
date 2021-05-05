<?php
	
	session_start();
	error_reporting(E_ALL);
	
	define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/gamershandbook/");
	define("WEBSITE_NAME", "Website Name");
	define("ALLOW_REGISTRATION", true);

	define("ROOT_DIRECTORY", $_SERVER['DOCUMENT_ROOT'] . "/gamershandbook/");
	define("SYSTEM_DIRECTORY", ROOT_DIRECTORY . "system/");
	define("LIBRARY_DIRECTORY", SYSTEM_DIRECTORY . "libraries/");
	define("CONTROLLER_DIRECTORY", SYSTEM_DIRECTORY . "controllers/");
	define("MODEL_DIRECTORY", SYSTEM_DIRECTORY . "models/");
	define("VIEW_DIRECTORY", SYSTEM_DIRECTORY . "views/");
	define("TEMPLATE_DIRECTORY", SYSTEM_DIRECTORY . "templates/");
	
	define("REMOVE_FROM_URL", "/gamershandbook/");

	date_default_timezone_set("America/Chicago");

?>