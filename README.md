# <a href="">Gamer's Handbook</a>
An encyclopedia for game strategies, guides, tutorials, news, and more!

<img alt="Gamer's Handbook Screenshot 1" src="https://github.com/Paughton/GamersHandbook/blob/main/images/webscreenshot1.png"><br>
<img alt="Gamer's Handbook Screenshot 2" src="https://github.com/Paughton/GamersHandbook/blob/main/images/webscreenshot2.PNG">

## Branches
`main` -> everything goes into here (default branch)

## Contributing
Gamer's Handbook is open up to contributions and it is advised to create an issue before beginning, so we know what you are working on and don't overwrite each other and to preapprove features.

After opening up an issue you may continue working on developing the proposed changes (Please make sure that noone else is working on the same thing). However, if you have proposed a new feature, please wait until a confirmation, from [@Paughton](https://github.com/Paughton/).

Please submit all file changes and contributions through pull requests (For more information on how to submit a pull reqest: [Github Docs](https://docs.github.com/en/github/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)). When committing please submit an empty `gamershandbook.sql` database file, meaning: no fields. The database file must only have table creation scripts, and no fields or `INSERT` queries. For an example of what we're looking for plesae look at the 	`gamershandbook.sql` in the repository.

#### Dependencies
All of the following software are requied in order to run the Gamer's Handbook
- Web Server
- PHP
- MySQL

All these dependencies can be filled by either XAMPP or WampServer (we recommend XAMPP). XAMPP or WampServer provide both Apache (web server) and MySQL.

## Installation and Usage
To install: open up git and type: `git clone https://github.com/Paughton/GamersHandbook.git` into a folder inside of a web server (I use XAMPP). Once the installation is complete, import the `gamershandbook.sql` into any MySQL management software/database (I use phpMyAdmin).

After installing the repository you must edit the `system/config.php` file to fit your system's credentials and also the `index.php` file to fit your database's credentials. Specifically you must edit the following PHP constants:
```PHP
define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/gamershandbook/");
define("ROOT_DIRECTORY", $_SERVER['DOCUMENT_ROOT'] . "/gamershandbook/");
define("REMOVE_FROM_URL", "/gamershandbook/");
date_default_timezone_set("America/Chicago");
```
In the main `index.php` file you need to change the following line:
```PHP
// library\Aplication($host, $username, $password, $dbName)
$application = new library\Application("localhost", "root", "", "gamershandbook");
```

#### Recommended Steps:
1. Change the `URL` constant to the URL of your local files (typically `localhost`)
2. Change the `ROOT_DIRECTORY` to wherever your files are located (base file)
3. The `REMOVE_FROMURL` variable is used to remove unneccesary infromation from the URL i.e. `/gamershandbook/` from `http://localhost:8080/gamershandbook/game/view/0` which helps parsing all the values after the `gamershandbook` in the URL (Change this if necessary)
4. Change the timezone to whatever you timezone you are in (*Optional*)
5. Change the databas credentials in the `index.php` file

## Releases
All releases will be pushed to the live version of the website. To view all releases and changes please see our [Changelog](https://github.com/Paughton/GamersHandbook/blob/main/CHANGELOG.md). The changelog file will change upon releases and will highlight the general changes. Once a release is made a new branch will be made for that release for archive purposes.

## Reporting a bug
In order to report a bug please open up an issue and apply the `Type: Bug` label. When creating an issue, please be as descriptive as possible and detail what lead up to the bug.

#### Please Include:
- Type
- What happened?
- What did you do in order to produce the bug?
- How much did it hinder your usage of the site? (i.e. Urgency)

## Credits
Main Contributors
- [@Paughton](https://github.com/Paughton/)

## Live Website
None is currently available at the moment, soon to change.

## License
See [GitHub's terms of services](https://docs.github.com/en/github/site-policy/github-terms-of-service)

(c) 2021 Gamer's Handbook. All Rights Reserved.