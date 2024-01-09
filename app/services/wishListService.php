<?php
require __DIR__ . '/../repositories/wishListRepository.php';

class WishListService {
    public function getAll() {
        $repository = new WishListRepository();
        return $repository->getAll();
    }

    public function insert($wishList) {
        $repository = new WishListRepository();
        return $repository->insert($wishList);
    }
}