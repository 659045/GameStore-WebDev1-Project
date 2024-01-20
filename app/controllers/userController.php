<?php
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ . '/../services/wishListService.php';


class UserController {

    private $userService;
    private $wishListService;

    function __construct() {
        $this->userService = new UserService;
        $this->wishListService = new WishListService;
    }

    public function index() {
        if (isset($_SESSION['username'])) {
            $user = $this->userService->getUserByUsername($_SESSION['username']);
            require __DIR__ . '/../views/user/index.php';
        } else {
            header('Location: /404');
        }
    }

    public function upgrade() {
        if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'normal') {
            $user = $this->userService->getUserByUsername($_SESSION['username']);
            require_once __DIR__ . '/../views/user/upgrade.php';
        } else {
            header('Location: /404');
        }
    }

    public function wishlist() {
        if (isset($_SESSION['username']) && isset($_SESSION['role']) && ($_SESSION['role'] == 'premium' || $_SESSION['role'] == 'admin')) {
            $wishList = $this->wishListService->getWishListByUserId($_SESSION['user_id']);
            require_once __DIR__ . '/../views/user/wishlist.php';
        } else {
            header('Location: /404');
        }
    }
}