<?php
require __DIR__ . '/../repositories/userRepository.php';

class UserService {
    public function getAll() {
        $repository = new UserRepository();
        return $repository->getAll();
    }

    public function insert($cart) {
        $repository = new UserRepository();
        return $repository->insert($cart);
    }
}