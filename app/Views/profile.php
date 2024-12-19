<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<main class="profile-page">
    <!-- Header -->
    <header class="profile-header">
        <div class="logo"><?php echo session()->get('username') ?></div>
    </header>

    <div class="profile-main">
        <section class="content-area">
            <!-- Tabs -->
            <div class="tabs">
                <input type="radio" id="profile-tab" name="tab" checked>
                <label for="profile-tab" class="tab">Profile</label>

                <input type="radio" id="pembelian-tab" name="tab">
                <label for="pembelian-tab" class="tab">Riwayat Pembelian</label>

                <input type="radio" id="pemesanan-tab" name="tab">
                <label for="pemesanan-tab" class="tab">Riwayat Pemesanan</label>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Profile Content -->
                <div class="tab-content" id="profile-content">
                    <div class="grid-container">
                        <div class="grid-item">
                            <h5>ALAMAT EMAIL</h5>
                            <p><?= esc($profile['email']) ?></p>
                        </div>
                        <div class="grid-item">
                            <h5>NOMOR TELEPON</h5>
                            <p>+62 812-3456-7890</p>
                        </div>
                        <div class="grid-item">
                            <h5>NAMA LENGKAP</h5>
                            <p><?= esc($profile['full_name']) ?></p>
                        </div>
                        <div class="grid-item">
                            <h5>ALAMAT PENGIRIMAN</h5>
                            <p>Jl. Example No. 123, Kota</p>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pembelian Content -->
                <div class="tab-content" id="pembelian-content">
                    <p>Riwayat Pembelian Anda</p>
                    <div class="pemesanan-container">
                        <?php foreach ($groupedData as $pemesananId => $order): ?>
                            <?php if ($order['status'] == 0): ?>
                                <div class="pemesanan-card">
                                    <h3>Pemesanan ID: <?= esc($pemesananId) ?></h3>
                                    <p>Jumlah: Rp <?= number_format(esc($order['jumlah'])) ?></p>

                                    <h4>Items:</h4>
                                    <ul>
                                        <?php foreach ($order['items'] as $item): ?>
                                            <li>
                                                <strong><?= esc($item['barang_name']) ?></strong> (Quantity: <?= esc($item['quantity']) ?>)
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button id="btn-checkout" data-order-id="<?= esc($pemesananId) ?>" data-amount="<?= esc($order['jumlah']) ?>">
                                        Bayar
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="tab-content" id="pemesanan-content">
                    <p>Riwayat Pemesanan Anda</p>
                    <div class="pemesanan-container">
                        <?php foreach ($groupedData as $pemesananId => $order): ?>
                            <?php if ($order['status'] == 1): ?>
                                <a href="<?= base_url('/payment-summary/' . $pemesananId) ?>">
                                    <div class="pembayaran-card">
                                        <h3>Pemesanan ID: <?= esc($pemesananId) ?></h3>
                                        <p>Jumlah: Rp <?= number_format(esc($order['jumlah'])) ?></p>

                                        <h4>Items:</h4>
                                        <ul>
                                            <?php foreach ($order['items'] as $item): ?>
                                                <li>
                                                    <strong><?= esc($item['barang_name']) ?></strong> (Quantity: <?= esc($item['quantity']) ?>)
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

</main>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-b-Yef8fUz-ErQiF4"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutButtons = document.querySelectorAll('#btn-checkout');

        checkoutButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                const amount = this.getAttribute('data-amount');

                fetch('/pembayaran-update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            order_id: orderId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snapToken) {
                            console.log('Snap Token:', data.snapToken);
                            snap.pay(data.snapToken); 
                        } else {
                            console.error('Error:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                    });
            });
        });

        const radioButtons = document.querySelectorAll('input[type="radio"]');
        const tabContents = document.querySelectorAll('.tab-content');

        function showTab(tabId) {
            tabContents.forEach(content => content.style.display = 'none');
            const selectedContent = document.getElementById(`${tabId}-content`);
            if (selectedContent) {
                selectedContent.style.display = 'block';
            }
        }

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'profile'; 

        const selectedRadio = document.getElementById(`${activeTab}-tab`);
        if (selectedRadio) {
            selectedRadio.checked = true;
            showTab(activeTab);
        }

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                showTab(this.id.replace('-tab', ''));
            });
        });
    });
</script>


<?= $this->endSection() ?>