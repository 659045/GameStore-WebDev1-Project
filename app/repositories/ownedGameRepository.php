<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/ownedGame.php';

class OwnedGameRepository extends Repository {

    public function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT id, user_id, game_id FROM owned_game");
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OwnedGame');
            $games = $stmt->fetchAll();
    
            return $games;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOwnedGameByUserId($user_id) {
        try {
            $stmt = $this->connection->prepare("SELECT id, user_id, game_id FROM owned_game where user_id = :user_id");
            $stmt->execute(array(':user_id' => $user_id));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OwnedGame');
            $game = $stmt->fetchAll();
    
            return $game;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOwnedGameByUserIdAndGameId($user_id, $game_id) {
        try {
            $stmt = $this->connection->prepare("SELECT id, user_id, game_id FROM owned_game where user_id = :user_id AND game_id = :game_id");
            $stmt->execute(array(':user_id' => $user_id, ':game_id' => $game_id));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OwnedGame');
            $game = $stmt->fetch();
    
            return $game;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insert($ownedGame) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO owned_game (user_id, game_id) VALUES (:user_id, :game_id)");
            $stmt->execute(array(':user_id' => $ownedGame->getUserid(), ':game_id' => $ownedGame->getGameid()));

        } catch (PDOException $e) {
            echo $e;
        }
    }
}