<?php
require_once __DIR__ . '/../services/gameService.php';

class GameController {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService;
    }

    public function index() {
        if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $games = $this->gameService->getAll();

            require_once __DIR__ . '/../views/game/index.php';
        } else {
            header('Location: /404');
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = htmlspecialchars($_GET['id']);
            $game = $this->gameService->getGameById($id);

            require_once __DIR__ . '/../views/game/edit.php';
        }
    }
}