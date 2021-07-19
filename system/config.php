<?php

	/*
		Sessions
	*/
	session_start();

	/*
		PHP Settings
	*/
	error_reporting(E_ALL);

	/*
		URL
	*/
	define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/tacticaltome/");
	define("GITHUB_URL", "https://github.com/TacticalTome/TacticalTome");

	/*
		Website Properties
	*/
	define("WEBSITE_NAME", "Tactical Tome");
	define("WEBSITE_EMAIL", "tanktotgames@gmail.com");
	define("WEBSITE_EMAIL_PASSWORD", "notmypassword");
	define("ALLOW_REGISTRATION", true);
	define("ALLOW_SENDING_EMAILS", false);

	/*
		Database Properties
	*/
	define("DATABASE_HOST", "localhost");
	define("DATABASE_USERNAME", "root");
	define("DATABASE_PASSWORD", "");
	define("DATABASE_NAME", "tacticaltome");

	/*
		reCAPTCHA 
		All reCAPTCHA using this key will pass and will show a warning message (These should not be used in production)
		Can be grabbed from: https://www.google.com/recaptcha/admin/create

		(Please be aware that these keys will not be used on the final website and they are developer keys provided by Google)
	*/
	define("ENABLE_RECAPTCHA", true);
	define("RECAPTCHA_SITE_KEY", "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI");
	define("RECAPTCHA_SECRET_KEY", "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe");

	/*
		Directories
	*/
	define("CORE_DIRECTORY", __DIR__ . "/core/");
	define("LIBRARY_DIRECTORY", __DIR__ . "/libraries/");
	define("CONTROLLER_DIRECTORY", __DIR__ . "/controllers/");
	define("MODEL_DIRECTORY", __DIR__ . "/models/");
	define("VIEW_DIRECTORY", __DIR__ . "/views/");
	define("TEMPLATE_DIRECTORY", __DIR__ . "/templates/");

	/*
		API Keys

		(You must get this from the steam API)
	*/
	define("STEAMAPI_KEY", "keyforsite");

	/*
		Misc.
	*/
	define("WEBSITE_VERSION", "1.1.1");
	define("STYLESHEET_JAVASCRIPT_VERSIONS", Array(
		"framework.css" => "1.1",
		"main.css" => "1.0",
		"carousel.js" => "1.0",
		"editor.js" => "1.0",
		"formvalidation.js" => "1.0",
		"framework.js" => "1.0"
	));
	date_default_timezone_set("America/Chicago");