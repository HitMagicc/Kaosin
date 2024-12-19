<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>

<div class="add-barang-body">
    <div class="add-barang-container">
        <h2>Payment Details</h2>
        <div class="order-summary">
            <div class="summary-item">
                <span class="label">Order ID:</span>
                <span class="value"><?= esc($datapembayaran['id']); ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Payment ID:</span>
                <span class="value"><?= esc($datapembayaran['pemesanan_id']); ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Buyer's Name:</span>
                <span class="value"><?= esc($datapembayaran['user_name']); ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Method:</span>
                <span class="value"><?= esc($datapembayaran['method']); ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Status</span>
                <span class="value"><?= esc($datapembayaran['status']); ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Quantity</span>
                <span class="value"><?= esc($datapembayaran['jumlah']); ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Tanggal Pembayaran:</span>
                <span class="value"><?= esc($datapembayaran['payment_date']); ?></span>
            </div>
            
        </div>
    </div>
</div>

<style>
    h2, h3 {
        margin-bottom: 20px;
    }
    .order-summary {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .label {
        font-weight: bold;
        color: #333;
    }
</style>

<?= $this->endSection() ?><i class="fas fa-speakap    "></i>