<?php
namespace App\Controllers;

class HomeController
{
    private $gameService;

    function __construct()
    {
        $this->gameService = new \App\Services\GameService();
    }

    public function index()
    {
        $model = $this->gameService->getAll();
        require __DIR__ . '/../views/home/index.php';
    }

    public function about()
    {
        require __DIR__ . '/../views/home/about.php';
    }
}