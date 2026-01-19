<?php
class Auth extends Controller {
    public function __construct() {
        // Load the user model
        $this->userModel = $this->model('UserModel');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the registration form data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
                'role' => $_POST['role'],
                'student_id' => $_POST['student_id'] ?? null,
                'faculty_dept' => $_POST['faculty_dept'] ?? null
            ];

            // Save user via model
            if ($this->userModel->register($data)) {
                // Redirect to login page upon success
                header('location: ' . URLROOT . '/auth/login');
            } else {
                die('Something went wrong during registration');
            }
        } else {
            // Display the registration form
            $this->view('auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect login credentials
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Attempt to login the user
            $loggedInUser = $this->userModel->login($email, $password);

            if ($loggedInUser) {
                // User found, create session and redirect
                $this->createUserSession($loggedInUser);
            } else {
                // Error handling (simple version)
                die('Invalid email or password');
            }
        } else {
            // Display the login form
            $this->view('auth/login');
        }
    }

    public function createUserSession($user) {
        // Storing user data in PHP Sessions
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role;

        // Redirect based on the user role defined in database
        // Use lowercase check to avoid spelling mismatches
        $role = strtolower($user->role);

        if($role == 'admin'){
            header('location: ' . URLROOT . '/admin/index');
        } elseif($role == 'faculty') {
            header('location: ' . URLROOT . '/faculty/index');
        } elseif($role == 'student') {
            header('location: ' . URLROOT . '/student/index');
        } else {
            // Default redirect if no role matches
            header('location: ' . URLROOT . '/pages/index');
        }
        exit(); // Ensure no further code executes after redirect
    }

    public function logout() {
        // Clear all session variables
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        
        // Return to login page
        header('location: ' . URLROOT . '/auth/login');
        exit();
    }
}