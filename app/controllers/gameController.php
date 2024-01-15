<?php
require __DIR__ . '/../services/gameService.php';

class GameController {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService;
    }

    public function index() {
        $games = $this->gameService->getAll();

        require __DIR__ . '/../views/game/index.php';
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = htmlspecialchars($_GET['id']);
            $game = $this->gameService->getGameById($id);
        }

        require_once __DIR__ . '/../views/game/edit.php';
    }
}