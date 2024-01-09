<?php
require __DIR__ . '/../../services/cartService.php';

class CartController {
    
    private $cartService;

    function __construct() {
        $this->cartService = new CartService();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $carts = $this->cartService->getAll();
            $json = json_encode($carts);
            header("Content-type: application/json");
            echo $json;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents('php://input');
            $object = json_decode($json);

            $cart = new Cart();

            $this->cartService->insert($cart);
        }
    }
}