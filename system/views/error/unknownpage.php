<!--
<?= \WEBSITE_NAME; ?>
    (c) 2021 - <?= date("Y") . " " . \WEBSITE_NAME; ?>. All Rights Reserved.
-->

<!DOCTYPE HTML>
<HTML>
    <head>
        <!--
            Site Data
        -->
        <title>404 Error: Page not found</title>
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <!--
            Framework
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/framework.css">
        <script src="<?= \URL; ?>javascript/framework.js"></script>
        <script src="<?= \URL; ?>javascript/carousel.js"></script>

        <!--
            FontAwesome
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/font-awesome/all.css" />
		<script src="<?= \URL; ?>javascript/font-awesome/all.js"></script>

        <!--
            JQuery
        -->
        <script src="<?= \URL; ?>javascript/jquery.js"></script>
        <script src="<?= \URL; ?>javascript/jquery-ui/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/jquery-ui/jquery-ui.css" />

        <!--
            Other
        -->
        <link rel="stylesheet" href="<?= \URL; ?>stylesheets/main.css" />
        <script src="<?= \URL; ?>javascript/formvalidation.js"></script>
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