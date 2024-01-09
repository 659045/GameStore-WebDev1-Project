<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller {
    
    public function index() {
        $this->displayView($this);
    }

    public function about() {
        $this->displayView($this);
    }
}