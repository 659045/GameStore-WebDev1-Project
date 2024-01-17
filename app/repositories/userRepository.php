<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/user.php';

class UserRepository extends Repository {

    public function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user");
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $stmt->fetchAll();
    
            return $users;
        } catch (PDOException $e) {
            echo $e;	
        }
    }

    public function getUserByEmail($email) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE :email = ?");
            $stmt->execute(array(':email' => htmlspecialchars($email)));
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insert($user) {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO user (email, username, password, role) VALUES (:email, :username, :password, :role)"
            );
            
            $results = $stmt->execute([
                ':email' => $user->email, 
                ':username' => $user->username, 
                ':password' => $user->password,
                ':role' => $user->role
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function edit($user) {

    }

    public function delete($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
            $results = $stmt->execute(array(':id' => htmlspecialchars($id)));

            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function verifyLoginCredentials(string $username, $passwd) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE username = :username AND password = :passwd");
            $stmt->execute(array(':username' => htmlspecialchars($username), ':passwd' => htmlspecialchars($passwd)));

            return $stmt->rowCount() == 1 ? true : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}