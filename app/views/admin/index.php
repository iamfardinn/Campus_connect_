<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
    body { background: #0f172a; color: white; }
    .admin-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 25px; padding: 30px; margin-top: 20px; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 12px; }
    .custom-table tbody tr { background: rgba(255, 255, 255, 0.05); transition: 0.3s; border-radius: 15px; }
    .custom-table td { padding: 20px 15px; vertical-align: middle; border: none; }
    .status-pill { padding: 6px 16px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; }
    .status-pending { background: rgba(245, 158, 11, 0.2); color: #fbbf24; }
    .status-approved { background: rgba(16, 185, 129, 0.2); color: #34d399; }
    .status-rejected { background: rgba(239, 68, 68, 0.2); color: #f87171; }
    .btn-action { padding: 8px 16px; border-radius: 10px; font-size: 0.8rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: 0.3s; }
    .btn-approve { border: 1px solid #34d399; color: #34d399; }
    .btn-approve:hover { background: #34d399; color: #0f172a; }
    .btn-reject { border: 1px solid #f87171; color: #f87171; }
    .btn-reject:hover { background: #f87171; color: #0f172a; }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Admin Control Panel</h2>
        <span class="badge bg-primary rounded-pill px-3 py-2">System Live: 2026</span>
    </div>

    <div class="admin-card">
        <table class="custom-table">
            <thead>
                <tr class="text-uppercase small opacity-50">
                    <th>User & Role</th>
                    <th>Resource</th>
                    <th>Date & Time</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['bookings'] as $request) : ?>
                <?php 
                    // Right ID & Date Handle
                    $b_id = isset($request->booking_id) ? $request->booking_id : (isset($request->id) ? $request->id : null);
                    $b_date = isset($request->booking_date) ? $request->booking_date : (isset($request->date) ? $request->date : 'N/A');
                ?>
                <tr>
                    <td>
                        <div class="fw-bold"><?php echo $request->user_name; ?></div>
                        <div class="small opacity-50"><i class="bi bi-person-badge"></i> 
                            <?php echo isset($request->role) ? $request->role : (isset($request->user_role) ? $request->user_role : 'Member'); ?>
                        </div>
                    </td>
                    <td><i class="bi bi-building text-primary me-2"></i><?php echo $request->resource_name; ?></td>
                    <td><div class="small fw-bold"><?php echo $b_date; ?></div></td>
                    <td class="small opacity-75"><?php echo $request->purpose; ?></td>
                    <td>
                        <span class="status-pill status-<?php echo strtolower($request->status); ?>">
                            <?php echo $request->status; ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <?php if($b_id): ?>
                                <a href="<?php echo URLROOT; ?>/admin/approve/<?php echo $b_id; ?>" class="btn-action btn-approve">
                                    <i class="bi bi-check2"></i> Approve
                                </a>
                                <a href="<?php echo URLROOT; ?>/admin/reject/<?php echo $b_id; ?>" class="btn-action btn-reject">
                                    <i class="bi bi-x-lg"></i> Reject
                                </a>
                            <?php else: ?>
                                <span class="text-danger small">No ID</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>