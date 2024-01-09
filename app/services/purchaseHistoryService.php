<?php
require __DIR__ . '/../repositories/purchaseHistoryRepository.php';

class PurchaseHistoryService {
    public function getAll() {
        $repository = new PurchaseHistoryRepository();
        return $repository->getAll();
    }

    public function insert($purchaseHistory) {
        $repository = new PurchaseHistoryRepository();
        return $repository->insert($purchaseHistory);
    }
}