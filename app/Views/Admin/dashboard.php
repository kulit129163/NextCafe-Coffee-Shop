<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NextCafe</title>
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/all.min.css">
</head>
<body>
    
    <?= view('partials/admin_sidebar') ?>

    <div class="main-wrapper">
        <div class="header-top">
            <h1>Admin Dashboard</h1>
            <div class="header-right">
                <div class="current-date">
                    <i class="far fa-calendar"></i> <?= date('M j, Y') ?>
                </div>
                <div class="user-meta">
                    <div class="user-avatar">
                        <?= strtoupper(substr($user->username ?? 'A', 0, 1)) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-container">
            <div class="dashboard-stats" style="grid-template-columns: repeat(4, 1fr);">
                <div class="stat-card" style="background: var(--white); color: var(--text-dark); border: 1px solid var(--border);">
                    <div>
                        <div class="label" style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Revenue</div>
                        <div class="value" style="font-size: 1.5rem; color: var(--text-dark);">₱<?= number_format($total_revenue, 2) ?></div>
                    </div>
                </div>

                <div class="stat-card" style="background: var(--white); color: var(--text-dark); border: 1px solid var(--border);">
                    <div>
                        <div class="label" style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Orders</div>
                        <div class="value" style="font-size: 1.5rem; color: var(--text-dark);"><?= $total_orders ?></div>
                    </div>
                    <a href="<?= base_url('admin/orders') ?>" class="view-link" style="color: var(--primary);">View All &rarr;</a>
                </div>

                <div class="stat-card blue">
                    <div>
                        <div class="label">Products</div>
                        <div class="value" style="font-size: 1.5rem;"><?= $total_products ?></div>
                    </div>
                    <a href="<?= base_url('admin/products') ?>" class="view-link">View Details &rarr;</a>
                </div>

                <div class="stat-card green">
                    <div>
                        <div class="label">Customers</div>
                        <div class="value" style="font-size: 1.5rem;"><?= $total_customers ?></div>
                    </div>
                    <a href="<?= base_url('admin/categories') ?>" class="view-link">View Details &rarr;</a>
                </div>
            </div>

            <div class="quick-actions">
                <h3>Quick Actions</h3>
                <div class="action-buttons">
                    <a href="<?= base_url('admin/products/add') ?>" class="btn-outline btn-outline-primary">Add New Product</a>
                    <a href="#" class="btn-outline btn-outline-success">Add New Category</a>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="card-wrapper" id="orders" style="margin-top: 3rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 700;">Recent Orders</h2>
                </div>

                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_orders)): ?>
                                <tr><td colspan="6" style="text-align: center; padding: 3rem;">No recent orders.</td></tr>
                            <?php else: ?>
                                <?php foreach ($recent_orders as $order): ?>
                                    <tr>
                                        <td style="font-weight: 600;">#<?= $order->id ?></td>
                                        <td><?= esc($order->customer_name) ?></td>
                                        <td style="color: var(--text-muted);"><?= date('M j, Y', strtotime($order->created_at)) ?></td>
                                        <td style="font-weight: 600;">₱<?= number_format($order->total_amount, 2) ?></td>
                                        <td>
                                            <span class="badge <?= $order->status == 'completed' ? 'badge-success' : ($order->status == 'pending' ? 'badge-warning' : 'badge-danger') ?>" style="text-transform: capitalize;">
                                                <?= esc($order->status) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="<?= site_url('admin/orders/update') ?>" method="POST" style="display: flex; align-items: center;">
                                                <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                                <select name="status" onchange="this.form.submit()" class="filter-select" style="padding: 0.35rem; font-size: 0.8rem; min-width: 110px;">
                                                    <option value="pending" <?= $order->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="completed" <?= $order->status == 'completed' ? 'selected' : '' ?>>Completed</option>
                                                    <option value="cancelled" <?= $order->status == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="admin-footer">
            &copy; <?= date('Y') ?> Admin Panel
        </div>
    </div>

    <?php include(APPPATH . 'Views/partials/logout_modal.php'); ?>
</body>
</html>
