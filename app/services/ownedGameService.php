<?php
require_once __DIR__ . '/../repositories/ownedGameRepository.php';

class OwnedGameService {

    private $ownedGameRepository;

    function __construct() {
        $this->ownedGameRepository = new OwnedGameRepository;
    }

    public function getAll() {
        return $this->ownedGameRepository->getAll();
    }

    public function getOwnedGameByUserId($user_id) {
        return $this->ownedGameRepository->getOwnedGameByUserId($user_id);
    }

    public function insert($user_id, $game_id) {
        $this->ownedGameRepository->insert($user_id, $game_id);
    }
}

