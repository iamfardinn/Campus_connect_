<?php
class Student extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Student') {
            header('location: ' . URLROOT . '/auth/login');
            exit();
        }
        
        $this->resourceModel = $this->model('ResourceModel');
        $this->bookingModel = $this->model('BookingModel'); 
    }

    public function index() {
        $resources = $this->resourceModel->getResources();
        $data = ['resources' => $resources];
        $this->view('student/index', $data);
    }

    public function book($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'], // Adding User ID
                'resource_id' => $id,
                'date' => trim($_POST['date']),
                'start_time' => trim($_POST['start_time']),
                'end_time' => trim($_POST['end_time']),
                'purpose' => trim($_POST['purpose'])
            ];

            if ($this->bookingModel->createBooking($data)) {
                header('location: ' . URLROOT . '/student/my_bookings');
                exit();
            } else {
                die('Something went wrong during booking.');
            }
        } else {
            // To get resouce from database
            $resource = $this->resourceModel->getResourceById($id);
            
            // No Resouce found & Invalid ID
            if(!$resource) {
                header('location: ' . URLROOT . '/student/index');
                exit();
            }

            $data = [
                'resource' => $resource 
            ];
            $this->view('student/book', $data);
        }
    }

    public function my_bookings() {
        $bookings = $this->bookingModel->getUserBookings($_SESSION['user_id']);
        $data = ['bookings' => $bookings];
        $this->view('student/my_bookings', $data);
    }
}