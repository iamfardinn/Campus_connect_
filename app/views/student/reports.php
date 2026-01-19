<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-white">
                        <i class="bi bi-file-earmark-bar-graph-fill me-2"></i>
                        Booking Reports
                    </h1>
                    <p class="text-white-50">View your complete booking history and statistics</p>
                </div>
                <a href="<?php echo URLROOT; ?>/student/index" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card stat-total">
                <div class="stat-icon">
                    <i class="bi bi-clipboard-data-fill"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $data['stats']->total; ?></h3>
                    <p>Total Bookings</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card stat-approved">
                <div class="stat-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $data['stats']->approved; ?></h3>
                    <p>Approved</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card stat-pending">
                <div class="stat-icon">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $data['stats']->pending; ?></h3>
                    <p>Pending</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card stat-rejected">
                <div class="stat-icon">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $data['stats']->rejected; ?></h3>
                    <p>Rejected</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-lg mb-4 filter-card">
        <div class="card-body">
            <h5 class="mb-3"><i class="bi bi-funnel-fill me-2"></i>Filter Bookings</h5>
            <div class="btn-group" role="group">
                <a href="<?php echo URLROOT; ?>/student/reports" 
                   class="btn <?php echo (!$data['current_filter']) ? 'btn-primary' : 'btn-outline-primary'; ?>">
                    All Bookings
                </a>
                <a href="<?php echo URLROOT; ?>/student/reports?status=Approved" 
                   class="btn <?php echo ($data['current_filter'] == 'Approved') ? 'btn-success' : 'btn-outline-success'; ?>">
                    Approved
                </a>
                <a href="<?php echo URLROOT; ?>/student/reports?status=Pending" 
                   class="btn <?php echo ($data['current_filter'] == 'Pending') ? 'btn-warning' : 'btn-outline-warning'; ?>">
                    Pending
                </a>
                <a href="<?php echo URLROOT; ?>/student/reports?status=Rejected" 
                   class="btn <?php echo ($data['current_filter'] == 'Rejected') ? 'btn-danger' : 'btn-outline-danger'; ?>">
                    Rejected
                </a>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow-lg">
        <div class="card-header bg-gradient-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-list-ul me-2"></i>
                <?php 
                    if ($data['current_filter']) {
                        echo $data['current_filter'] . ' Bookings';
                    } else {
                        echo 'All Bookings';
                    }
                ?>
            </h4>
        </div>
        <div class="card-body p-0">
            <?php if(empty($data['bookings'])): ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="mt-3">No bookings found</h4>
                    <p class="text-muted">
                        <?php 
                            if ($data['current_filter']) {
                                echo "You don't have any " . strtolower($data['current_filter']) . " bookings.";
                            } else {
                                echo "You haven't made any bookings yet.";
                            }
                        ?>
                    </p>
                    <a href="<?php echo URLROOT; ?>/student/index" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Book a Resource
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Resource</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Booked On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['bookings'] as $booking): ?>
                                <tr>
                                    <td class="fw-bold">#<?php echo $booking->id; ?></td>
                                    <td>
                                        <strong><?php echo $booking->resource_name; ?></strong>
                                    </td>
                                    <td>
                                        <i class="bi bi-geo-alt-fill text-primary me-1"></i>
                                        <?php echo $booking->resource_location; ?>
                                    </td>
                                    <td>
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?php echo date('M d, Y', strtotime($booking->booking_date)); ?>
                                    </td>
                                    <td>
                                        <i class="bi bi-clock me-1"></i>
                                        <?php echo date('h:i A', strtotime($booking->start_time)); ?> - 
                                        <?php echo date('h:i A', strtotime($booking->end_time)); ?>
                                    </td>
                                    <td>
                                        <small><?php echo substr($booking->purpose, 0, 50) . '...'; ?></small>
                                    </td>
                                    <td>
                                        <?php
                                            $badge_class = 'secondary';
                                            $icon = 'info-circle';
                                            
                                            if($booking->status == 'Approved') {
                                                $badge_class = 'success';
                                                $icon = 'check-circle-fill';
                                            } elseif($booking->status == 'Rejected') {
                                                $badge_class = 'danger';
                                                $icon = 'x-circle-fill';
                                            } elseif($booking->status == 'Pending') {
                                                $badge_class = 'warning';
                                                $icon = 'clock-fill';
                                            }
                                        ?>
                                        <span class="badge bg-<?php echo $badge_class; ?>">
                                            <i class="bi bi-<?php echo $icon; ?> me-1"></i>
                                            <?php echo $booking->status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo date('M d, Y', strtotime($booking->created_at)); ?>
                                        </small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
    
    .stat-total .stat-icon {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
    }
    
    .stat-approved .stat-icon {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .stat-pending .stat-icon {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .stat-rejected .stat-icon {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }
    
    .stat-info h3 {
        color: white;
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
    }
    
    .stat-info p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        font-weight: 500;
    }
    
    .filter-card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 20px;
    }
    
    .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
    }
    
    .table {
        color: #1e293b;
    }
    
    .table-dark {
        background: linear-gradient(135deg, #1e293b, #334155);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.05);
    }
</style>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
