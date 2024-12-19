<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<main class="product-container">
    <div class="product-breadcrumb">
        <a href="<?= base_url('men') ?>">Men</a> > 
        <a href="<?= base_url('men/shirts') ?>">Shirts</a> > 
        <span>Men Shirt - Product Name</span>
    </div>

    <div class="product-main-page">
        <!-- Left Section: Photo Carousel -->
        <div class="product-picture-carousel">
            <div class="product-image main">
                <img id="mainPhoto" src="<?= base_url('uploads/photo4.png') ?>" alt="Main Product">
            </div>
            <div class="product-image-four">
                <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo4.png') ?>" alt="Thumbnail 1">
                <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo2.png') ?>" alt="Thumbnail 2">
                <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo3.png') ?>" alt="Thumbnail 3">
                <img onclick="changePhoto(this)" src="<?= base_url('uploads/photo3.png') ?>" alt="Thumbnail 4">
            </div>
        </div>
        <!-- Right Section: Product Details -->
        <div class="product-buy-detail">
            <h1>Product Name</h1>
            <p class="product-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel eros a ligula facilisis varius.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel eros a ligula facilisis varius.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel eros a ligula facilisis varius.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel eros a ligula facilisis varius.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel eros a ligula facilisis varius.
            </p>
            <p><strong>Price:</strong> Rp150.000,00</p>
            <p><strong>Sex:</strong> Unisex</p>
            <p><strong>Stock Left:</strong> <span id="stockLeft">20</span> items</p>

            <!-- Quantity Selector -->
            <div class="quantity">
                <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1" onchange="validateStock()">
                <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
            </div>

            <!-- Add to Cart Button -->
            <button type="button" class="add-to-cart-btn-barang" id="addToCartBtn" disabled>Add to Cart</button>
        </div>

    </div>
    <!-- Recommended Products Section -->
</main>
<div class="collection-section">
    <div class="title">
        <h2>ALSO MEN SHIRT</h2>
    </div>
    <div class="group-collection">
        <a href="<?= base_url('product')?>" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
            <div class="collection-card">
                <div class="collection-card-image">
                    <div class="image-frame">
                        <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                    </div>
                </div>
                <div class="collection-card-text">
                    <h3>Product Title</h3>
                    <p>$19.99</p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
        </a>
        <a href="product-page.html" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
            <div class="collection-card">
                <div class="collection-card-image">
                    <div class="image-frame">
                        <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                    </div>
                </div>
                <div class="collection-card-text">
                    <h3>Product Title</h3>
                    <p>$19.99</p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
        </a>
        <a href="product-page.html" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
            <div class="collection-card">
                <div class="collection-card-image">
                    <div class="image-frame">
                        <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                    </div>
                </div>
                <div class="collection-card-text">
                    <h3>Product Title</h3>
                    <p>$19.99</p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
        </a>
        <a href="product-page.html" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
            <div class="collection-card">
                <div class="collection-card-image">
                    <div class="image-frame">
                        <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                    </div>
                </div>
                <div class="collection-card-text">
                    <h3>Product Title</h3>
                    <p>$19.99</p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
        </a>
        <a href="product-page.html" class="collection-card-link"> <!-- Wrap the entire card inside an anchor tag -->
            <div class="collection-card">
                <div class="collection-card-image">
                    <div class="image-frame">
                        <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                    </div>
                </div>
                <div class="collection-card-text">
                    <h3>Product Title</h3>
                    <p>$19.99</p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>