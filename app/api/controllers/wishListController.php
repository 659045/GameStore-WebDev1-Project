<?php
require __DIR__ . '/../../services/wishListService.php';
require_once __DIR__ . '/../../models/wishList.php';

class WishListController {

    private $wishListService;
    
    function __construct() {
        $this->wishListService = new WishListService();
    }

    public function index() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($_GET['user_id']) && isset($_GET['game_id'])) {
                    $wishList = $this->wishListService->getWishListByUserIdAndGameId(htmlspecialchars($_GET['user_id']), htmlspecialchars($_GET['game_id']));
                    echo json_encode($wishList);
                    break;
                } elseif (isset($_GET['user_id'])) {
                    $wishList = $this->wishListService->getWishListByUserId(htmlspecialchars($_GET['user_id']));
                    echo json_encode($wishList);
                    break;
                } else {
                    $wishList = $this->wishListService->getAll();
                    echo json_encode($wishList);
                    break;
                }
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                $this->addWishList($data);
                break;
            case 'DELETE':
                $data = json_decode(file_get_contents('php://input'));
                $this->deleteWishList($data);
                break;
            default:
                break;
        }
    }

    public function addWishList($data) {
        $user_id = htmlspecialchars($data->user_id);
        $game_id = htmlspecialchars($data->game_id);

        $wishList = new WishList;
        $wishList->setUserId($user_id);
        $wishList->setGameId($game_id);

        $this->wishListService->insert($wishList);
    }

    public function deleteWishList($data) {
        $user_id = htmlspecialchars($data->user_id);
        $game_id = htmlspecialchars($data->game_id);

        $wishList = new WishList;
        $wishList->setUserId($user_id);
        $wishList->setGameId($game_id);

        $this->wishListService->delete($wishList);
    }
}