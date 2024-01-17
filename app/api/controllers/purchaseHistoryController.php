<?php
require __DIR__ . '/../../services/purchaseHistoryService.php';

class PurchaseHistoryController {

    private $purchaseHistoryService;

    function __construct() {
        $this->purchaseHistoryService = new PurchaseHistoryService();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $purchaseHistories = $this->purchaseHistoryService->getAll();
            $json = json_encode($purchaseHistories);
            header("Content-type: application/json");
            echo $json;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
        }
    }
}