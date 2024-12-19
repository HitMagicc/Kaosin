<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>
<div class="add-barang-body">
<div class="add-barang-container">
    <div class="add-barang-title">
        Edit Barang <?=$barang['name']?>
    </div>
    <div class="add-barang-content">
        <form action="<?= base_url('admin/barang/update/' . $barang['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="barang-detail">
                <div class="input-box">
                    <label class="details" for="name">Nama Barang</label>
                    <input type="text" id="name" name="name" value="<?= $barang['name'] ?>" required>
                </div>
                <div class="input-box">
                    <label for="price" class="details">Harga</label>
                    <input type="number" id="price" name="price" value="<?= $barang['price'] ?>" required>
                </div>
                <div class="input-box">
                    <label for="desc" class="details">Description</label>
                    <input id="desc" name="desc" rows="4" value="<?= $barang['desc'] ?>" required>
                </div>
                <div for="kategori_id" class="input-box">
                    <label class="details">Kategori</label>
                    <select id="kategori_id" name="kategori_id" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value=<?= $kat['id'] ?> <?= $kat['id'] == $barang['kategori_id'] ? 'selected' : '' ?>>
                                <?= $kat['Name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div for="stock" class="input-box">
                    <label class="details">Stock</label>
                    <input type="number" id="stock" name="stock" value="<?= $barang['stock'] ?>" required>
                </div>
                <div class="input-box">
                    <label class="details">Photo</label>
                    <input type="file" id="files" name="files">
                    <?php if ($barang['image_path']): ?>
                        <img src="<?= base_url($barang['image_path']) ?>" alt="Current Image" width="100">
                    <?php endif; ?>
                </div>
            </div>
            <div class="add-barang-button">
                <button type="submit">Update Barang</button>
            </div>
        </form>
    </div>
</div>
</div>
<?= $this->endSection() ?>
