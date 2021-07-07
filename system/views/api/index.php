<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">API Documentation</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h1 class="fontTrebuchet" data-size="large">Getting Started</h1>
        <p class="fontVerdana">Our API allows you build custom applications integrated with the <?= \WEBSITE_NAME; ?> database.  If you have a specific need and programming talent, you can build the solution you're looking for using the data we provide.</p>
        <p class="fontVerdana">You can use any programming language you'd like, and we recommend choosing a programming langauge that can access webpages and grab it's contents.</p>
        <p class="fontVerdana">If you would like to add a feature to the Gamer's Handbook yourself, please navigate to your <a href="https://github.com/Paughton/GamersHandbook" target="_blank">Github page</a>.</p>
        <p class="fontVerdana" data-fontsize="small"><b>When using our API you agree to our <a href="<?= \URL; ?>legal/termsofservice/" target="_blank">Terms of Service</a>.</b></p>

        <div class="spacer" data-size="medium"></div>
        <hr data-color="black">
        <div class="spacer" data-size="medium"></div>

        <!-- 
            Game 
        -->
        <h1 class="fontTrebuchet" data-size="large">Games</h1>
        <hr data-thin="true">
        <h2 class="fontTrebuchet">Show Game Information</h2>
        <p class="fontTrebuchet" data-fontcolor="gray"><?= \URL; ?>api/game/get/[GAME_ID]/<p>
        
        <div class="row" data-colcount="2" style="width: 100%;">
            <div class="column" style="width: 50%;">
                <p class="fontVerdana"><b>Example Request (Using PHP)</b></p>
                <p class="fontVerdana" data-fontcolor="gray" data-fontsize="small"><?= \URL; ?>api/game/get/1/</p>
                <pre style="width: 90%;"><code>
$apiResult = file_get_contents("<?= \URL; ?>api/game/get/1/");
$data = json_decode($apiResult);
print_r($data); // Prints out the data
                </code></pre>
            </div>

            <div class="column" style="width: 50%;">
                <p class="fontVerdana"><b>Example Response (JSON)</b></p>
                <pre style="width: 90%; max-height: 25em;"><code>
{
    "success": true,
    "errors": [],
    "data": {
        "id": 1,
        "name": "Stronghold Crusader HD",
        "description": "The highly anticipated sequel to the best-selling Stronghold, Stronghold Crusader HD throws you into historic battles and castle sieges from the Crusades with fiendish AI opponents, new units, 4 historical campaigns and over 100 unique skirmish missions.",
        "developer": [
            "Simulation",
            "Strategy"
        ],
        "banner": "Banner image URL",
        "cover": [
            "Cover image URL #1",
            "Cover image URL #2",
            "Cover image URL #3",
            "Cover image URL #4",
            "Cover image URL #5"
        ],
        "steamappid": 40970,
        "followers": 5,
        "url": "URL to view the game",
        "newstrategyguideurl": "URL to create a new strategy guide"
    }
}
                </code></pre>
            </div>
        </div>
        <h5 class="fontTrebuchet"><b>Description</b></h5>
        <p class="fontVerdana">Shows all the data for a specific game by it's ID.</p>

        <div class="spacer" data-size="medium"></div>
        <hr data-thin="true">
        <div class="spacer" data-size="medium"></div>

        <!-- 
            Strategy Guides 
        -->
        <h1 class="fontTrebuchet" data-size="large">Strategy Guides</h1>
        <hr data-thin="true">
        <h2 class="fontTrebuchet">Show Strategy Guide Information</h2>
        <p class="fontTrebuchet" data-fontcolor="gray"><?= \URL; ?>api/strategyguide/get/[STRATEGY_GUIDE_ID]/<p>

        <div class="row" data-colcount="2" style="width: 100%;">
            <div class="column" style="width: 50%;">
                <p class="fontVerdana"><b>Example Request (Using PHP)</b></p>
                <p class="fontVerdana" data-fontcolor="gray" data-fontsize="small"><?= \URL; ?>api/strategyguide/get/1/</p>
                <pre style="width: 90%;"><code>
$apiResult = file_get_contents("<?= \URL; ?>api/strategyguide/get/1/");
$data = json_decode($apiResult);
print_r($data); // Prints out the data
                </code></pre>
            </div>

            <div class="column" style="width: 50%;">
                <p class="fontVerdana"><b>Example Response (JSON)</b></p>
                <pre style="width: 90%; max-height: 25em;"><code>
{
    "success": true,
    "errors": [],
    "data": {
        "id": 1,
        "authorid": 1,
        "gameid": 1,
        "title": "Best Food",
        "content": "The best food in Stronghold Crusader is Bread. Bread is really expensive and labor intensive but once you get it up and running then you are set.",
        "timeposted": "1625598653",
        "favorites": 1
    }
}
                </code></pre>
            </div>
        </div>
        <h5 class="fontTrebuchet"><b>Description</b></h5>
        <p class="fontVerdana">Shows all the data for a specific strategy guide by it's ID.</p>

        <div class="spacer" data-size="medium"></div>
        <hr data-thin="true">
        <div class="spacer" data-size="medium"></div>

        <!-- 
            Users 
        -->
        <h1 class="fontTrebuchet" data-size="large">Users</h1>
        <hr data-thin="true">
        <h2 class="fontTrebuchet">Show User Information</h2>
        <p class="fontTrebuchet" data-fontcolor="gray"><?= \URL; ?>api/user/get/[USER_ID]/<p>

        <div class="row" data-colcount="2" style="width: 100%;">
            <div class="column" style="width: 50%;">
                <p class="fontVerdana"><b>Example Request (Using PHP)</b></p>
                <p class="fontVerdana" data-fontcolor="gray" data-fontsize="small"><?= \URL; ?>api/user/get/1/</p>
                <pre style="width: 90%;"><code>
$apiResult = file_get_contents("<?= \URL; ?>api/user/get/1/");
$data = json_decode($apiResult);
print_r($data); // Prints out the data
                </code></pre>
            </div>

            <div class="column" style="width: 50%;">
                <p class="fontVerdana"><b>Example Response (JSON)</b></p>
                <pre style="width: 90%; max-height: 25em;"><code>
{
    "success": true,
    "errors": [],
    "data": {
        "id": 1,
        "username": "Handge",
        "timeregistered": 1619929173,
        "followedgameids": [
            1,
            9,
            8,
            15,
            2
        ],
        "favoritestrategyguideids": []
    }
}
                </code></pre>
            </div>
        </div>
        <h5 class="fontTrebuchet"><b>Description</b></h5>
        <p class="fontVerdana">Shows some data for a specific user by their ID.</p>
    </div>
</div>