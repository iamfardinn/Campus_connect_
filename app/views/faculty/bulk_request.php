<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
    body { background: #0f172a; color: white; }
    
    .glass-panel {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        padding: 40px;
    }


    .resource-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
        margin-bottom: 30px;
    }


    .selection-card {
        cursor: pointer;
        position: relative;
    }

    .selection-card input {
        position: absolute;
        opacity: 0;
    }

    .card-content {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid transparent;
        border-radius: 15px;
        padding: 15px;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .selection-card input:checked + .card-content {
        background: rgba(99, 102, 241, 0.2);
        border-color: #818cf8;
        box-shadow: 0 0 15px rgba(129, 140, 248, 0.3);
    }

    .selection-card:hover .card-content {
        background: rgba(255, 255, 255, 0.1);
    }

    .form-control {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        border-radius: 12px !important;
        padding: 12px !important;
    }

    .submit-btn {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 15px;
        border-radius: 15px;
        transition: 0.3s;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.4);
    }

    /* Scrollbar Styling */
    .resource-grid::-webkit-scrollbar { width: 6px; }
    .resource-grid::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
</style>

<div class="container py-5">
    <div class="glass-panel shadow-lg">
        <div class="mb-5 text-center">
            <h2 class="fw-bold"><i class="bi bi-stack me-2 text-primary"></i>Bulk Resource Request</h2>
            <p class="opacity-50">Select multiple resources and set your schedule below.</p>
        </div>

        <form action="<?php echo URLROOT; ?>/faculty/bulk_request" method="post">
            
            <label class="form-label fw-bold mb-3 text-uppercase small opacity-75">1. Select Resources</label>
            <div class="resource-grid mb-4">
                <?php foreach($data['resources'] as $resource) : ?>
                <label class="selection-card">
                    <input type="checkbox" name="resources[]" value="<?php echo $resource->resource_id; ?>">
                    <div class="card-content">
                        <i class="bi bi-cpu fs-3 mb-2 opacity-75"></i>
                        <div class="small fw-bold"><?php echo $resource->name; ?></div>
                        <div class="extra-small opacity-50" style="font-size: 0.7rem;"><?php echo $resource->location; ?></div>
                    </div>
                </label>
                <?php endforeach; ?>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Reservation Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Start Time</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">End Time</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Purpose of Bulk Booking</label>
                    <textarea name="purpose" class="form-control" rows="3" placeholder="Describe the event or requirement..." required></textarea>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="submit-btn w-100 shadow-lg">
                    Submit Bulk Request <i class="bi bi-send-fill ms-2"></i>
                </button>
                <a href="<?php echo URLROOT; ?>/faculty/index" class="btn btn-link w-100 text-white-50 text-decoration-none mt-3">Cancel and Go Back</a>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>