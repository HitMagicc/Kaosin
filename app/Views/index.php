<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<div class="slideshow-container">
    <div class="slide">
        <img src="<?= base_url('uploads/photo1.png') ?>" alt="Image 1">
    </div>
    <div class="slide">
        <img src="<?= base_url('uploads/photo2.png') ?>" alt="Image 2">
    </div>
    <div class="slide">
        <img src="<?= base_url('uploads/photo3.png') ?>" alt="Image 3">
    </div>
    <a class="prevSlide" onclick="prevSlide()">&#10094;</a>
    <a class="nextSlide" onclick="nextSlide()">&#10095;</a>
</div>

<div class="collection-section">
    <div class="title">
        <h2>CHEAPEST COLLECTION</h2>
    </div>
    <div class="group-collection">

        <?php foreach ($barang as $item): ?>

            <input type="hidden" id="isLoggedIn" value="<?= session()->get('is_logged_in') ? '1' : '0' ?>">
            <div class="collection-card">
                <div class="collection-card-image">
                    <a href="<?= base_url('barang/detail/' . esc($item['id'])) ?>" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
                        <div class="image-frame">
                            <img src="<?= base_url(esc($item['image_path'])) ?>" alt="Product Image">
                        </div>
                    </a>
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
        <?php endforeach; ?>
    </div>

</div>
</div>
<div class="collection-section">
    <div class="title">
        <h2>LATEST ARRIVAL</h2>
    </div>
    <div class="group-collection">
        <?php foreach ($barangBaru as $b): ?>
            <input type="hidden" id="isLoggedIn" value="<?= session()->get('is_logged_in') ? '1' : '0' ?>">

            <div class="collection-card">
                <div class="collection-card-image">
                    <a href="<?= base_url('barang/detail/' . esc($b['id'])) ?>" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
                        <div class="image-frame">
                            <img src="<?= base_url(esc($b['image_path'])) ?>" alt="Product Image">
                        </div>
                    </a>
                </div>
                <div class="collection-card-text">
                    <h3><?= esc($b['name']) ?></h3>
                    <p>Rp <?= number_format($b['price']) ?></p>
                    <button class="add-to-cart-btn"
                        onclick="addToCart({
                                id: '<?= esc($b['id']) ?>',
                                name: '<?= esc($b['name']) ?>',
                                price: '<?= esc($b['price']) ?>',
                                image_path: '<?= esc($b['image_path']) ?>',
                                user_id: '<?= esc(session()->get('user_id')) ?>'
                            })">
                        Add to Cart
                    </button>

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

    function addToCart(productId, productName, productPrice, userId, image_path) {
        let cart = JSON.parse(getCookie('cart') || '[]');

        let product = {
            id: productId,
            id_user: userId,
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