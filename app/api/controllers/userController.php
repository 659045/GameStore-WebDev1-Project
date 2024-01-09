<?php
require __DIR__ . '/../../services/userService.php';

class UserController {
    
    private $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $purchaseHistories = $this->userService->getAll();
            $json = json_encode($purchaseHistories);
            header("Content-type: application/json");
            echo $json;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $object = json_decode($json);

            $user = new PurchaseHistory();

            $this->userService->insert($user);
        }
    }
}