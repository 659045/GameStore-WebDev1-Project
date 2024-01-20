<?php
require __DIR__ . '/../../services/userService.php';

class UserController {
    
    private $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function index() {
        try {
            switch ($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    header("Content-type: application/json");
                    if (isset($_GET['username'])) {
                        $user = $this->userService->getUserByUsername(htmlspecialchars($_GET['username']));
                        echo json_encode($user);
                    } elseif (isset($_GET['email'])) {
                        $user = $this->userService->getUserByEmail(htmlspecialchars($_GET['email']));
                        echo json_encode($user);
                    } else {
                        $users = $this->userService->getAll();
                        echo json_encode($users);
                    }
                    break;
                case "POST":
                    if (isset($_POST['id']))
                        $this->editUser();
                    else
                        $this->insertUser();
                    break;
                case "DELETE":
                    $data = json_decode(file_get_contents('php://input'));
                    $this->deleteUser(htmlspecialchars($data->id));
                    break;
                default:
                    break;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insertUser() {
        $user = new User();
        $user->setEmail(htmlspecialchars($_POST['email']));
        $user->setUsername(htmlspecialchars($_POST['username']));
        $user->setPassword(password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT));
        $user->setRole('normal');

        $this->userService->insert($user);
    }

    public function editUser() {
        $user = new User();
        $user->setId(htmlspecialchars($_POST['id']));
        $user->setEmail(htmlspecialchars($_POST['email']));
        $user->setUsername(htmlspecialchars($_POST['username']));

        $_SESSION['username'] = $user->getUsername();
        
        $this->userService->edit($user);
    }

    public function deleteUser($id) {
        $this->userService->delete($id);
    }
}