<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<?php
$sexNames = [
    1 => 'Men',
    2 => 'Women',
    3 => 'Accessories',
];
?>
<main class="catalog-container">
    <!-- Sidebar (Categories) -->
    <div class="catalog-sidebar">
        <h3><a href="<?=esc(base_url('barang/index'))?>" style="text-decoration: none;
    color: #000;">Category</a></h3>
        <!-- Category Group 1 -->
        <?php foreach ($groupedCategories as $sex => $categories): ?>
            <div class="category-group">
                <h4><a class="catalog-category-title" href="<?= base_url('barang/index?sex=' . $sex) ?>">
                    <?= esc($sexNames[$sex] ?? 'Unknown') ?>
                    </a>
                </h4>
                <ul>
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="<?= base_url('barang/index/' . $category['id']) ?>">
                                <?=  esc($category['Name']) ?>
                            </a>        
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Main Catalog Area -->
    <div class="catalog-main">
        <h2>
            <?php if ($selectedKategori): ?>
                All <?= esc($selectedKategori) ?> Products
            <?php elseif ($selectedSex): ?>
                All <?= esc($selectedSex) ?> Products
            <?php else: ?>
                All Products
            <?php endif; ?>
        </h2>
        <div class="product-list">
            <!-- Individual product cards go here -->
            <?php foreach ($products as $item): ?>
            
                <input type="hidden" id="isLoggedIn" value="<?= session()->get('is_logged_in') ? '1' : '0' ?>">
                <div class="collection-card-link" onclick="window.location='<?= base_url('barang/detail/' . esc($item['id'])) ?>'">
                    <div class="collection-card">
                        <div class="collection-card-image">
                            <div class="image-frame">
                                <img src="<?= base_url(esc($item['image_path'])) ?>" alt="Product Image">
                            </div>
                        </div>
                        <div class="collection-card-text">
                            <h3><?= esc($item['name']) ?></h3>
                            <p>Rp <?= number_format($item['price']) ?></p>
                            <button class="add-to-cart-btn"
                                onclick="event.stopPropagation(); addToCart({
                                    id: '<?= esc($item['id']) ?>',
                                    name: '<?= esc($item['name']) ?>',
                                    price: '<?= esc($item['price']) ?>',
                                    user_id: '<?= esc(session()->get('user_id')) ?>'
                                })">
                                Add to Cart
                            </button>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Repeat product cards as needed -->
        </div>
    </div>
</main>
<script>
    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000)); // Set expiry date
        const expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function addToCart(productId, productName, productPrice, userId) {
        let cart = JSON.parse(getCookie('cart') || '[]');

        let product = {
            id: productId,
            id_user: userId,
            name: productName,
            price: productPrice,
            quantity: 1
        };

        // console.log("id barang= ", productId.id);
        // console.log("id ambil= ", cart.find(item => item.id.id === productId.id));

        let existingProduct = cart.find(item => item.id.id === productId.id);
        const isLoggedIn = document.getElementById('isLoggedIn').value === '1';

        if (isLoggedIn) {
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push(product);
            }

            setCookie('cart', JSON.stringify(cart), 7);
            alert('Product added to cart!');
        } else {
            alert('Login Dulu!');
            window.location.href='/login';
        }

    }
</script>



<?= $this->endSection() ?>