<?php
require __DIR__ . '/../../services/ownedGameService.php';

class OwnedController {

    private $ownedGameService;

    function __construct() {
        $this->ownedGameService = new OwnedGameService();
    }

    public function index() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $ownedGames = $this->ownedGameService->getAll();
                echo json_encode($ownedGames);
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                $this->addOwnedGame($data);
                break;
            default:
                break;
        }
    }

    public function addOwnedGame($data) {
        $user_id = htmlspecialchars($data->user_id);
        $game_id = htmlspecialchars($data->game_id);

        $this->ownedGameService->insert($user_id, $game_id);
    }
}