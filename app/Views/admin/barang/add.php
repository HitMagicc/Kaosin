<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>
<div class="add-barang-body">
<div class="add-barang-container">
    <div class="add-barang-title">
        Add Barang
    </div>
    <div class="add-barang-content">
        <form action="<?= base_url('admin/barang/store') ?>" method="post" enctype="multipart/form-data">
            <div class="barang-detail">
                <div class="input-box">
                    <label class="details" for="name">Nama Barang</label>
                    <input type="text" id="name" name="name" placeholder="Masukan Nama Barang" required>
                </div>
                <!-- Input for Username -->
                <div class="input-box">
                    <label for="price" class="details">Harga</label>
                    <input type="number" id="price" name="price" placeholder="Masukan Harga Barang" required>
                </div>
                <!-- Input for Email -->
                <div class="input-box">
                    <label for="desc" class="details">Description</label>
                    <input id="desc" name="desc" rows="4" placeholder="Masukan deskripsi barang" required>
                </div>
                <!-- Input for Phone Number -->
                <div for="kategori_id" class="input-box">
                    <label class="details">Kategori</label>
                    <select id="kategori_id" name="kategori_id" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($kategori as $kategori): ?>
                            <option value=<?= $kategori['id'] ?>><?= $kategori['Name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Input for Password -->
                <div for="stock" class="input-box">
                    <label class="details">Stock</label>
                    <input type="number" id="stock" name="stock" type="text" placeholder="Masukan Stock Barang" required>
                </div>
                <!-- Input for Confirm Password -->
                <div class="input-box">
                    <label class="details">Photo</label>
                    <input type="file" id="files" name="files">
                </div>
            </div>
            <div class="add-barang-button">
                <button type="submit">Add Barang</button>
            </div>
        </form>
    </div>
</div>
</div>


<?= $this->endSection() ?>