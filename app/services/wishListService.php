<?php
require_once __DIR__ . '/../repositories/wishListRepository.php';

class WishListService {
    public function getAll() {
        $repository = new WishListRepository();
        return $repository->getAll();
    }

    public function getWishListByUserId($user_id) {
        $repository = new WishListRepository();
        return $repository->getWishListByUserId($user_id);
    }

    public function getWishListByUserIdAndGameId($user_id, $game_id) {
        $repository = new WishListRepository();
        return $repository->getWishListByUserIdAndGameId($user_id, $game_id);
    }

    public function insert($wishList) {
        $repository = new WishListRepository();
        return $repository->insert($wishList);
    }

    public function delete($wishList) {
        $repository = new WishListRepository();
        return $repository->delete($wishList);
    }
}