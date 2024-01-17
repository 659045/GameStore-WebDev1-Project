<?php
require_once __DIR__ . '/../services/loginService.php';

class LoginController {

    private $loginService;

    function __construct() {
        $this->loginService = new LoginService();
    }

    public function index() {
        if (isset($_SESSION["username"])) {
            header('Location: /');
            return;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
    
                if ($this->loginService->login($username, $password)) {
                    $_SESSION["username"] = $username;
                    header('Location: /');
                    return;
                } else {
                    http_response_code(401);
                    $msg = "Invalid username or password";
                }    
            }
        }
  
        require_once __DIR__ . '/../views/login/index.php';
    }
}