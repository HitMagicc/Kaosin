<header class="header">
    <a href="/admin " class="">
        <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo" class="header-logo">
    </a>
    <nav class="header-nav">
        <ul class="nav-list"><a href="<?= base_url('admin/') ?>" class="nav-link">Dashboard</a></ul>

        <!-- Barang Dropdown -->
        <ul class="nav-list dropdown">
            <a href="<?= base_url('admin/barang') ?>" class="nav-link">Barang</a>
            
        </ul>

        <!-- Kategori Dropdown -->
        

        <!-- Orders -->
        <ul class="nav-list"><a href="<?= base_url('admin/orders') ?>" class="nav-link">Orders</a></ul>

        
        <!-- Payments -->
        <ul class="nav-list"><a href="<?= base_url('admin/payment') ?>" class="nav-link">Payments</a></ul>
        <!-- Users -->
        <ul class="nav-list"><a href="<?= base_url('admin/user/') ?>" class="nav-link">Users</a></ul>

        <!-- Admin Profile Dropdown -->
        <ul class="nav-list dropdown">
            <a href="<?= base_url('admin/profile') ?>" class="nav-link"><?= session()->get('username') ?></a> <!-- Display admin's username -->
            <ul class="dropdown-menu">
                <ul><a href="<?= base_url('logout') ?>" class="dropdown-item">Logout</a></ul>
            </ul>
        </ul>
    </nav>
</header>
