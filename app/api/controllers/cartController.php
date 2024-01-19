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
                    $cart = $this->cartService->getCart();

                    header("Content-type: application/json");
                    echo json_encode($cart);
                    break;
                case 'POST':
                    $data = json_decode(file_get_contents('php://input'));
                    $this->insert(htmlspecialchars($data->id));
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

    public function insert($id) {
        $this->cartService->insert($id);
    }

    public function delete($id) {
        $this->cartService->delete($id);
    }
}