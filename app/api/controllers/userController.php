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
                    if (isset($_GET['username'])) {
                        $user = $this->userService->getByUsername(htmlspecialchars($_GET['username']));
                        header("Content-type: application/json");
                        echo json_encode($user);
                        break;
                    } else {
                        $users = $this->userService->getAll();
                        header("Content-type: application/json");
                        echo json_encode($users);
                        break;
                    }
                case "POST":
                    $this->insertUser();
                    break;
                case "PUT":
                    $data = json_decode(file_get_contents('php://input'));
                    $this->editUser($data);
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
        $user->setEmail($_POST['email']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->setRole('normal');

        $this->userService->insert($user);
    }

    public function editUser($data) {
        $user = new User();
        $user->setId(htmlspecialchars($data->id));
        $user->setEmail(htmlspecialchars($data->email));
        $user->setUsername(htmlspecialchars($data->username));
        $user->setPassword(htmlspecialchars($data->password));
        $user->setRole(htmlspecialchars($data->role));

        $this->userService->edit($user);
    }

    public function deleteUser($id) {
        $this->userService->delete($id);
    }
}