<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<main class="payment-container">
    <!-- Left Side: Payment Form -->
    <div class="payment-methods">
        <h3>Select Payment Method</h3>
        <select id="payment-method" name="payment-method">
            <option value="visa">Visa/Mastercard</option>
            <option value="supermarket">Supermarket Payment</option>
        </select>

        <!-- Visa Payment Form -->
        <div id="visa-payment-form" class="payment-form" style="display: none;">
            <h4>Enter Visa/Mastercard Details</h4>
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" placeholder="1234 5678 9101 1121">
            <label for="expiry-date">Expiry Date:</label>
            <input type="text" id="expiry-date" placeholder="MM/YY">
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" placeholder="123">
        </div>

        <!-- Supermarket Payment Form -->
        <div id="supermarket-payment-form" class="payment-form" style="display: none;">
            <h4>Enter Supermarket Payment Details</h4>
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Your Email">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" placeholder="Your Phone Number">
        </div>
    </div>

    <!-- Right Side: Order Summary -->
    <div class="order-summary">
        <div class="order-summary-item">
            <div class="order-summary-image">
                <a href="<?= base_url('product/product-id') ?>" class="product-image-link">
                    <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                </a>
            </div>
            <div class="order-summary-text">
                <h4>Product Title</h4>
                <p>Total Price: $19.99</p>
            </div>
        </div>
        <div class="order-summary-item">
            <div class="order-summary-image">
                <a href="<?= base_url('product/product-id') ?>" class="product-image-link">
                    <img src="<?= base_url('uploads/photo1.png') ?>" alt="Product Image">
                </a>
            </div>
            <div class="order-summary-text">
                <h4>Product Title</h4>
                <p>Total Price: $19.99</p>
            </div>
        </div>

        <!-- Total Payment -->
        <div class="order-total">
            <h4>Total Payment: $49.98</h4>
        </div>

        <button class="payment-btn">Proceed to Checkout</button>
    </div>
</main>

<script>
    // Show the appropriate payment form based on selection
    document.getElementById('payment-method').addEventListener('change', function() {
        if (this.value === 'visa') {
            document.getElementById('visa-payment-form').style.display = 'block';
            document.getElementById('supermarket-payment-form').style.display = 'none';
        } else if (this.value === 'supermarket') {
            document.getElementById('supermarket-payment-form').style.display = 'block';
            document.getElementById('visa-payment-form').style.display = 'none';
        }
    });
</script>

<?= $this->endSection() ?>
