<?php
require_once __DIR__ . '/../services/gameService.php';

class CartService {

    private $gameService;

    function __construct() {
        $this->gameService = new GameService();
    }

    public function insert($id) {
        $cart = array();

        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
        }

        if(in_array($id, array_keys($cart))) {
            return;
        } else {
            $cart[$id] = $id;
        }

        $_SESSION["cart"] = $cart;
    }

    public function delete($id) {
        $cart = array();

        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
        }

        if(in_array($id, array_keys($cart))) {
            unset($cart[$id]);
        }

        $_SESSION["cart"] = $cart;
    }

    public function getAmount() {
        $cart = array();
        $count = 0;

        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
        }

        foreach($cart as $item) {
            $count++;
        }

        return $count;
    }

    public function getTotalPrice() {
        $cart = array();
        $total = 0;

        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
        }

        foreach($cart as $item => $value) {
            $game = $this->gameService->getGameById($value);
            $total += ($game->getPrice());
        }

        return $total;
    }
}