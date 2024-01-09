<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/purchaseHistory.php';

class PurchaseHistoryRepository extends Repository {

    function getAll() {

        $stmt = $this->connection->prepare("SELECT * FROM purchase_history");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PurchaseHistory');
        $purchaseHistories = $stmt->fetchAll();

        return $purchaseHistories;
    }

    public function insert($purchaseHistory) {

        $stmt = $this->connection->prepare(
            "INSERT INTO cart () VALUES ()"
        );
        
        $results = $stmt->execute([
            
        ]);
        
        return $results;
    }
}