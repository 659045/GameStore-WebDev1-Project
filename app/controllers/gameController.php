<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/gameService.php';

class GameController extends Controller {

    private $gameService;

    function __construct() {

        $this->gameService = new GameService;
    }

    public function index() {
        $games = $this->gameService->getAll();

        require __DIR__ . '/../views/game/index.php';

        //TODO fix displayView
        // $this->displayView($games);
    }

    public function create() {
        require __DIR__ . '/../views/game/create.php';
    }
}