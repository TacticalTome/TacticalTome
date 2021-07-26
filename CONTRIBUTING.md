# Contributing
Tactical Tome is open up to contributions and it is advised to create an issue before beginning, so we know what you are working on and don't overwrite each other and to pre-approve features.

#### Dependencies
All of the following software are required in order to run the Tactical Tome
- Web Server
- PHP 8
- MySQL

All these dependencies can be filled by either XAMPP or WampServer (we recommend XAMPP). XAMPP or WampServer provide both Apache (web server) and MySQL.

## Opening up issues
After opening up an issue you may continue working on developing the proposed changes (Please make sure that noone else is working on the same thing). However, if you have proposed a new feature, please wait until a confirmation, from [@Paughton](https://github.com/Paughton/). There might be some already opened issues that have not yet been claimed or started, working upon those are greatly appreciated.

## Pull Requests
Please submit all file changes and contributions through pull requests (For more information on how to submit a pull reqest: [Github Docs](https://docs.github.com/en/github/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)). When committing please submit an empty `tacticaltome.sql` database file, meaning: no fields. The database file must only have table creation scripts, and no fields or `INSERT` queries. For an example of what we're looking for plesae look at the `tacticaltome.sql` in the repository.

## Installation
To install: open up git and type: `git clone https://github.com/TacticalTome/TacticalTome/.git` into a folder inside of a web server (I use XAMPP). Once the installation is complete, import the `tacticaltome.sql` into any MySQL management software/database (I use phpMyAdmin).

After installing the repository you must edit the `system/config.php` file to fit your system's credentials and also the `index.php` file to fit your database's credentials. Specifically you must edit the following PHP constants:
```PHP
define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/tacticaltome/");
define("DATABASE_HOST", "localhost");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "");
define("DATABASE_NAME", "tacticaltome");
```

#### Recommended steps for configuartion:
1. Change the `URL` constant to the URL of your local files (typically `localhost`)
2. Change the `WEBSITE_EMAIL` and `WEBSITE_EMAIL_PASSWORD` (if using gmail) to your email if you have mail setup with PHP (*Optional*)
3. Change the timezone to whatever you timezone you are in (*Optional*)
4. Change the database credentials

## MVC Format

The project is using a PHP MVC (model-view-controller) format. The URL structure of the Tactical Tome is as follows: `website.com/controllerName/viewName/param1/param2/.../`

All back-end (or server) functions are to be executed in the `controllers`. Each controller has the basic file format of:
```PHP
namespace controller;

class ControllerName extends library\Controller {
	public function index() { 
        /* this function loads the header file (template/header.php) and
        footer file (template.php) and loads the file provided in between */
        $this->loadViewWithHeaderFooter("folder", "file"); // folder/file.php
	}
    
    // This is a page with parameters
    // i.e. website.com/ControllerName/methodName/param1/
    public function methodName(string $param1 = null) {
    	// Sanitize all inputs from the user!
    	$param1 = $this->database->protect($param1);
	}
}
```

See [libraries/controller.php](https://github.com/TacticalTome/TacticalTome/blob/main/system/libraries/controller.php) for a list of all controller inherited values. For the method declarations with parameters in the URL it is necessary that you default the parameters to `null` which can be later used to see if the variable is set.

**Make sure to sanitize ALL inputs from the user using the Database model's function:** `protect`.

Models are objects that are easily able to be used in other controllers. For an example `User` and `Database` are models. All database queries should be handled by models, unless it is a `while (fetch_assoc())` method or any other method (accessing multiple rows or any other special case). Models are automatically loaded when they are called from the `autloader.php` file. **All models should sanitize (`database->protect`) all incoming input**. Models are initialized the a similar way to controllers (with a different namespace):
```PHP
namespace model;

class ModelName {
	private string $property;
    private Array $properties;
}
```

Views are files that contain all the HTML code and are what the user actually sees. All views are located in the following file structure: `views/ControllerName/ViewName.php`.

#### Example files
- [`controllers/user.php`](https://github.com/TacticalTome/TacticalTome/blob/main/system/controllers/user.php)
- [`models/user.php`](https://github.com/TacticalTome/TacticalTome/blob/main/system/models/user.php)
- [`views/game/view.php`](https://github.com/TacticalTome/TacticalTome/blob/main/system/views/game/view.php)

## Coding Formats
We will be using camel case for all PHP variables (`camelCaseVariable`). However SQL columns will have all their letters lowercased (`notcamelcasecolumn`).

Classes and models will have camel case where all beginning letters of a word will be capitalized i.e. `User` or `StrategyGuide`. (All files will have lowercased names)

Opening curly braces will not be on their own line.
```PHP
if ($x == $y) {
	// Do Stuff
}
```

## Database
If you have created a new table or column please make sure when exporting that no field creation queries are inside of the `tacticaltome.sql` file. I.e. `INSERT` queries. However table creation/modifications are allowed. This is to help prevent developer data when pulling, cloning, and exporting.

## Stylesheets
Our CSS rules are split up into two different categories: `main` and `framework`. Each category has it's own purpose.

The `framework.css` file is for all CSS rules that can be used in other projects as well (can be used anywhere without changing anything). This file utilizes the `[data-modifier="value"]` format for small changes to a class (like an attribute or defining class variable). For an example:
```CSS
hr[data-color="white"] { border-color: white; }
hr[data-color="yellow"] { border-color: yellow; }
hr[data-color="green"] { border-color: green; }
hr[data-color="orange"] { border-color: orange; }
```

The data tags can later be used for varying results:
```HTML
<hr data-color="white" data-length="long"> <!-- A long white line -->
<hr data-color="green" data-length="short"> <!-- A short green line -->
```

The `main.css` file is used for everything else and all CSS rules that are specific to the project (can't be used anywhere else).

## Closing
Make sure to read our [Getting Started Guide](https://github.com/TacticalTome/TacticalTome/blob/main/GETTINGSTARTED.md) if you have any questions or troubles on what to do. If you have any further questions please contact [@Paughton](https://github.com/Paughton/) or email him at [tanktotgames@gmail.com](mailto:tanktotgames@gmail.com)

#### This document will be updated regulary to clarify changes.