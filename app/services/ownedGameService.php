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

    public function getOwnedGameByUserIdAndGameId($user_id, $game_id) {
        return $this->ownedGameRepository->getOwnedGameByUserIdAndGameId($user_id, $game_id);
    }

    public function insert($ownedGame) {
        $this->ownedGameRepository->insert($ownedGame);
    }
}

