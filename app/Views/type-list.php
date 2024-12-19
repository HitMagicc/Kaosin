<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<main class="catalog-container">
    <!-- Sidebar (Categories) -->
    <div class="catalog-sidebar">
        <h3>Categories</h3>
        <!-- Category Group 1 -->
        <div class="category-group">
            <h4>Men</h4>
            <ul>
                <li><a href="<?= base_url('category/men') ?>">All Men</a></li>
                <li><a href="<?= base_url('category/men/shirts') ?>">Shirts</a></li>
                <li><a href="<?= base_url('category/men/pants') ?>">Pants</a></li>
            </ul>
        </div>

        <!-- Category Group 2 -->
        <div class="category-group">
            <h4>Women</h4>
            <ul>
                <li><a href="<?= base_url('category/women') ?>">All Women</a></li>
                <li><a href="<?= base_url('category/women/shirts') ?>">Shirts</a></li>
                <li><a href="<?= base_url('category/women/pants') ?>">Pants</a></li>
            </ul>
        </div>

        <!-- Category Group 3 -->
        <div class="category-group">
            <h4>Unisex</h4>
            <ul>
                <li><a href="<?= base_url('category/unisex') ?>">All Unisex</a></li>
                <li><a href="<?= base_url('category/unisex/shirts') ?>">Shirts</a></li>
                <li><a href="<?= base_url('category/unisex/pants') ?>">Pants</a></li>
            </ul>
        </div>

        <!-- More categories as needed -->
    </div>

    <!-- Main Catalog Area -->
    <div class="catalog-main">
        <h2>All Products</h2>
        <div class="product-list">
            <!-- Individual product cards go here -->
            <a href="<?= base_url('product') ?>" class="collection-card-link">
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
            <a href="<?= base_url('product') ?>" class="collection-card-link">
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
            <a href="<?= base_url('product') ?>" class="collection-card-link">
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
            <a href="<?= base_url('product') ?>" class="collection-card-link">
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
            <a href="<?= base_url('product') ?>" class="collection-card-link">
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
            <a href="<?= base_url('product') ?>" class="collection-card-link">
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
            <!-- Repeat product cards as needed -->
        </div>
    </div>
</main>



<?= $this->endSection() ?>