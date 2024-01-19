<?php

class CartService {

    public function getCart() {
        return $_SESSION["cart"] ?? [];
    }

    public function insert($id) {
        if(!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        if(in_array($id, $_SESSION["cart"])) {
            return;
        } else {
            array_push($_SESSION["cart"], $id);
        }
    }

    public function delete($id) {
        if (!isset($_SESSION["cart"])) {
            return;
        }

        $index = array_search($id, $_SESSION["cart"]);
        if ($index) {
            unset($_SESSION["cart"][$index]);
        }
    }

    //TODO unused functions
    // public function getAmount() {
    //     $cart = array();
    //     $count = 0;

    //     if(isset($_SESSION["cart"])) {
    //         $cart = $_SESSION["cart"];
    //     }

    //     foreach($cart as $item) {
    //         $count++;
    //     }

    //     return $count;
    // }

    // public function getTotalPrice() {
    //     $cart = array();
    //     $total = 0;

    //     if(isset($_SESSION["cart"])) {
    //         $cart = $_SESSION["cart"];
    //     }

    //     foreach($cart as $item => $value) {
    //         $game = $this->gameService->getGameById($value);
    //         $total += ($game->getPrice());
    //     }

    //     return $total;
    // }
}