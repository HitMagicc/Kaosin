<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>

<main class="user-main-content">
    <h2>Payment Management</h2>
    <?php
    ?>
    <?php if (!empty($datapembayaran)): ?>
        <table class="orders-table" id="orders-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Pemesanan ID</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                    <th>Payment Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datapembayaran as $index => $order): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($order['id']); ?></td>
                        <td><?= esc($order['pemesanan_id']); ?></td>
                        <td><?= esc($order['method']); ?></td>
                        <td><?= esc($order['status']); ?></td>
                        <td>Rp<?= number_format(esc($order['jumlah']), 0, ',', '.'); ?></td>
                        <td><?= esc($order['payment_date']); ?></td>
                        <td style="text-align:center">
                            <a href="/admin/payment/detail/<?= esc($order['id']); ?>" class="btn-view">Detail</a> |
                            <a href="/admin/payment/delete/<?= esc($order['id']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <table class="orders-table" id="orders-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Pemesanan ID</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                    <th>Payment Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
        </table>
    <?php endif; ?>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100],
            "ordering": true,
            "searching": true,
            "info": true,
            "language": {
                "search": "Search: ",
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
