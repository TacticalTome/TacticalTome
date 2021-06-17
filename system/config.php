<?php
	
	/*
		Sessions
	*/
	session_start();

	/*
		PHP Settings
	*/
	error_reporting(E_ALL);
	ini_set("allow_url_fopen", true);

	/*
		URL
	*/
	define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/gamershandbook/");

	/*
		Website Properties
	*/
	define("WEBSITE_NAME", "Gamer's Handbook");
	define("WEBSITE_EMAIL", "tanktotgames@gmail.com");
	define("ALLOW_REGISTRATION", true);

	/*
		reCAPTCHA 
		All reCAPTCHA using this key will pass and will show a warning message (These should not be used in production)
		Can be grabbed from: https://www.google.com/recaptcha/admin/create
	*/
	define("ENABLE_RECAPTCHA", true);
	define("RECAPTCHA_SITE_KEY", "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI");
	define("RECAPTCHA_SECRET_KEY", "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe");

	/*
		Directories
	*/
	define("ROOT_DIRECTORY", $_SERVER['DOCUMENT_ROOT'] . "/gamershandbook/");
	define("SYSTEM_DIRECTORY", ROOT_DIRECTORY . "system/");
	define("IMAGE_DIRECTORY", ROOT_DIRECTORY . "images/");
	define("LIBRARY_DIRECTORY", SYSTEM_DIRECTORY . "libraries/");
	define("CONTROLLER_DIRECTORY", SYSTEM_DIRECTORY . "controllers/");
	define("MODEL_DIRECTORY", SYSTEM_DIRECTORY . "models/");
	define("VIEW_DIRECTORY", SYSTEM_DIRECTORY . "views/");
	define("TEMPLATE_DIRECTORY", SYSTEM_DIRECTORY . "templates/");
	define("BANNER_DIRECTORY", IMAGE_DIRECTORY . "banners/");
	define("COVER_DIRECTORY", IMAGE_DIRECTORY . "covers/");

	/*
		Misc.
	*/
	date_default_timezone_set("America/Chicago");
	
?>