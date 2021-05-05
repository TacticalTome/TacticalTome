<?php

    namespace controller;

    class Index extends \library\Controller {
        public function index() {
            $this->pageTitle = \WEBSITE_NAME;
            $this->pageIdentifier = "Home";

            $this->loadViewWithHeaderFooter("index", "index");
        }
    }

?>