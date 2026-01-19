<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>

    body {
        background: #0f172a;
        color: #f8fafc;
        min-height: 100vh;
    }

    .glass-container {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 30px;
        padding: 40px;
        margin-top: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

  
    .booking-row {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 15px;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .booking-row:hover {
        background: rgba(255, 255, 255, 0.06);
        transform: scale(1.01);
        border-color: rgba(99, 102, 241, 0.4);
    }


    .badge-pill {
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
    .status-approved { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
    .status-rejected { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }

    .resource-icon {
        width: 45px;
        height: 45px;
        background: rgba(99, 102, 241, 0.1);
        color: #818cf8;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cancel-btn {
        background: rgba(239, 68, 68, 0.1);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.2);
        padding: 8px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: 0.3s;
    }

    .cancel-btn:hover {
        background: #ef4444;
        color: white;
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">My Bookings Dashboard</h1>
            <p class="opacity-50 small mb-0">Track and manage your resource requests efficiently.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/student/index" class="text-white-50 text-decoration-none small">
            <i class="bi bi-arrow-left me-1"></i> Back to Browse
        </a>
    </div>

    <div class="glass-container">
        <div class="row px-4 mb-3 d-none d-md-flex opacity-25 small text-uppercase fw-bold letter-spacing-1">
            <div class="col-md-3">Resource</div>
            <div class="col-md-2">Date</div>
            <div class="col-md-2">Time</div>
            <div class="col-md-2">Status</div>
            <div class="col-md-3 text-end">Action</div>
        </div>

        <?php if(!empty($data['bookings'])) : ?>
            <?php foreach($data['bookings'] as $booking) : ?>
            <div class="booking-row">
                <div class="row align-items-center">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="d-flex align-items-center">
                            <div class="resource-icon me-3">
                                <i class="bi bi-building"></i>
                            </div>
                            <div>
                                <div class="fw-bold"><?php echo $booking->resource_name; ?></div>
                                <div class="small opacity-50"><?php echo $booking->purpose; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2 mb-2 mb-md-0">
                        <i class="bi bi-calendar3 me-2 opacity-50"></i>
                        <?php echo isset($booking->date) ? $booking->date : $booking->booking_date; ?>
                    </div>

                    <div class="col-md-2 mb-2 mb-md-0">
                        <i class="bi bi-clock me-2 opacity-50"></i>
                        <span class="small"><?php echo $booking->start_time; ?></span>
                    </div>

                    <div class="col-md-2 mb-3 mb-md-0">
                        <span class="badge-pill status-<?php echo strtolower($booking->status); ?>">
                            <?php echo $booking->status; ?>
                        </span>
                    </div>

                    <div class="col-md-3 text-md-end">
                        <?php if($booking->status == 'Pending') : ?>
                            <a href="<?php echo URLROOT; ?>/student/cancel/<?php echo $booking->id; ?>" 
                               class="cancel-btn" 
                               onclick="return confirm('Are you sure you want to cancel this booking?')">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </a>
                        <?php else : ?>
                            <span class="opacity-25 small">Locked</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 opacity-10"></i>
                <p class="opacity-50 mt-3">You haven't made any bookings yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>