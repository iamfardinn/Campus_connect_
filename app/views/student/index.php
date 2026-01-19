<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="dashboard-container">
    <!-- Header Section with Reports Button -->
    <div class="welcome-section">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1>Welcome, <?php echo $_SESSION['user_name']; ?>! 👋</h1>
                <p>Discover and book campus resources for your academic needs.</p>
            </div>
            <div class="welcome-actions">
                <a href="<?php echo URLROOT; ?>/student/my_bookings" class="btn btn-light">
                    <i class="bi bi-calendar-check-fill"></i> My Bookings
                </a>
                <a href="<?php echo URLROOT; ?>/student/reports" class="btn btn-warning">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i> View Reports
                </a>
            </div>
        </div>
    </div>

    <!-- Available Resources Section -->
    <div class="section-header">
        <h2><i class="bi bi-grid-3x3-gap-fill"></i> Available Resources</h2>
    </div>

    <div class="resources-grid">
        <?php foreach($data['resources'] as $resource): ?>
            <div class="resource-card">
                <div class="card-header">
                    <h4><?php echo $resource->name; ?></h4>
                </div>
                <div class="card-body">
                    <div class="resource-info">
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill icon-location"></i>
                            <span><?php echo $resource->location; ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-tag-fill icon-type"></i>
                            <span>Type: <?php echo $resource->type; ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-people-fill icon-capacity"></i>
                            <span>Total Capacity: <?php echo $resource->capacity; ?></span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-check-circle-fill icon-available"></i>
                            <span><strong>Available: <?php echo $resource->available_capacity; ?></strong></span>
                        </div>
                    </div>
                    
                    <!-- Status Badge -->
                    <?php if ($resource->available_capacity > 0): ?>
                        <span class="badge badge-success">
                            <i class="bi bi-check-circle-fill"></i> Available (<?php echo $resource->available_capacity; ?> slots)
                        </span>
                    <?php else: ?>
                        <span class="badge badge-danger">
                            <i class="bi bi-x-circle-fill"></i> Fully Booked
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Card Footer with Book Button -->
                <!-- Card Footer with Book Button -->
<div class="card-footer">
    <?php if ($resource->available_capacity > 0): ?>
        <a href="<?php echo URLROOT; ?>/student/book/<?php echo $resource->resource_id; ?>" 
           class="btn btn-primary">
            <i class="bi bi-calendar-plus-fill"></i> Book Now
        </a>
    <?php else: ?>
        <button class="btn btn-disabled" disabled>
            <i class="bi bi-lock-fill"></i> Fully Booked
        </button>
    <?php endif; ?>
</div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        min-height: 100vh;
        color: #f8fafc;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    /* Dashboard Container */
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }
    
    /* Welcome Section */
    .welcome-section {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.9), rgba(168, 85, 247, 0.9));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 3rem;
        margin-bottom: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }
    
    .welcome-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }
    
    .welcome-text h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .welcome-text p {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }
    
    .welcome-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    /* Section Header */
    .section-header {
        margin-bottom: 2rem;
    }
    
    .section-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    /* Resources Grid */
    .resources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }
    
    /* Resource Card */
    .resource-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }
    
    .resource-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(99, 102, 241, 0.4);
    }
    
    .card-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        padding: 1.5rem;
    }
    
    .card-header h4 {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }
    
    .card-body {
        padding: 1.5rem;
        flex: 1;
    }
    
    .resource-info {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #334155;
        font-weight: 500;
        font-size: 0.95rem;
    }
    
    .info-item i {
        font-size: 1.25rem;
    }
    
    .icon-location {
        color: #6366f1;
    }
    
    .icon-type {
        color: #10b981;
    }
    
    .icon-capacity {
        color: #3b82f6;
    }
    
    .icon-available {
        color: #f59e0b;
    }
    
    .card-footer {
        padding: 1rem 1.5rem;
        background: rgba(0, 0, 0, 0.02);
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .badge-success {
        background: #dcfce7;
        color: #15803d;
    }
    
    .badge-danger {
        background: #fee2e2;
        color: #dc2626;
    }
    
    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        width: 100%;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }
    
    .btn-disabled {
    background: #94a3b8;
    color: white;
    width: 100%;
    cursor: not-allowed;
    opacity: 0.7;
}

    
    .btn-light {
        background: white;
        color: #1e293b;
        border: 2px solid white;
    }
    
    .btn-light:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: #1e293b;
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.4);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 2rem 1rem;
        }
        
        .welcome-section {
            padding: 2rem;
        }
        
        .welcome-content {
            flex-direction: column;
            align-items: stretch;
        }
        
        .welcome-text h1 {
            font-size: 1.75rem;
        }
        
        .welcome-text p {
            font-size: 1rem;
        }
        
        .welcome-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
        
        .resources-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
    
    @media (max-width: 480px) {
        .welcome-text h1 {
            font-size: 1.5rem;
        }
        
        .section-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
