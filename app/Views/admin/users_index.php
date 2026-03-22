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
                    <div class="d-flex gap-2 align-items-center flex-wrap">

                        <?php if ($u['role'] !== 'admin'): ?>
                            <?php $isActive = ($u['status'] ?? 'active') === 'active'; ?>

                            <!-- Deactivate / Activate -->
                            <a href="<?= base_url('admin/users/toggleStatus/' . $u['id']) ?>"
                               title="<?= $isActive ? 'Deactivate Account' : 'Activate Account' ?>"
                               onclick="return confirm('<?= $isActive ? 'Deactivate' : 'Activate' ?> this user\'s account?')"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;transition:all .2s;
                                      <?= $isActive ? 'border:1.5px solid #2563eb;color:#2563eb;background:rgba(37,99,235,.08);' : 'border:1.5px solid #16a34a;color:#16a34a;background:rgba(22,163,74,.08);' ?>"
                               onmouseover="this.style.background='<?= $isActive ? '#2563eb' : '#16a34a' ?>';this.style.color='#fff';"
                               onmouseout="this.style.background='<?= $isActive ? 'rgba(37,99,235,.08)' : 'rgba(22,163,74,.08)' ?>';this.style.color='<?= $isActive ? '#2563eb' : '#16a34a' ?>';">
                                <?php if ($isActive): ?>
                                    <i class="bi bi-person-slash"></i> Deactivate
                                <?php else: ?>
                                    <i class="bi bi-person-check"></i> Activate
                                <?php endif; ?>
                            </a>

                            <!-- Delete -->
                            <a href="<?= base_url('admin/users/delete/' . $u['id']) ?>"
                               title="Delete User"
                               onclick="return confirm('Are you sure you want to permanently delete <?= esc($u['username']) ?>?')"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;text-decoration:none;border:1.5px solid #dc2626;color:#fff;background:#dc2626;transition:all .2s;box-shadow:0 2px 8px rgba(220,38,38,.3);"
                               onmouseover="this.style.background='#b91c1c';this.style.boxShadow='0 4px 14px rgba(185,28,28,.4)';"
                               onmouseout="this.style.background='#dc2626';this.style.boxShadow='0 2px 8px rgba(220,38,38,.3)';">
                                <i class="bi bi-trash-fill"></i> Delete
                            </a>

                        <?php else: ?>
                            <span style="font-size:.75rem;color:var(--text-muted);font-style:italic;">
                                <?= $u['id'] == session()->get('id') ? '(You)' : 'Admin Protected' ?>
                            </span>
                        <?php endif; ?>

                    </div>
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
