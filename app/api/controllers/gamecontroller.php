<?php
require __DIR__ . '/../../services/gameservice.php';

class GameController
{

    private $gameService;

    function __construct()
    {
        $this->gameService = new GameService();
    }

    public function index()
    {
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

            $this->gameService->insert($game);
        }
    }
}
?>