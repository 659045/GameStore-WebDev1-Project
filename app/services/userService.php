<?php
require_once __DIR__ . '/../repositories/userRepository.php';

class UserService {
    public function getAll() {
        $repository = new UserRepository();
        return $repository->getAll();
    }

    public function getByUsername($username) {
        $repository = new UserRepository();
        return $repository->getByUsername($username);
    }

    public function insert($user) {
        $repository = new UserRepository();
        return $repository->insert($user);
    }

    public function edit($user) {
        $repository = new UserRepository();
        return $repository->edit($user);
    }

    public function delete($id) {
        $repository = new UserRepository();
        return $repository->delete($id);
    }
}