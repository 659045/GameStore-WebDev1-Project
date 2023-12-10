<?php
namespace App\Controllers;

class GameController
{
    private $gameService;

    function __construct()
    {
        $this->gameService = new \App\Services\GameService();
    }

    public function index()
    {
        $model = $this->gameService->getAll();
        require __DIR__ . '/../views/game/index.php';
    }

    public function create() {        
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            require '../views/game/create.php';
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);        
            $price = $_POST['price'];      
            
            $game = new \App\Models\Game();
            $game->title = $title;
            $game->description = $description;
            $game->price = $price;

            $this->gameService->insert($game);

            $this->index();
        }
    }
}