<!DOCTYPE HTML>
<HTML>
    <head>
        <!--
            Site Data
        -->
        <title>{{ config("app.name") }} - @yield("pageTitle")</title>
        <link rel="icon" href="{{ asset("img/icon.png") }}" type="image/png">

        <!--
            Framework and CSS
        -->
        <link rel="stylesheet" type="text/css" href="{{ asset("css/framework.css") }}">
        <link rel="stylesheet" type="text/css" href="{{ asset("css/main.css") }}">
        <script type="module" src="{{ asset("js/framework.js") }}"></script>

        <!--   
            Javascript
        -->
        <script src="{{ asset("js/functions.js") }}"></script>

        <!--
            Fontawesome
        -->
        <link rel="stylesheet" type="text/css" href="{{ asset("css/font-awesome/all.css") }}">
        <script src="{{ asset("js/font-awesome/all.js") }}"></script>

        <!--
            JQuery
        -->
        <script src="{{ asset("js/jquery.js") }}"></script>
        <script src="{{ asset("js/jquery-ui/jquery-ui.js") }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset("css/jquery-ui/jquery-ui.css") }}">

        <!--
            Metadata
        -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body data-theme="light">
        <!--
            TOP NAVIGATION
            THEME    > dark
            SIZE     > large
            SCROLLTO > medium
        -->
        <div class="topNavigation fixed unselectable" data-theme="dark" data-size="extralarge" data-basesize="extralarge" data-scrollto="medium">
            <div class="brand hideOnMobile fontTrebuchet colorOrange">{{ config("app.name") }}</div>
            <div class="linkContainerRight">
                <div class="linkSection">
                    <div class="link fontVerdana" id="{{ Route::is("index") ? "active" : "" }}"><a href="{{ route("index") }}"><i class="fas fa-home"></i> Home</a></div>
                    @auth
                        <div class="link fontVerdana" id="{{ Route::is("explore.recommended") || Route::is("explore.recommended.offset") ? "active" : "" }}"><a href="{{ route("explore.recommended") }}"><i class="fab fa-wpexplorer"></i> Explore</a></div>
                    @else
                        <div class="link fontVerdana" id="{{ Route::is("explore.popular") || Route::is("explore.popular.offset") ? "active" : "" }}"><a href="{{ route("explore.popular") }}"><i class="fab fa-wpexplorer"></i> Explore</a></div>
                    @endauth
                    @auth
                        <div class="dropdown hideOnMobile">
                            <span class="title fontVerdana"><i class="fas fa-shoe-prints"></i> Followed Games <i class="fas fa-chevron-down"></i></span>
                            <div class="content">
                                @foreach (Auth::user()->followedGames as $game)
                                    <div class="link fontVerdana" id="{{ request()->is("game.view", $game->id) ? "active" : "" }}"><a href="{{ route("game.view", $game->id) }}">{{ $game->name }}</a></div>
                                @endforeach
                                <hr data-align="left" data-length="short" data-color="white" style="margin-left: 10px;">
                                <div class="link fontVerdana" id="{{ Route::is("steam.submitgame") ? "active" : "" }}"><a href="{{ route("steam.submitgame") }}">Submit a Game</a></div>
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="linkSection">
                    <div class="link">
                        <input type="text" class="fontVerdana" placeholder="Search" style="width: 75%;" id="searchWebsiteText"/>
                        <button class="simple fontVerdana" data-theme="dark" data-color="blue" id="searchWebsite"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="linkSection">
                    @auth
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('{{ route("user.account") }}');"><i class="fas fa-user"></i> Account</button></div>
                    @else
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('{{ route("auth.login") }}');"><i class="fas fa-sign-in-alt"></i> Login</button></div>
                        <div class="link" id="smallMargin"><button class="simple fontVerdana" data-theme="dark" data-color="transparent" data-border="blue" onclick="gotoLink('{{ route("auth.register") }}');"><i class="fas fa-user-plus"></i> Sign Up</button></div>
                    @endauth
                </div>
            </div>
            <div id="navigationCollapse">=</div>
        </div>

        @yield("content")

         <!--
            Footer
            THEME > dark
            SIZE  > large
        -->
        <div class="footer" data-theme="dark" data-size="large">
            <div class="sectionContainer">
            <div class="section">
                    <h4 class="fontTrebuchet">Pages</h4>
                    <a class="fontVerdana" href="{{ route("index") }}">Homepage</a>
                    <a class="fontVerdana" href={{ route("explore.popular") }}>Explore</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">Legal</h4>
                    <a class="fontVerdana" href="{{ route("legal.termsofservice") }}">Terms of Service</a>
                    <a class="fontVerdana" href="{{ route("legal.privacypolicy") }}">Privacy Policy</a>
                    <a class="fontVerdana" href="{{ route("legal.postingguidelines") }}">Posting Guidelines</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">About</h4>
                    <a class="fontVerdana" href="{{ route("about.index") }}">About Tactical Tome</a>
                    <a class="fontVerdana" href="{{ route("about.faq") }}">Frequently Asked Questions</a>
                    <a class="fontVerdana" href="{{ route("about.contact") }}">Contact Us</a>
                </div>
            </div>
            <div class="banner" data-size="large">
                &copy; 2021 - {{ \Carbon\Carbon::now()->year }} <a href="{{ route("index") }}">Tactical Tome</a>. All Rights Reserved.
            </div>
        </div>

        @stack("scripts")
        <script>
            $(document).tooltip();

            $("#searchWebsite").on("click", function() {
                const query = $("#searchWebsiteText").val();
                window.location.href = "{{ route("search.index", "") }}/" + query;
            });

            $("#searchWebsiteText").on("keypress", function(e) {
                const query = $("#searchWebsiteText").val();
                if (e.which === 13) window.location.href = "{{ route("search.index", "") }}/" + query;
            });
        </script>
    </body>
</HTML>