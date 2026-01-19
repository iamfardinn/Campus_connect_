<?php
class ResourceModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Resouce collect
    public function getResources() {
        $this->db->query('SELECT * FROM resources WHERE status = "Available"');
        return $this->db->resultSet();
    }
    public function getResourceById($id) {
    $this->db->query("SELECT * FROM resources WHERE resource_id = :id");
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
}
}