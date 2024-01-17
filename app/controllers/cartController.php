<?php
require_once __DIR__ . '/../services/cartService.php';
require_once __DIR__ . '/../services/gameService.php';

class CartController {

    private $cartService;
    private $gameService;

    function __construct() {
        $this->cartService = new CartService();
        $this->gameService = new GameService();
    }

    public function index() {
        $cart = array();
        $total = 0;

        if (isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
        }

        foreach ($cart as $item => $value) {
            $game = $this->gameService->getGameById($value);
            $total += ($game->getPrice());
        }
        require __DIR__ . '/../views/cart/index.php';
    }
}