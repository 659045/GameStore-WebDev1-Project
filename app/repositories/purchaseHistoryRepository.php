<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/purchaseHistory.php';

class PurchaseHistoryRepository extends Repository {

    function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM purchase_history");
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'PurchaseHistory');
            $purchaseHistories = $stmt->fetchAll();
    
            return $purchaseHistories;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insert($purchaseHistory) {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO purchaseHistory () VALUES ()"
            );
            
            $results = $stmt->execute([
                
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}