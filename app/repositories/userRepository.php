<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/user.php';

class UserRepository extends Repository {

    public function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT id, email, username, password, role FROM user");
            $stmt->execute();
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $stmt->fetchAll();
    
            return $users;
        } catch (PDOException $e) {
            echo $e;	
        }
    }

    public function getUserByUsername($username) {
        try {
            $stmt = $this->connection->prepare("SELECT id, email, username, password, role FROM user WHERE username = :username");
            $stmt->execute(array(':username' => $username));
    
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();
    
            return $user;
        } catch (PDOException $e) {
            echo $e;	
        }
    }

    public function getUserByEmail($email) {
        try {
            $stmt = $this->connection->prepare("SELECT id, email, username, password, role FROM user WHERE email = :email");
            $stmt->execute(array(':email' => $email));
    
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
                ':email' => $user->getEmail(), 
                ':username' => $user->getUsername(), 
                ':password' => $user->getPassword(),
                ':role' => $user->getRole()
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function edit($user) {
        try {
            $stmt = $this->connection->prepare(
                "UPDATE user SET email = :email, username = :username WHERE id = :id"
            );
            
            $results = $stmt->execute([
                ':email' => $user->getEmail(), 
                ':username' => $user->getUsername(), 
                ':id' => $user->getId()
            ]);
            
            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
            $results = $stmt->execute(array(':id' => $id));

            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function upgrade($id) {
        try {
            $stmt = $this->connection->prepare("UPDATE user SET role = 'premium' WHERE id = :id");
            $results = $stmt->execute(array(':id' => $id));

            return $results;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function verifyLoginCredentials(string $username, $passwd) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->execute(array(':username' => $username));

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();

            return $user && password_verify($passwd, $user->getPassword());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}