<?php

    namespace controller;

    class About extends \library\Controller {
        public function index() {
            $this->pageIdentifier = "About";
            $this->pageTitle = "About - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("about", "index");
        }

        public function faq() {
            $this->pageIdentifier = "FAQ";
            $this->pageTitle = "Frequently Asked Questions - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("about", "faq");
        }

        public function contact() {
            $this->pageIdentifier = "Contact";
            $this->pageTitle = "Contact Us - " . \WEBSITE_NAME;

            $this->loadViewWithHeaderFooter("about", "contact");
        }
    }

?>