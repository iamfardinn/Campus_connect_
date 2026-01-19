<?php
class BookingModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Save a new booking request for Students
    public function createBooking($data) {
        $this->db->query('INSERT INTO bookings (user_id, resource_id, booking_date, start_time, end_time, purpose, status) 
                          VALUES(:user_id, :resource_id, :date, :start, :end, :purpose, "Pending")');
        
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':resource_id', $data['resource_id']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':start', $data['start_time']);
        $this->db->bind(':end', $data['end_time']);
        $this->db->bind(':purpose', $data['purpose']);

        return $this->db->execute();
    }

    // Get all bookings for a specific logged-in user
    public function getUserBookings($userId) {
       
        $this->db->query('SELECT bookings.*, bookings.booking_id as id, resources.name as resource_name 
                          FROM bookings 
                          JOIN resources ON bookings.resource_id = resources.resource_id 
                          WHERE bookings.user_id = :user_id 
                          ORDER BY bookings.created_at DESC');
        
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    // Save multiple resource requests for Faculty
    public function createBulkRequest($data, $resourceIds) {
        $this->db->query('START TRANSACTION');
        try {
            foreach($resourceIds as $resId) {
                $this->db->query('INSERT INTO bookings (user_id, resource_id, booking_date, start_time, end_time, purpose, status) 
                                  VALUES(:user_id, :resource_id, :date, :start, :end, :purpose, "Approved")');
                
                $this->db->bind(':user_id', $_SESSION['user_id']);
                $this->db->bind(':resource_id', $resId);
                $this->db->bind(':date', $data['date']);
                $this->db->bind(':start', $data['start_time']);
                $this->db->bind(':end', $data['end_time']);
                $this->db->bind(':purpose', $data['purpose']);
                $this->db->execute();
            }
            $this->db->query('COMMIT');
            return true;
        } catch (Exception $e) {
            $this->db->query('ROLLBACK');
            return false;
        }
    }

    // Get pending bookings made by students only
    public function getStudentPendingRequests() {
    
        $this->db->query('SELECT bookings.*, bookings.booking_id as id, resources.name as resource_name, 
                                 users.full_name as student_name, users.full_name as user_name 
                          FROM bookings 
                          JOIN resources ON bookings.resource_id = resources.resource_id 
                          JOIN users ON bookings.user_id = users.user_id 
                          WHERE users.role = "Student" AND bookings.status = "Pending"');
        
        return $this->db->resultSet();
    }

    // Update booking status to 'Endorsed' by Faculty
    public function endorseBooking($id) {
       
        $this->db->query('UPDATE bookings SET status = "Endorsed" WHERE booking_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Get all bookings from all users for Admin
    public function getAllBookings() {
        $this->db->query('SELECT bookings.*, bookings.booking_id as id, resources.name as resource_name, 
                                 users.full_name as user_name, users.role as user_role 
                          FROM bookings 
                          JOIN resources ON bookings.resource_id = resources.resource_id 
                          JOIN users ON bookings.user_id = users.user_id
                          ORDER BY bookings.created_at DESC');
        
        return $this->db->resultSet();
    }

    // Update booking status (Approve/Reject)
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE bookings SET status = :status WHERE booking_id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}