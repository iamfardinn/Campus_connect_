<?php
class ResourceModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get all resources
    public function getResources() {
        $this->db->query('SELECT * FROM resources ORDER BY name ASC');
        return $this->db->resultSet();
    }

    // Get a single resource by ID
    public function getResourceById($id) {
        $this->db->query('SELECT * FROM resources WHERE resource_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Decrease available capacity when booking is approved
    public function decreaseCapacity($resource_id) {
        $this->db->query('UPDATE resources 
                         SET available_capacity = available_capacity - 1 
                         WHERE resource_id = :id AND available_capacity > 0');
        $this->db->bind(':id', $resource_id);
        return $this->db->execute();
    }

    // Increase available capacity when booking is rejected/cancelled
    public function increaseCapacity($resource_id) {
        $this->db->query('UPDATE resources 
                         SET available_capacity = available_capacity + 1 
                         WHERE resource_id = :id AND available_capacity < capacity');
        $this->db->bind(':id', $resource_id);
        return $this->db->execute();
    }

    // Check if resource has available capacity
    public function hasAvailableCapacity($resource_id) {
        $this->db->query('SELECT available_capacity FROM resources WHERE resource_id = :id');
        $this->db->bind(':id', $resource_id);
        $resource = $this->db->single();
        
        return ($resource && $resource->available_capacity > 0);
    }
}
