<?php
require_once __DIR__ . '/../services/gameService.php';

class HomeController {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService;
    }

    public function index() {
        $games = $this->gameService->getAll();
        require_once __DIR__ . '/../views/home/index.php';
    }
}