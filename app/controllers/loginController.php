<?php
require_once __DIR__ . '/../services/loginService.php';
require_once __DIR__ . '/../services/userService.php';

class LoginController {

    private $loginService;
    private $userService;

    function __construct() {
        $this->loginService = new LoginService();
        $this->userService = new UserService();
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

                    $user = $this->userService->getByUsername($username);

                    switch ($user->getRole()) {
                        case 'admin':
                            $_SESSION["role"] = 'admin';
                            break;
                        case 'premium':
                            $_SESSION["role"] = 'premium';
                            break;
                        default:
                            $_SESSION["role"] = 'normal';
                            break;
                    }
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