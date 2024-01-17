<?php
require __DIR__ . '/../../services/userService.php';

class UserController {
    
    private $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function index() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $users = $this->userService->getAll();
                header("Content-type: application/json");
                echo json_encode($users);
            }
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user = new User();
                $user->setEmail($_POST['email']);
                $user->setUsername($_POST['username']);
                $user->setPassword($_POST['password']);
                $user->setRole('Normal');
    
                $this->userService->insert($user);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
      
    }
}