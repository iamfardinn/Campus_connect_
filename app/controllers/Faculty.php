<?php
class Faculty extends Controller {
    public function __construct() {
        // Access control: only for logged in Faculty
        if (!isset($_SESSION['user_id']) || strtolower($_SESSION['user_role']) != 'faculty') {
            header('location: ' . URLROOT . '/auth/login');
        }
        
        // Load models
        $this->resourceModel = $this->model('ResourceModel');
        $this->bookingModel = $this->model('BookingModel');
    }

    public function index() {
        // Faculty home: can see overall status or resources
        $resources = $this->resourceModel->getResources();
        $data = [
            'resources' => $resources
        ];
        $this->view('faculty/index', $data);
    }
    // Inside app/controllers/Faculty.php

public function bulk_request() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect and sanitize form data
        $data = [
            'resource_ids' => $_POST['resources'], // Array of selected resource IDs
            'date' => trim($_POST['date']),
            'start_time' => trim($_POST['start_time']),
            'end_time' => trim($_POST['end_time']),
            'purpose' => trim($_POST['purpose'])
        ];

        if ($this->bookingModel->createBulkRequest($data, $data['resource_ids'])) {
            header('location: ' . URLROOT . '/faculty/index');
        } else {
            die('Something went wrong during bulk request');
        }
    } else {
        // Show all resources so faculty can pick multiple
        $resources = $this->resourceModel->getResources();
        $data = ['resources' => $resources];
        $this->view('faculty/bulk_request', $data);
    }
}
// Inside Faculty class in app/controllers/Faculty.php

public function endorsements() {
    // Fetch bookings that are requested by Students and are still 'Pending'
    // You might need a new method in your BookingModel for this
    $pendingRequests = $this->bookingModel->getStudentPendingRequests();

    $data = [
        'requests' => $pendingRequests
    ];

    $this->view('faculty/endorsements', $data);
}

// Method to handle the endorsement action
public function endorse($id) {
    if ($this->bookingModel->endorseBooking($id)) {
        // Redirect back with success (you can add flash messages later)
        header('location: ' . URLROOT . '/faculty/endorsements');
    } else {
        die('Something went wrong while endorsing');
    }
}

}