<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
    body { background: #0f172a; color: white; }

    .booking-container {
        max-width: 600px;
        margin: 50px auto;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .resource-badge {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 20px;
    }

    .form-label {
        color: rgba(255, 255, 255, 0.6);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        margin-left: 5px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 15px !important;
        color: white !important;
        padding: 12px 20px !important;
        transition: 0.3s;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.08) !important;
        border-color: #6366f1 !important;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.2) !important;
    }

    .confirm-btn {
        background: white;
        color: #0f172a;
        font-weight: 800;
        border: none;
        padding: 15px;
        border-radius: 15px;
        width: 100%;
        margin-top: 20px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .confirm-btn:hover {
        background: #818cf8;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }

    .cancel-link {
        display: block;
        text-align: center;
        color: rgba(255, 255, 255, 0.4);
        text-decoration: none;
        margin-top: 20px;
        font-size: 0.9rem;
    }

    .cancel-link:hover { color: #f87171; }
</style>

<div class="container booking-container">
    <div class="glass-card">
        <div class="text-center mb-4">
            <div class="resource-badge">New Reservation</div>
            <h2 class="fw-bold mb-1"><?php echo $data['resource']->name; ?></h2>
            <p class="opacity-50"><i class="bi bi-geo-alt me-1"></i><?php echo $data['resource']->location; ?></p>
        </div>

        <form action="<?php echo URLROOT; ?>/student/book/<?php echo $data['resource']->resource_id; ?>" method="post">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Reservation Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Purpose of Booking</label>
                    <textarea name="purpose" class="form-control" rows="3" placeholder="Explain why you need this resource..." required></textarea>
                </div>
            </div>

            <button type="submit" class="confirm-btn">
                Confirm Booking <i class="bi bi-arrow-right-short fs-4"></i>
            </button>

            <a href="<?php echo URLROOT; ?>/student/index" class="cancel-link">
                Maybe later, take me back
            </a>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>