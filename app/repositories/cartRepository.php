<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/cart.php';

class CartRepository extends Repository {

    function getAll() {

        $stmt = $this->connection->prepare("SELECT * FROM cart");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        $carts = $stmt->fetchAll();

        return $carts;
    }

    public function insert($cart) {

        $stmt = $this->connection->prepare(
            "INSERT INTO cart () VALUES ()"
        );
        
        $results = $stmt->execute([
            
        ]);
        
        return $results;
    }
}