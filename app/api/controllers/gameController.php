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
                    header("Content-type: application/json");
                    if (isset($_GET['id'])) {
                        $game = $this->gameService->getGameById(htmlspecialchars($_GET['id']));
                        echo json_encode($game);
                    } elseif (isset($_GET['title'])) {
                        $game = $this->gameService->getGameByTitle(htmlspecialchars($_GET['title']));
                        echo json_encode($game);
                    } else {
                        $games = $this->gameService->getAll();
                        echo json_encode($games);
                    }
                    break;
                case 'POST':
                    if (isset($_POST['id'])) {
                       $this->editGame();
                    } else {
                        $this->insertGame();
                    }
                    break;
                case 'DELETE':
                    $data = json_decode(file_get_contents('php://input'));
                    $this->deleteGame(htmlspecialchars($data->id));
                    break;
                default:
                    echo 'Error controller';
                    break;
            }
        } catch(Exception $e) {
            http_response_code(500);
            echo "Error invalid data received";
        }
    }

    function insertGame() {
        $game = new Game();
        $game->setTitle(htmlspecialchars($_POST['title']));
        $game->setDescription(htmlspecialchars($_POST['description']));
        $game->setPrice(htmlspecialchars($_POST['price']));

        $gameImage = $_FILES['image'];
        if ($gameImage && $gameImage['error'] == 0) {
            //add image to img folder
            $filename = htmlspecialchars($gameImage['name']);
            $destination = __DIR__ . '/../../public/img/' . $filename;
            if (move_uploaded_file(htmlspecialchars($gameImage['tmp_name']), $destination)) {
                $game->setImage($filename);
            }
        }

        $this->gameService->insert($game);
    }

    function editGame() {
        $game = new Game();
        $game->setId(htmlspecialchars($_POST['id']));
        $game->setTitle(htmlspecialchars($_POST['title']));
        $game->setDescription(htmlspecialchars($_POST['description']));
        $game->setPrice(htmlspecialchars($_POST['price']));

        $gameImage = $_FILES['image'];
        if ($gameImage && $gameImage['error'] == 0) {
            //add image to img folder
            $filename = htmlspecialchars($gameImage['name']);
            $destination = __DIR__ . '/../../public/img/' . $filename;
            if (move_uploaded_file(htmlspecialchars($gameImage['tmp_name']), $destination)) {
                $game->setImage($filename);
            }
        }

        $this->gameService->edit($game);
    }

    function deleteGame($id) {
        $this->gameService->delete($id);
    } 
}
?>