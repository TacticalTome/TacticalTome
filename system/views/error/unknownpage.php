<!--
    <?= \WEBSITE_NAME; ?>
    (c) 2021 - <?= date("Y") . " " . \WEBSITE_NAME; ?>. All Rights Reserved.
    v<?= \WEBSITE_VERSION; ?>
-->

<!DOCTYPE HTML>
<HTML>
    <head>
        <!--
            Site Data
        -->
        <title>404 Error: PAge not found</title>
        <link rel="icon" href="<?= \URL; ?>images/icon.png" type="image/png">

        <!--
            CSS
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/framework.css?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["framework.css"]; ?>">
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/main.css?v=<?= \STYLESHEET_JAVASCRIPT_VERSIONS["main.css"]; ?>" />
    </head>

    <!--
        Body
        THEME > light
    -->
    <body data-theme="light">
        <!--
            Landing Container
        -->
        <div class="landingContainer fullscreen positionRelative">
            <div class="content centerHorizontalVertical">
                <h1 class="fontAlfaSlabOne colorOrange" data-size="large">Page not found</h1>
                <p class="fontVerdana">Return to <a href="<?= \URL; ?>" data-color="yellow">home</a></p>
            </div>
        </div>
    </body>
</HTML>