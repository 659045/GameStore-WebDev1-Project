<?php
namespace App\Services;

class GameService {
    public function getAll() {
        $repository = new \App\Repositories\GameRepository();
        return $repository->getAll();
    }

    public function insert($game) {
        $repository = new \App\Repositories\GameRepository();
        return $repository->insert($game);
    }
}