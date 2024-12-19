<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>

<main class="dashboard-main-content">
    <h2>Barang Masuk Hari Ini</h2>
    <?php if (!empty($barangMasuk)): ?>
        <table class="barang-masuk-table" id="barang-masuk-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Tanggal Masuk</th>
                    <th>Tampilan</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($barangMasuk as $index => $barang): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($barang['name']); ?></td>
                        <td><?= esc($barang['kategori_name']); ?></td>
                        <td><?= esc($barang['stock']); ?></td>
                        <td>Rp<?= number_format(esc($barang['price']), 0, ',', '.'); ?></td>
                        <td><?= esc($barang['created_at']); ?></td>
                        <td><img src="<?= base_url(esc($barang['image_path'])) ?>" alt=""></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada barang yang masuk hari ini.</p>
    <?php endif; ?>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#barang-masuk-table').DataTable({
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
