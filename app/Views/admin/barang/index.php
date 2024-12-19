<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>
<main class="catalog-container">
    <!-- Sidebar (Categories) -->
    <div class="catalog-sidebar">
        <h3>Categories</h3>
        
        <?php foreach ($groupedCategories as $sex => $categories): ?>
            <div class="category-group">
                <h4>
                    <a href="#" class="catalog-category-title"  data-search="<?= esc($sexNames[$sex] ?? 'Unknown') ?>">
                        <?= esc($sexNames[$sex] ?? 'Unknown') ?>
                    </a>
                </h4>
                <ul>
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="#" class="catalog-category-subtitle" data-search="<?= esc($category['Name']) ?>">
                                <?=  esc($category['Name']) ?>
                            </a>        
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

        <!-- More categories as needed -->
    </div>

    <!-- Main Catalog Area -->
    <div class="catalog-main">
        <div class="catalog-header">
            <h2>All Products</h2>
            <a href="<?= base_url('admin/barang/add') ?>" class="add-product-btn">+ Add Product</a>
        </div>
        <?php if (!empty($barangs)): ?>
            <table id="user-table" class="user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Price</th>
                        <th>Desc</th>
                        <th>Stock</th>
                        <th>Jenis</th>
                        <th>Sex</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($barangs as $index => $barang): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= esc($barang['name']); ?></td>
                            <td><?= esc($barang['price']); ?></td>
                            <td><?= esc($barang['desc']); ?></td>
                            <td><?= esc($barang['stock']); ?></td>
                            <td><?= esc($barang['kategori_name']); ?></td> <!-- Display kategori name -->
                            <td><?= $barang['kategori_sex'] == 1 ? 'Men' : ($barang['kategori_sex'] == 2 ? 'Women' : 'Unisex'); ?></td> <!-- Display kategori sex -->
                            <td >
                                <a href="/admin/barang/edit/<?= esc($barang['id']); ?>" class="btn-edit">Edit</a> |
                                <a href="/admin/barang/delete/<?= esc($barang['id']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <table id="user-table" class="user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Price</th>
                        <th>Desc</th>
                        <th>Stock</th>
                        <th>Sex
                        <th>Jenis</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Listen for clicks on the category links
        document.querySelectorAll('.catalog-category-title').forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault(); // Prevent default link behavior
                
                // Get the search value from the data attribute
                const searchValue = event.target.dataset.search;

                // Find the search input (adjust the selector as needed)
                const searchInput = document.querySelector('.dataTables_filter input');

                if (searchInput) {
                    // Append the search value to the input
                    searchInput.value = searchValue;

                    // Trigger the search programmatically
                    const searchEvent = new Event('input', { bubbles: true });
                    searchInput.dispatchEvent(searchEvent);
                }
            });
        });
        document.querySelectorAll('.catalog-category-subtitle').forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault(); // Prevent default link behavior
                
                // Get the search value from the data attribute
                const searchValue = event.target.dataset.search;

                // Find the search input (adjust the selector as needed)
                const searchInput = document.querySelector('.dataTables_filter input');

                if (searchInput) {
                    // Append the search value to the input
                    searchInput.value = searchValue;

                    // Trigger the search programmatically
                    const searchEvent = new Event('input', { bubbles: true });
                    searchInput.dispatchEvent(searchEvent);
                }
            });
        });
    });
</script>


<?= $this->endSection() ?>