<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('title') ?>
User Management
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<main class="user-main-content">
    <h2>User Management</h2>
        <div class="user-container">
        <?php if (!empty($users)): ?>
            <table id="user-table" class="user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Orders Made</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= esc($user['full_name']); ?></td>
                            <td><?= esc($user['username']); ?></td>
                            <td><?= esc($user['email']); ?></td>
                            <td><?= esc($user['level']); ?></td>
                            <td><?= esc($user['total_pemesanan']); ?></td> <!-- Replace with dynamic orders count -->
                        
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
        </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user-table').DataTable({
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100],
            "ordering": true,
            "searching": true,
            "info": true,
            "language": {
                "search": "Search users:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries available",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>
