<?php
namespace App\Repositories;

use PDO;

class GameRepository extends Repository {

    function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM games");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\Game');
        $games = $stmt->fetchAll();

        return $games;
    }


    public function insert($game) {
        $stmt = $this->connection->prepare(
            "INSERT INTO games (title, description, price) VALUES (:title, :description, :price)"
        );
        
        $results = $stmt->execute([
            ':title' => $game->title, 
            ':description' => $game->description, 
            ':price' => $game->price
        ]);
        return $results;
    }
}