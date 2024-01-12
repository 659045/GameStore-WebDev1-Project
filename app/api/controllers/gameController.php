<?php
require __DIR__ . '/../../services/gameService.php';

class GameController {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService();
    }

    public function index() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $games = $this->gameService->getAll();
                $json = json_encode($games);
                header("Content-type: application/json");
                echo $json;
                return;
            }
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                switch ($_POST['post_type']) {
                    case 'insert':
                        $this->insertGame();
                        break;
                    case 'edit':
                        $this->editGame();
                        break;
                    case 'delete':
                        $this->deleteGame(htmlspecialchars($_POST['id']));
                        break;
                }
                
                return;
            }

            //TODO try request type delete
            // if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            //     $this->deleteGame(htmlspecialchars($_POST['id']));
            //     return;
            // }

        } catch(error) {
            echo 'error controller';
        }
    }

    function insertGame() {
        $game = new Game();
        $game->setTitle(htmlspecialchars($_POST['title']));
        $game->setDescription(htmlspecialchars($_POST['description']));
        $game->setPrice(htmlspecialchars($_POST['price']));

        $this->gameService->insert($game);
    }

    function editGame() {

    }

    function deleteGame($id) {
        $this->gameService->delete($id);
    } 
}
?>