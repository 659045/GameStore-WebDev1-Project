<?php
require __DIR__ . '/../../services/gameService.php';

class GameController {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService();
    }

    public function index() {
        try {
            switch ($_SERVER["REQUEST_METHOD"]) {
                case 'GET':
                    $games = $this->gameService->getAll();
                    $json = json_encode($games);
                    header("Content-type: application/json");
                    echo $json;
                    break;
                case 'POST':
                    $this->insertGame();
                    break;
                case 'PUT':
                    $this->editGame();
                    break;
                case 'DELETE':
                    $data = json_decode(file_get_contents('php://input'));
                    $this->deleteGame(htmlspecialchars($data->id));
                    break;
                default:
                    echo 'error controller';
                    break;
            }
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