<header class="header">
    <a href="/" class="">
        <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo" class="header-logo">
    </a>
    <nav class="header-nav">
        <ul class="nav-list dropdown">
            <a href="<?=base_url('barang/index' )?>" class="nav-link">Kategori</a>
            <ul class="dropdown-menu">
                <ul><a href="<?=base_url('barang/index?sex=1' )?>" class="dropdown-item">Men</a></ul>
                <ul><a href="<?=base_url('barang/index?sex=2' )?>" class="dropdown-item">Women</a></ul>
                <ul><a href="<?=base_url('barang/index?sex=3    ' )?>" class="dropdown-item">Accessories</a></ul>
                <!-- Add more items here if needed -->
            </ul>
        </ul>

        <?php if (!session()->get('is_logged_in ')): ?>
            <ul class="nav-list"><a href="<?= base_url('login') ?>" class="nav-link">Login</a></ul>
            <ul class="nav-list"><a href="<?= base_url('register') ?>" class="nav-link">Register</a></ul>
        <?php else: ?>
            <ul class="nav-list"><a href="/cart" class="nav-link cart-link">🛒</a></ul>
            <ul class="nav-list dropdown">
                <a href="<?= base_url('profile') ?>" class="nav-link"><?php echo session()->get('username') ?></a> <!-- Display logged-in user's name -->
                <ul class="dropdown-menu">
                    <ul><a href="<?= base_url('profile') ?>" class="dropdown-item">Profile</a></ul>
                    <ul><a href="/profile?tab=pembelian" class="dropdown-item">Orders</a></ul>
                    <ul><a href="/profile?tab=pemesanan" class="dropdown-item">Histori</a></ul>
                    <ul><a href="/logout" class="dropdown-item">Logout</a></ul>
                </ul>
            </ul>
        <?php endif; ?>
    </nav>
    <!-- <iframe 
        id="promo-video" 
        width="560" 
        height="315" 
        src="https://www.youtube.com/embed/kw9Z9ZSEHQQ?autoplay=1&loop=1&playlist=kw9Z9ZSEHQQ" 
        title="YouTube video player" 
        frameborder="0" 
        allow="accelerometer; autoplay=1;loop; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        style="visibility: hidden; position: absolute; width: 0; height: 0;" 
        allowfullscreen>
    </iframe> -->
</header>