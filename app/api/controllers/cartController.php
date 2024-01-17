<?php
require __DIR__ . '/../../services/cartService.php';

class CartController {
    
    private $cartService;

    function __construct() {
        $this->cartService = new CartService();
    }

    public function index() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $cart = array();

                    if (isset($_SESSION["cart"])) {
                        $cart = $_SESSION["cart"];
                    }

                    header("Content-type: application/json");
                    echo json_encode($cart);
                    break;
                case 'POST':
                    $this->insert();
                    break;
                case 'DELETE':
                    $data = json_decode(file_get_contents('php://input'));
                    $this->delete(htmlspecialchars($data->id));
                    break;
                default:
                    break;
            }  
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert() {
        $id = htmlspecialchars($_POST['id']);
        $this->cartService->insert($id);
    }

    public function delete($id) {
        $this->cartService->delete($id);
    }
}