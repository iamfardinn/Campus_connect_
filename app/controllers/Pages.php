<?php
class Pages extends Controller {
    public function __construct() {
        // Model Load
    }

    public function index() {
        $data = [
            'title' => 'Welcome to Campus Connect',
            'description' => 'Smart Resource Booking & Management System'
        ];
        
        // view load
        $this->view('pages/index', $data);
    }
}