<?php
require __DIR__ . '/../../services/userService.php';

class UpgradeController {
    
    private $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function index() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->upgrade();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function upgrade() {
        $id = htmlspecialchars($_POST['id']);

        $this->userService->upgrade($id);
    }
}