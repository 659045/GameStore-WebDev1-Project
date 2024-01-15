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
                    $data = json_decode(file_get_contents('php://input'));
                    $this->editGame($data);
                    break;
                case 'DELETE':
                    $data = json_decode(file_get_contents('php://input'));
                    $this->deleteGame(htmlspecialchars($data->id));
                    break;
                default:
                    echo 'Error controller';
                    break;
            }
        } catch(error) {
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

    function editGame($data) {
        $game = new Game();
        $game->setId(htmlspecialchars($data->id));
        $game->setTitle(htmlspecialchars($data->title));
        $game->setDescription(htmlspecialchars($data->description));
        $game->setPrice(htmlspecialchars($data->price));

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