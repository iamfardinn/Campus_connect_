<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
   
    body {
        background: #0f172a;
        color: #f8fafc;
    }

    .welcome-banner {
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
        height: 100%;
        display: flex;
        flex-direction: column;
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
        font-size: 1.5rem;
    }

    .book-btn {
        background: #ffffff;
        color: #0f172a;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px;
        text-decoration: none;
        transition: 0.3s;
        display: block;
        text-align: center;
        margin-top: auto;
    }

    .book-btn:hover {
        background: #818cf8;
        color: white;
        box-shadow: 0 8px 15px rgba(129, 140, 248, 0.4);
    }

    .badge-status {
        background: rgba(129, 140, 248, 0.1);
        color: #818cf8;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>

<div class="container py-5">
    <div class="welcome-banner text-center text-md-start">
        <h1 class="fw-bold mb-2 text-white">Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
        <p class="opacity-50 mb-0">Discover and book campus resources for your academic needs.</p>
    </div>

    <div class="d-flex align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-white">Available Resources</h3>
        <hr class="flex-grow-1 ms-3 opacity-10">
    </div>

    <div class="row g-4">
        <?php foreach($data['resources'] as $resource) : ?>
        <div class="col-md-4 col-lg-3">
            <div class="resource-card p-4">
                <div class="card-icon text-white">
                    <i class="bi bi-cpu"></i>
                </div>
                
                <h5 class="fw-bold text-white mb-1"><?php echo $resource->name; ?></h5>
                <p class="small opacity-50 mb-3">
                    <i class="bi bi-geo-alt me-1"></i><?php echo $resource->location; ?>
                </p>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small opacity-50">Type:</span>
                        <span class="small fw-bold"><?php echo $resource->type; ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="small opacity-50">Capacity:</span>
                        <span class="small fw-bold"><?php echo $resource->capacity; ?></span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge-status">Active</span>
                </div>

                <a href="<?php echo URLROOT; ?>/student/book/<?php echo $resource->resource_id; ?>" class="book-btn">
                    Book Now <i class="bi bi-lightning-fill ms-1"></i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>