<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/wishList.php';

class WishListRepository extends Repository {

    function getAll() {

        $stmt = $this->connection->prepare("SELECT * FROM wish_list");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'WishList');
        $wishLists = $stmt->fetchAll();

        return $wishLists;
    }

    public function insert($wishList) {

        $stmt = $this->connection->prepare(
            "INSERT INTO cart () VALUES ()"
        );
        
        $results = $stmt->execute([
            
        ]);
        
        return $results;
    }
}