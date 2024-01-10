<?php
require __DIR__ . '/../../services/gameService.php';

class GameController {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $games = $this->gameService->getAll();
            $json = json_encode($games);
            header("Content-type: application/json");
            echo $json;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $object = json_decode($json);

            $game = new Game();
            $game->setTitle($object->title);
            $game->setDescription($object->description);
            $game->setPrice($object->price);

            $this->gameService->insert($game);
        }
    }
}
?>