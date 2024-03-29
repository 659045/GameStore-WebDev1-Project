<?php
require_once __DIR__ . '/../repositories/gameRepository.php';

class GameService {

    private $gameRepository;

    function __construct() {
        $this->gameRepository = new GameRepository;
    }

    public function getAll() {
        return $this->gameRepository->getAll();
    }

    public function getGameById($id) {
        return $this->gameRepository->getGameById($id);
    }

    public function getGameByTitle($title) {
        return $this->gameRepository->getGameByTitle($title);
    }

    public function insert($game) {
        return $this->gameRepository->insert($game);
    }

    public function edit($game) {
        return $this->gameRepository->edit($game);
    }

    public function delete($id) {
        return $this->gameRepository->delete($id);
    }
}