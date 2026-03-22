<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-end mb-4">
    <div class="admin-search">
        <i class="bi bi-search"></i>
        <input type="text" id="userSearch" placeholder="Search Name or Email..." oninput="filterUsers()">
    </div>
</div>

<div class="admin-card">
    <table class="admin-table" id="usersTable">
        <thead>
            <tr>
                <th>Users ID</th>
                <th>Profile</th>
                <th>Role</th>
                <th>Joined Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td style="color:var(--text-muted);font-weight:600;">#UID-<?= str_pad($u['id'], 5, '0', STR_PAD_LEFT) ?></td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:32px;height:32px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.8rem;flex-shrink:0;">
                            <?= strtoupper(substr($u['username'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:0.875rem;"><?= esc($u['username']) ?></div>
                            <div style="font-size:0.75rem;color:var(--text-muted);"><?= esc($u['email']) ?></div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="status-badge <?= $u['role'] === 'admin' ? 'role-admin' : 'role-customer' ?>">
                        <?= ucfirst($u['role']) ?>
                    </span>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;"><?= date('n/j/Y', strtotime($u['created_at'])) ?></td>
                <td>
                    <form action="<?= base_url('admin/users/updateRole/' . $u['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Change this user\'s role?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="role" value="<?= $u['role'] === 'admin' ? 'customer' : 'admin' ?>">
                        <button type="submit" class="action-btn <?= $u['role'] === 'admin' ? 'delete' : 'edit' ?>" title="<?= $u['role'] === 'admin' ? 'Demote to Customer' : 'Make Admin' ?>">
                            <i class="bi <?= $u['role'] === 'admin' ? 'bi-shield-x' : 'bi-shield-plus' ?>"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
            <tr><td colspan="5" class="text-center py-5" style="color:var(--text-muted);">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function filterUsers() {
    const q = document.getElementById('userSearch').value.toLowerCase();
    document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>

<?= $this->endSection() ?>
