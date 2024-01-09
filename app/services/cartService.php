<?php
require __DIR__ . '/../repositories/cartRepository.php';

class CartService {
    public function getAll() {
        $repository = new CartRepository();
        return $repository->getAll();
    }

    public function insert($cart) {
        $repository = new CartRepository();
        return $repository->insert($cart);
    }
}