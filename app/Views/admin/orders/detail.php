<?= $this->extend('layout_admin/layout') ?>
<?= $this->section('content') ?>
<div class="add-barang-body">
<div class="add-barang-container">
    <h2>Order Details</h2>
    
    <!-- Order Summary Section -->
    <div class="order-summary">
        <div class="summary-item">
            <span class="label">Order ID:</span>
            <span class="value"><?= esc($pemesanan['id']); ?></span>
        </div>
        <div class="summary-item">
            <span class="label">Buyer Name:</span>
            <span class="value"><?= esc($pemesanan['buyer_name']); ?></span>
        </div>
        <div class="summary-item">
            <span class="label">Status:</span>
            <span class="value"><?= esc($pemesanan['status']); ?></span>
        </div>
        <div class="summary-item">
            <span class="label">Total Quantity:</span>
            <span class="value"><?= esc($pemesanan['total_quantity']); ?></span>
        </div>
        <div class="summary-item">
            <span class="label">Total Price:</span>
            <span class="value">Rp<?= number_format(esc($pemesanan['total_price']), 0, ',', '.'); ?></span>
        </div>
    </div>

    <!-- Order Items Section -->
    <div class="order-items">
        <h3>Order Items</h3>
        <div class="item-cards">
            <?php foreach ($pemesananDetails as $index => $detail): ?>
                <div class="item-card">
                    <div class="card-left">
                        <img src="<?= !empty($detail['barang_image']) ? base_url(esc($detail['barang_image'])) : '/path/to/default-image.jpg'; ?>" 
                            alt="<?= esc($detail['barang_name']); ?>" class="item-image">
                    </div>
                    <div class="card-right">
                        <h4><?= esc($detail['barang_name']); ?></h4>
                        <p>Quantity: <?= esc($detail['quantity']); ?></p>
                        <p>Price: Rp<?= number_format(esc($detail['price']), 0, ',', '.'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="order-button">
        <a href="/admin/orders" class="btn-back">Back to Orders</a>
        <a href="<?= base_url('admin/orders/detail/updateStatus/').$pemesanan['id'] ?>" class="btn-green">Tandai Diambil</a>
        
    </div>
</div>
</div>

<!-- Styling for the View -->
<style>
    .detail-body {
        margin: 20px;
        font-family: Arial, sans-serif;
    }
    h2, h3 {
        margin-bottom: 20px;
    }

    /* Order Summary Styling */
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
    .value {
        color: #555;
    }

    /* Order Items Styling */
    .order-items {
        margin-top: 20px;
    }
    .item-cards {
        display: grid;
        grid-template-columns: 1fr; /* 1 item per row */
        gap: 20px; /* Space between the cards */
        margin: 0 auto;
        max-width: 800px; /* Optional: to limit card width */
    }

    /* Card structure: Image on the left and content on the right */
    .item-card {
        display: flex; /* Use flex to align image and content */
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Left section for image */
    .card-left {
        flex: 0 0 150px; /* Fix the width of the image */
        overflow: hidden; /* Prevent overflow */
    }

    /* The image styling */
    .item-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Right section for information */
    .card-right {
        flex: 1; /* Take up remaining space */
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-right h4 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .card-right p {
        margin: 5px 0;
    }

    /* Optional: Add responsive design for smaller screens */
    
    .order-button{
        display: flex;
        flex-direction: row;
        padding:0px 15px;
        justify-content: space-between;
    }
    /* Back Button Styling */
    .btn-back {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }
    .btn-green {
        display: inline-block;
        padding: 10px 15px;
        background-color: green;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }
    .btn-back:hover {
        background-color: #0056b3;
    }
</style>

<?= $this->endSection() ?>
