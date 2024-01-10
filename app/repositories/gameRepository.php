<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/game.php';

class GameRepository extends Repository {

    public function getAll() {

        $stmt = $this->connection->prepare("SELECT * FROM game");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
        $games = $stmt->fetchAll();

        return $games;
    }

    public function getGameById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM game where id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
        $game = $stmt->fetch();

        return $game;
    }


    public function insert($game) {
        $stmt = $this->connection->prepare(
            "INSERT INTO game (title, description, price) VALUES (:title, :description, :price)"
        );
        
        $results = $stmt->execute([
            ':title' => $game->title, 
            ':description' => $game->description, 
            ':price' => $game->price
        ]);
        
        return $results;
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM game WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    
        return;
    }
}