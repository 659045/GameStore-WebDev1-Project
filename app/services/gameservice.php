<?php
require __DIR__ . '/../repositories/gameRepository.php';

class GameService {
    public function getAll() {
        $repository = new GameRepository();
        return $repository->getAll();
    }

    public function insert($game) {
        $repository = new GameRepository();
        return $repository->insert($game);
    }
}