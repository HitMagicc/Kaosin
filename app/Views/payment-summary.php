<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<main class="cart-container">

    <div class="payment-summary">
        <h2>Payment Summary</h2>
        <div class="order-details">
            <p><strong>Order ID:</strong> <?= esc($hargatotal['id'] ?? 'N/A') ?></p>
            <?php if (!empty($pemesanan)): ?>
                <ul>
                    <?php foreach ($pemesanan as $item): ?>
                        <li>
                            <?= esc($item['name']) ?>
                            (Qty: <?= esc($item['quantity']) ?>)
                            - Rp <?= number_format((int)($item['price'] * $item['quantity']), 0, ',', '.') ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No items in the cart.</p>
            <?php endif; ?>
            <p><strong>Total Amount:</strong> Rp <?= number_format($hargatotal['total_price'] ?? 0, 0, ',', '.') ?></p>
        </div>
        <div class="payment-method">
            <p><strong>Payment Method:</strong> <?= esc($paymentMethod ?? 'Not selected') ?></p>
            <p><strong>Billing Address:</strong> <?= esc($billingAddress ?? 'No address provided') ?></p>
        </div>
    </div>
</main>
<?= $this->endSection() ?>