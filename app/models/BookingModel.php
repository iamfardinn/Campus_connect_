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
// Get user bookings filtered by status (for reports)
public function getUserBookingsByStatus($userId, $status = null) {
    if ($status) {
        $this->db->query('SELECT bookings.*, bookings.booking_id as id, resources.name as resource_name,
                         resources.location as resource_location
                         FROM bookings
                         JOIN resources ON bookings.resource_id = resources.resource_id
                         WHERE bookings.user_id = :user_id AND bookings.status = :status
                         ORDER BY bookings.created_at DESC');
        $this->db->bind(':status', $status);
    } else {
        $this->db->query('SELECT bookings.*, bookings.booking_id as id, resources.name as resource_name,
                         resources.location as resource_location
                         FROM bookings
                         JOIN resources ON bookings.resource_id = resources.resource_id
                         WHERE bookings.user_id = :user_id
                         ORDER BY bookings.created_at DESC');
    }
    
    $this->db->bind(':user_id', $userId);
    return $this->db->resultSet();
}

// Get booking statistics for a user
public function getUserBookingStats($userId) {
    $this->db->query('SELECT 
                     COUNT(*) as total,
                     SUM(CASE WHEN status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending
                     FROM bookings
                     WHERE user_id = :user_id');
    
    $this->db->bind(':user_id', $userId);
    return $this->db->single();
}

    
    // Get pending bookings made by students only
    public function getStudentPendingRequests() {
        $this->db->query('SELECT bookings.*, bookings.booking_id as id, resources.name as resource_name,
                         users.full_name as student_name, users.full_name as user_name
                         FROM bookings
                         JOIN resources ON bookings.resource_id = resources.resource_id
                         JOIN users ON bookings.user_id = users.user_id
                         WHERE users.role = "Student" AND bookings.status = "Pending"
                         ORDER BY bookings.created_at DESC');
        
        return $this->db->resultSet();
    }

    // Update booking status to 'Approved' by Faculty  ← FIXED
    public function endorseBooking($id) {
        $this->db->query('UPDATE bookings SET status = "Approved" WHERE booking_id = :id');
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

    // Update booking status (Approve/Reject/Cancel)
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE bookings SET status = :status WHERE booking_id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Save multiple resource requests for Faculty
    public function createBulkRequest($data, $resourceIds) {
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
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
