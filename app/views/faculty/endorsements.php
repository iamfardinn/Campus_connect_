<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
    body { background: #0f172a; color: white; min-height: 100vh; }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        padding: 35px;
        margin-top: 30px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

  /* Table Design */
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
    .custom-table thead th { 
        color: rgba(255, 255, 255, 0.4); 
        font-size: 0.75rem; 
        text-transform: uppercase; 
        padding: 10px 20px;
        border: none;
    }

    .custom-table tbody tr { background: rgba(255, 255, 255, 0.04); transition: 0.3s; }
    .custom-table td { padding: 18px 20px; vertical-align: middle; border: none; }
    .custom-table td:first-child { border-radius: 15px 0 0 15px; }
    .custom-table td:last-child { border-radius: 0 15px 15px 0; }

    .btn-endorse {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .btn-endorse:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3); color: white; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-person-check me-2 text-primary"></i>Student Booking Requests</h2>
            <p class="opacity-50 mb-0">Review and endorse student requests for final admin approval.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/faculty/index" class="btn btn-outline-light btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="glass-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Resource</th>
                        <th>Date & Time</th>
                        <th>Purpose</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data['requests'])) : ?>
                        <?php foreach($data['requests'] as $request) : ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php 
                                      
                                        $name = '';
                                        if(isset($request->student_name)) {
                                            $name = $request->student_name;
                                        } elseif(isset($request->user_name)) {
                                            $name = $request->user_name;
                                        } else {
                                            $name = "Student";
                                        }
                                    ?>
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                        <?php echo substr($name, 0, 1); ?>
                                    </div>
                                    <span class="fw-bold"><?php echo $name; ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-dark border border-secondary"><?php echo $request->resource_name; ?></span>
                            </td>
                            <td class="small">
                                <div class="mb-1"><i class="bi bi-calendar3 me-2 opacity-50"></i><?php echo isset($request->date) ? $request->date : $request->booking_date; ?></div>
                                <div><i class="bi bi-clock me-2 opacity-50"></i><?php echo $request->start_time; ?></div>
                            </td>
                            <td class="small opacity-75">
                                <i class="bi bi-chat-left-text me-2"></i><?php echo $request->purpose; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo URLROOT; ?>/faculty/endorse/<?php echo $request->id; ?>" class="btn-endorse">
                                    Endorse <i class="bi bi-check-lg ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="5" class="text-center py-5 opacity-50">No pending requests found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>