<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>

<main class="user-main-content">
    <h2>Order Management</h2>
    <?php
        
    ?>
    <?php if (!empty($pemesanan)): ?>
        <table class="orders-table" id="orders-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Buyer Name</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pemesanan as $index => $order): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($order['buyer_name']); ?></td>
                        <td><?= esc($order['status']); ?></td>
                        <td><?= esc($order['total_quantity']); ?></td>
                        <td>Rp<?= number_format(esc($order['total_price']), 0, ',', '.'); ?></td>
                        <td style="text-align:center">
                            <a href="/admin/orders/detail/<?= esc($order['id']); ?>" class="btn-view">Detail</a> |
                            <a href="/admin/orders/detail/delete/<?= esc($order['id']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
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
                    <th>Buyer Name</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
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
