<?php

class LoginController {

    function __construct() {

    }

    public function index() {
        require __DIR__ . '/../views/login/index.php';
    }
}