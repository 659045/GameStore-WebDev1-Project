<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller
{
    private $gameService;

    function __construct()
    {
        $this->gameService = new GameService();
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