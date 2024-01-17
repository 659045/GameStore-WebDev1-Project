<?php
require_once __DIR__ . '/../repositories/userRepository.php';

Class LoginService {

    private $userRepository;

    function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function login($username, $password) {
        return $this->userRepository->verifyLoginCredentials($username, $password);
    }

    public function logout() {
        unset($_SESSION["user"]);
    }
}