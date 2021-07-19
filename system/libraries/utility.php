<?php

    namespace utility;

    function getCurrentURL(): string {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
            return "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        } else {
            return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }
    }

    function getFacebookShareButton(): string {
        return '<button data-color="blue" onclick="gotoLinkInNewTab(\'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(getCurrentURL()) . '\');" title="Share on Facebook"><i class="fab fa-facebook"></i> Share</button>';
    }

    function getTwitterShareButton(): string {
        return '<button data-color="blue" onclick="gotoLinkInNewTab(\'http://twitter.com/share?url=' . urlencode(getCurrentURL()) . '\');" title="Share on Twitter"><i class="fab fa-twitter"></i> Tweet</button>';
    }

    function getRedditShareButton(string $title): string {
        return '<button data-color="blue" onclick="gotoLinkInNewTab(\'https://www.reddit.com/submit?title=' . urlencode($title) . '&url=' . urlencode(getCurrentURL()) . '\');" title="Share on Reddit"><i class="fab fa-reddit-alien"></i> Share</button>';
    }

    function echoDefaultMetadata(): void {
        echo '<meta name="copyright" content="' . \WEBSITE_NAME . '">';
        echo '<meta name="og:image" property="og:image" content="' . \URL . 'images/icon.png">';
    }

    function getReCaptchaFormHTML(): string {
        return '<div class="g-recaptcha" data-sitekey="' . \RECAPTCHA_SITE_KEY . '"></div>';
    }

    function isReCaptchaValid(string $value): bool {
        $responseFromGoogle = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode(\RECAPTCHA_SECRET_KEY) . "&response=" . urlencode($value)), true);
        return $responseFromGoogle["success"];
    }

    function mailTo(string $email, string $subject, string $content): void {
        if (!\ALLOW_SENDING_EMAILS) return;

        require_once("Mail.php");

        $headers = Array(
            "From" => "<" . \WEBSITE_EMAIL . ">",
            "To" => "<" . $email . ">",
            "Subject" => $subject
        );
        $smtp = \Mail::factory("smtp", Array(
            "host" => "ssl://smtp.gmail.com",
            "port" => "465",
            "auth" => true,
            "username" => \WEBSITE_EMAIL,
            "password" => \WEBSITE_EMAIL_PASSWORD
        ));

        $mail = $smtp->send($headers["To"], $headers, $content);
    }