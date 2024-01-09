<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/gameService.php';

class GameController extends Controller {

    private $gameService;

    function __construct() {

        $this->gameService = new GameService();
    }

    public function index() {
        $games = $this->gameService->getAll();
        $this->displayView($games);
    }
}