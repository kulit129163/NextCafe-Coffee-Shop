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
                <td>
                    <div class="d-flex flex-column gap-1 align-items-start">
                        <span class="status-badge <?= $u['role'] === 'admin' ? 'role-admin' : 'role-customer' ?>">
                            <?= ucfirst($u['role']) ?>
                        </span>
                        <?php if (($u['status'] ?? 'active') === 'active'): ?>
                            <span class="status-badge status-delivered" style="font-size: 0.65rem; padding: 0.2rem 0.5rem;"><i class="bi bi-person-check-fill me-1"></i>Active</span>
                        <?php else: ?>
                            <span class="status-badge status-cancelled" style="font-size: 0.65rem; padding: 0.2rem 0.5rem;"><i class="bi bi-person-slash me-1"></i>Inactive</span>
                        <?php endif; ?>
                    </div>
                </td>
                <td style="color:var(--text-muted);font-size:0.8rem;"><?= date('n/j/Y', strtotime($u['created_at'])) ?></td>
                <td>
                    <div class="d-flex gap-2 align-items-center flex-wrap">

                        <?php if ($u['role'] !== 'admin'): ?>
                            <?php $isActive = ($u['status'] ?? 'active') === 'active'; ?>

                            <!-- Deactivate / Activate -->
                            <?php if ($isActive): ?>
                                <button type="button" 
                                   title="Deactivate Account"
                                   onclick="confirmDeactivate(<?= $u['id'] ?>, '<?= esc(addslashes($u['username'])) ?>')"
                                   style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #2563eb;color:#2563eb;background:rgba(37,99,235,.08);transition:all .2s;"
                                   onmouseover="this.style.background='#2563eb';this.style.color='#fff';"
                                   onmouseout="this.style.background='rgba(37,99,235,.08)';this.style.color='#2563eb';">
                                    <i class="bi bi-person-slash"></i> Deactivate
                                </button>
                            <?php else: ?>
                                <button type="button" 
                                   title="Activate Account"
                                   onclick="confirmActivate(<?= $u['id'] ?>, '<?= esc(addslashes($u['username'])) ?>')"
                                   style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #16a34a;color:#16a34a;background:rgba(22,163,74,.08);transition:all .2s;"
                                   onmouseover="this.style.background='#16a34a';this.style.color='#fff';"
                                   onmouseout="this.style.background='rgba(22,163,74,.08)';this.style.color='#16a34a';">
                                    <i class="bi bi-person-check"></i> Activate
                                </button>
                            <?php endif; ?>

                            <!-- Delete -->
                            <button type="button" 
                               title="Delete User"
                               onclick="confirmDelete(<?= $u['id'] ?>, '<?= esc(addslashes($u['username'])) ?>')"
                               style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .85rem;border-radius:50px;font-size:.75rem;font-weight:700;letter-spacing:.4px;cursor:pointer;border:1.5px solid #dc2626;color:#fff;background:#dc2626;transition:all .2s;box-shadow:0 2px 8px rgba(220,38,38,.3);"
                               onmouseover="this.style.background='#b91c1c';this.style.boxShadow='0 4px 14px rgba(185,28,28,.4)';"
                               onmouseout="this.style.background='#dc2626';this.style.boxShadow='0 2px 8px rgba(220,38,38,.3)';">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>

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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-danger text-white p-4">
                <h5 class="modal-title fw-700">Delete User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-exclamation-triangle display-1 text-danger opacity-25 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Are you sure?</h4>
                <p class="text-muted mb-0">You are about to permanently delete <strong><span id="deleteUserName"></span></strong>. This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="btn btn-danger rounded-pill px-4 fw-700">Delete Permanently</a>
            </div>
        </div>
    </div>
</div>

<!-- Deactivate Confirmation Modal -->
<div class="modal fade" id="deactivateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-4">
            <div class="modal-header border-0 bg-primary text-white p-4">
                <h5 class="modal-title fw-700">Deactivate User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-person-slash display-1 text-primary opacity-50 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Deactivate Account?</h4>
                <p class="text-muted mb-0">Are you sure you want to deactivate <strong><span id="deactivateUserName"></span></strong>? They will temporarily be unable to log in.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deactivateConfirmBtn" class="btn btn-primary rounded-pill px-4 fw-700">Yes, Deactivate</a>
            </div>
        </div>
    </div>
</div>

<!-- Activate Confirmation Modal -->
<div class="modal fade" id="activateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-4">
            <div class="modal-header border-0 bg-success text-white p-4">
                <h5 class="modal-title fw-700">Activate User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <i class="bi bi-person-check display-1 text-success opacity-50 mb-4 d-block"></i>
                <h4 class="fw-700 mb-2">Activate Account?</h4>
                <p class="text-muted mb-0">You are about to restore access for <strong><span id="activateUserName"></span></strong>.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-600 me-2" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="activateConfirmBtn" class="btn btn-success rounded-pill px-4 fw-700">Yes, Activate</a>
            </div>
        </div>
    </div>
</div>

<script>
function filterUsers() {
    const q = document.getElementById('userSearch').value.toLowerCase();
    document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}

function confirmDelete(id, username) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('deleteUserName').innerText = username;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url('admin/users/delete/') ?>' + id;
    modal.show();
}

function confirmDeactivate(id, username) {
    const modal = new bootstrap.Modal(document.getElementById('deactivateModal'));
    document.getElementById('deactivateUserName').innerText = username;
    document.getElementById('deactivateConfirmBtn').href = '<?= base_url('admin/users/toggleStatus/') ?>' + id;
    modal.show();
}

function confirmActivate(id, username) {
    const modal = new bootstrap.Modal(document.getElementById('activateModal'));
    document.getElementById('activateUserName').innerText = username;
    document.getElementById('activateConfirmBtn').href = '<?= base_url('admin/users/toggleStatus/') ?>' + id;
    modal.show();
}
</script>

<?= $this->endSection() ?>
