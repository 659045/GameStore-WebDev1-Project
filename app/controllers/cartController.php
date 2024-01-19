<?php
require_once __DIR__ . '/../services/cartService.php';

class CartController {

    private $cartService;

    function __construct() {
        $this->cartService = new CartService();
    }

    public function index() {
        if (isset($_SESSION['username'])) {
            $cart = $this->cartService->getCart();
            require_once __DIR__ . '/../views/cart/index.php';
        }  else {
            header('Location: /404');
        }
    }
}