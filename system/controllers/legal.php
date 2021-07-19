<?php

    namespace controller;

    class Legal extends \core\Controller {
        public function privacyPolicy() {
            $this->pageIdentifier = "Privacy Policy";
            $this->pageTitle = "Privacy Policy - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("legal", "privacypolicy");
        }

        public function termsOfService() {
            $this->pageIdentifier = "Terms of Service";
            $this->pageTitle = "Terms of Service - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("legal", "termsofservice");
        }

        public function postingGuidelines() {
            $this->pageIdentifier = "Posting Guidelines";
            $this->pageTitle = "Posting Guidelines - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("legal", "postingguidelines");
        }
    }