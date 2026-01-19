<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusConnect | Smart Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; }
        .navbar { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo URLROOT; ?>">CampusConnect</a>
        <div class="ms-auto">
            <span class="text-white me-3 small"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?></span>
            <a href="<?php echo URLROOT; ?>/auth/logout" class="btn btn-sm btn-light rounded-pill">Logout</a>
        </div>
    </div>
</nav>

<div class="container">