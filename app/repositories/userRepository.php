<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository {

    function getAll() {

        $stmt = $this->connection->prepare("SELECT * FROM user");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $carts = $stmt->fetchAll();

        return $carts;
    }

    public function insert($user) {

        $stmt = $this->connection->prepare(
            "INSERT INTO cart () VALUES ()"
        );
        
        $results = $stmt->execute([
            
        ]);
        
        return $results;
    }
}