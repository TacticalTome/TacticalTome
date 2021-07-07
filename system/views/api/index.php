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
        <h1 class="fontTrebuchet">Notice</h1>
        <p class="fontVerdana">When using our API you agree to our <a href="<?= \URL; ?>">Terms of Service</a></p>

        <h1>How to use</h1>
        <p class="fontVerdana">Our API uses a GET request system using the following URL format: <code><?= \URL; ?>api/CategoryMethod Name/Value/</code></p>

        <h1 class="fontTrebuchet">Methods</h1>
        <ul class="fontVerdana">
            <li>
                <code><?= \URL; ?>api/game/get/game id here/</code>
                <ul>
                    <li>This returns all information about the game including: name, description, developer, banner urls, cover urls, steam app id (if applicable), and the amount of followers, and it's corresponding urls.</li>
                </ul>
            </li>
            <li>
                <code><?= \URL; ?>api/strategyguide/get/guide id here/</code>
                <ul>
                    <li>This returns all information about the strategy guide including: the author id, the game id, title, content, time posted, and amount of favorites.</li>
                </ul>
            </li>
            <li>
                <code><?= \URL; ?>api/user/get/user id here/</code>
                <ul>
                    <li>This returns all information about the user including: username, time the user registered, the ids of all games the user is following, and the ids of all the user's favorite strategy guides.</li>
                </ul>
            </li>
        </ul>

        <h1>Example Response</h1>
        <p class="fontVerdana"><code><?= \URL; ?>api/strategyguide/get/1/</code></p>
        <pre>
            <code>
                {
                    "success": true,
                    "errors": [],
                    "data": {
                        "id": 1,
                        "authorid": 1,
                        "gameid": 1,
                        "title": "Best Food",
                        "content": "I really like chicken nuggets",
                        "timeposted": "1624080012",
                        "favorites": 10
                    }
                }
            </code>
        </pre>

        <p class="fontVerdana"><code><?= \URL; ?>api/game/</code></p>
        <pre>
            <code>
                {
                    "success": false,
                    "errors": [
                        "Action is not set",
                        "Value is not set"
                    ],
                    "data":[
                    ]
                }
            </code>
        </pre>
    </div>
</div>