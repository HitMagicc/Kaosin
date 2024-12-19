<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<?php
$sexNames = [
    1 => 'Men',
    2 => 'Women',
    3 => 'Accessories',
];
?>

<main class="product-container">
    <div class="product-breadcrumb">
        <a href="<?= base_url('barang/index?sex=' . $barang['kategori_sex']) ?>">
            <?= esc($sexNames[$barang['kategori_sex']] ?? 'Unknown') ?>
        </a> >
        <a href="<?= base_url('barang/index/' . $barang['k_id']) ?>"><?= esc($barang['kategori_name']) ?></a> >
        <span><?= esc($barang['name']) ?></span>
    </div>

    <div class="product-main-page">
        <!-- Left Section: Photo Carousel -->
        <div class="product-picture-carousel">
            <div class="product-image main">
                <img id="mainPhoto" src="<?= base_url(esc($barang['image_path'])) ?>" alt="Main Product">
            </div>
            <div class="product-image-four">
                <img onclick="changePhoto(this)" src="<?= base_url(esc($barang['image_path'])) ?>" alt="Thumbnail 1">
                <!-- <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo2.png') ?>" alt="Thumbnail 2">
                <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo3.png') ?>" alt="Thumbnail 3">
                <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo3.png') ?>" alt="Thumbnail 4"> -->
            </div>
        </div>
        <!-- Right Section: Product Details -->
        <div class="product-buy-detail">
        <input type="hidden" id="isLoggedIn" value="<?= session()->get('is_logged_in') ? '1' : '0' ?>">
            
            <h1><?= esc($barang['name']) ?></h1>
            <p class="product-description">
                <?= esc($barang['desc']) ?>
            </p>
            <p><strong>Price: </strong>Rp<?= number_format($barang['price']) ?></p>
            <p><strong>Sex:</strong> <?= esc($sexNames[$barang['kategori_sex']] ?? 'Unknown') ?></p>
            <p><strong>Type:</strong> <?= esc($barang['kategori_name']) ?></p>
            <p><strong>Stock Left:</strong> <span id="stockLeft"><?= esc($barang['stock']) ?></span> items</p>

            <!-- Quantity Selector -->
            <div class="quantity">
                <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= esc($barang['stock']) ?>" onchange="validateStock()">
                <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
            </div>

            <!-- Add to Cart Button -->
            <button class="add-to-cart-btn"
                onclick="addToCart({
                                id: '<?= esc($barang['id']) ?>',
                                name: '<?= esc($barang['name']) ?>',
                                price: '<?= esc($barang['price']) ?>',
                                image_path: '<?= esc($barang['image_path']) ?>',
                                user_id: '<?= esc(session()->get('user_id')) ?>'
                            })">
                Add to Cart
            </button>
        </div>

    </div>
    <!-- Recommended Products Section -->
</main>
<div class="collection-section">
    <div class="title">
        <h2>ALSO <?= esc($barang['kategori_name']) ?></h2>
    </div>
    <div class="group-collection">
        <?php foreach ($recommendedProducts as $item): ?>

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
                        onclick="addToCart({
                                id: '<?= esc($item['id']) ?>',
                                name: '<?= esc($item['name']) ?>',
                                price: '<?= esc($item['price']) ?>',
                                image_path: '<?= esc($item['image_path']) ?>',
                                user_id: '<?= esc(session()->get('user_id')) ?>'
                            })">
                        Add to Cart
                    </button>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
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

    function addToCart(productId, productName, productPrice, user_id, image_path) {
        let cart = JSON.parse(getCookie('cart') || '[]');
        console.log("aokwoawkoawkawok");
        let product = {
            id: productId,
            id_user: user_id,
            name: productName,
            price: productPrice,
            image_path: image_path,
            quantity: 1
        };

        console.log("id barang= ", productId);
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
            window.location.href = '/login';
        }
    }
</script>
<?= $this->endSection() ?>