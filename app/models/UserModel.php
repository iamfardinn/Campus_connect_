<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        // Check row
        return ($this->db->rowCount() > 0) ? true : false;
    }

    // Register User
    public function register($data) {
        $this->db->query('INSERT INTO users (full_name, email, password, role, student_id, faculty_dept) VALUES(:name, :email, :password, :role, :student_id, :faculty_dept)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':faculty_dept', $data['faculty_dept']);

        // Execute
        return $this->db->execute() ? true : false;
    }

    // Login User
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
}