<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
   
    body {
        background: #0f172a;
        color: #f8fafc;
    }

    .welcome-section {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
        border-radius: 24px;
        padding: 40px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 40px;
    }

    .resource-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .resource-card:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.07);
        border-color: #818cf8;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .quick-book-btn {
        background: #ffffff;
        color: #0f172a;
        font-weight: 700;
        border-radius: 12px;
        padding: 10px 20px;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .quick-book-btn:hover {
        background: #818cf8;
        color: white;
    }

    .stat-badge {
        background: rgba(129, 140, 248, 0.1);
        color: #818cf8;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .nav-pill-custom {
        background: rgba(255, 255, 255, 0.05);
        padding: 10px 25px;
        border-radius: 15px;
        color: white;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: 0.3s;
    }

    .nav-pill-custom:hover {
        background: #6366f1;
        color: white;
    }
</style>

<div class="container py-5">
    <div class="welcome-section d-md-flex align-items-center justify-content-between text-center text-md-start">
        <div>
            <h1 class="fw-bold mb-2">Faculty Dashboard</h1>
            <p class="opacity-50 mb-0">Welcome back, <span class="text-primary fw-bold"><?php echo $_SESSION['user_name']; ?></span>. Manage resources and endorsements here.</p>
        </div>
        <div class="mt-4 mt-md-0 d-flex gap-2">
            <a href="<?php echo URLROOT; ?>/faculty/bulk_request" class="nav-pill-custom"><i class="bi bi-layers-half me-2"></i>Bulk Request</a>
            
            <a href="<?php echo URLROOT; ?>/faculty/endorsements" class="nav-pill-custom"><i class="bi bi-eye me-2"></i>Student Requests</a>
        </div>
    </div>

    <div class="d-flex align-items-center mb-4">
        <h3 class="fw-bold mb-0">Available Resources</h3>
        <hr class="flex-grow-1 ms-3 opacity-10">
    </div>

    <div class="row g-4">
        <?php foreach($data['resources'] as $resource) : ?>
        <div class="col-md-4 col-lg-3">
            <div class="resource-card p-4 h-100 d-flex flex-column">
                <div class="card-icon">
                    <i class="bi bi-building fs-4"></i>
                </div>
                <h5 class="fw-bold mb-1"><?php echo $resource->name; ?></h5>
                <p class="small opacity-50 mb-3"><i class="bi bi-geo-alt me-1"></i><?php echo $resource->location; ?></p>
                
                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="stat-badge">Available</span>
                    </div>
                    <a href="<?php echo URLROOT; ?>/faculty/book/<?php echo $resource->resource_id; ?>" class="quick-book-btn">
                        Quick Book <i class="bi bi-lightning-fill ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>