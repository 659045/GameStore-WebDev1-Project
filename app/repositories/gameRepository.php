<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/game.php';

class GameRepository extends Repository {

    public function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT id, title, description, price, image FROM game");
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            $games = $stmt->fetchAll();
    
            return $games;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getGameById($id) {
        try {
            $stmt = $this->connection->prepare("SELECT id, title, description, price, image FROM game where id = :id");
            $stmt->execute(array(':id' => $id));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            $game = $stmt->fetch();
    
            return $game;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getGameByTitle($title) {
        try {
            $stmt = $this->connection->prepare("SELECT id, title, description, price, image FROM game where title = :title");
            $stmt->execute(array(':title' => $title));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            $game = $stmt->fetch();
    
            return $game;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function insert($game) {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO game (title, description, price, image) VALUES (:title, :description, :price, :image)"
            );
            
            $results = $stmt->execute([
                ':title' => $game->getTitle(), 
                ':description' => $game->getDescription(),   
                ':price' => $game->getPrice(),
                ':image' => $game->getImage(),
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function edit($game) {
        try {
            $stmt = $this->connection->prepare(
                "UPDATE game SET title = :title, description = :description, price = :price, image = :image WHERE id = :id"
            );
            
            $results = $stmt->execute([
                ':title' => $game->getTitle(), 
                ':description' => $game->getDescription(),   
                ':price' => $game->getPrice(),
                ':image' => $game->getImage(),
                ':id' => $game->getId()
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM game WHERE id = :id");
            $stmt->execute(array(':id' => $id));
        
            return;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}