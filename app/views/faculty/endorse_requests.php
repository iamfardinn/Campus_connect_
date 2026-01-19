<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
    body { background: #0f172a; color: white; }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        padding: 30px;
        margin-top: 20px;
    }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 12px; }
    .custom-table tbody tr { background: rgba(255, 255, 255, 0.05); border-radius: 15px; }
    .custom-table td { padding: 20px 15px; vertical-align: middle; border: none; }
    .status-pill { padding: 6px 16px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; background: rgba(245, 158, 11, 0.2); color: #fbbf24; }
    .btn-action { padding: 8px 16px; border-radius: 10px; font-size: 0.8rem; font-weight: 600; text-decoration: none; border: 1px solid #34d399; color: #34d399; }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Student Requests</h2>
        <a href="<?php echo URLROOT; ?>/faculty/index" class="btn btn-outline-light btn-sm rounded-pill">Back to Dashboard</a>
    </div>

    <div class="glass-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr class="text-uppercase small opacity-50">
                        <th>Student Name</th>
                        <th>Resource</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data['requests'])) : ?>
                        <?php foreach($data['requests'] as $request) : ?>
                        <tr>
                            <td><div class="fw-bold"><?php echo $request->student_name; ?></div></td>
                            <td><?php echo $request->resource_name; ?></td>
                            <td class="small"><?php echo $request->date; ?> | <?php echo $request->start_time; ?></td>
                            <td><span class="status-pill"><?php echo $request->status; ?></span></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/faculty/endorse/<?php echo $request->id; ?>" class="btn-action">Endorse Request</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="5" class="text-center py-5 opacity-50">No pending student requests.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>