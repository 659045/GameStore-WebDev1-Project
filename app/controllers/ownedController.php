<?php
require_once __DIR__ . '/../services/ownedGameService.php';

class OwnedController {

    private $ownedGameService;

    function __construct() {
        $this->ownedGameService = new OwnedGameService;
    }

    public function index() {
        if (isset($_SESSION['username'])) {
            $ownedGames = $this->ownedGameService->getOwnedGameByUserId(1);

            require_once __DIR__ . '/../views/owned/index.php';
        } else {
            header('Location: /404');
        }
    }
}