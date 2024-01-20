<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/wishList.php';

class WishListRepository extends Repository {

    function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM wish_list");
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'WishList');
            $wishLists = $stmt->fetchAll();
    
            return $wishLists;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getWishListByUserId($user_id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM wish_list where user_id = :user_id");
            $stmt->execute(array(':user_id' => $user_id));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'WishList');
            $wishList = $stmt->fetchAll();
    
            return $wishList;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getWishListByUserIdAndGameId($user_id, $game_id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM wish_list where user_id = :user_id AND game_id = :game_id");
            $stmt->execute(array(':user_id' => $user_id, ':game_id' => $game_id));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'WishList');
            $wishList = $stmt->fetchAll();
    
            return $wishList;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insert($wishList) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO wish_list (user_id, game_id) VALUES (:user_id, :game_id)");
            $stmt->execute(array(':user_id' => $wishList->getUserId(), ':game_id' => $wishList->getGameId()));
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function delete($wishList) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM wish_list WHERE user_id = :user_id AND game_id = :game_id");
            $stmt->execute(array(':user_id' => $wishList->getUserId(), ':game_id' => $wishList->getGameId()));
        } catch (PDOException $e) {
            echo $e;
        }
    }
}