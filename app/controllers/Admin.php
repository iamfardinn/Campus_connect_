<?php

class Admin extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Admin') {
            header('location: ' . URLROOT . '/auth/login');
            exit();
        }
        $this->bookingModel = $this->model('BookingModel');
    }

    public function index() {
        $bookings = $this->bookingModel->getAllBookings();
        $data = ['bookings' => $bookings];
        $this->view('admin/index', $data);
    }

    public function approve($id) {
        if($this->bookingModel->updateStatus($id, 'Approved')) {
            header('location: ' . URLROOT . '/admin/index');
            exit();
        } else {
            die('Update failed for ID: ' . $id);
        }
    }

    public function reject($id) {
        if($this->bookingModel->updateStatus($id, 'Rejected')) {
            header('location: ' . URLROOT . '/admin/index');
            exit();
        } else {
            die('Update failed for ID: ' . $id);
        }
    }
}