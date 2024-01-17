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

    public function insert($wishList) {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO wishlist () VALUES ()"
            );
            
            $results = $stmt->execute([
                
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}