<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<main class="cart-container">
    <h2>Your Cart</h2>

    <?php if (!empty($cart) && reset($cart)['id']['user_id'] === session()->get('user_id')): ?>
        <?php foreach ($cart as $item): ?>
            <div class="cart-item" data-product-id="<?= $item['id']['id'] ?>">
                <div class="cart-item-image">
                    <a href="" class="product-image-link">
                        <img src="<?= base_url(esc($item['id']['image_path'])) ?>" alt="Product Image">
                    </a>
                </div>
                <div class="cart-item-name">
                    <h3><?= esc($item['id']['name']) ?></h3>
                </div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn decrease">-</button>
                    <input type="text" class="quantity-input" value="<?= esc($item['quantity']) ?>" min="1">
                    <button class="quantity-btn increase">+</button>
                </div>
                <div class="cart-item-price">
                    <p>Rp <?= number_format($item['id']['price']) ?></p>
                </div>
                <div class="cart-item-total">
                    <p>Rp <?= number_format($item['id']['price'] * $item['quantity']) ?></p>
                </div>
                <div class="cart-item-remove">
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

    <div class="cart-summary">
        <p><strong>Total Items: </strong><span class="total-items"><?= array_sum(array_column($cart, 'quantity')) ?></span></p>
        <p><strong>Total Price: </strong>
            <span class="total-price">Rp <?= number_format(array_sum(array_map(function ($item) {
                                                return $item['id']['price'] * $item['quantity'];
                                            }, $cart))) ?></span>
        </p>
        <button class="checkout-btn">Proceed to Checkout</button>
    </div>
</main>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-b-Yef8fUz-ErQiF4"></script>

<script>
    document.querySelector('.checkout-btn').addEventListener('click', function() {
        const cartCookie = document.cookie
            .split('; ')
            .find(row => row.startsWith('cart='));
        const cart = cartCookie ? JSON.parse(decodeURIComponent(cartCookie.split('=')[1])) : {};

        if (Object.keys(cart).length === 0) {
            alert('Your cart is empty!');
            return;
        }



        const orderId = cart.order_id;
        fetch('/pembayaran', {
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
                console.log('API Response:', data); 
                if (data.snapToken) {
                    snap.pay(data.snapToken);
                    document.cookie = "cart=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                } else {
                    console.error(data.message || 'Snap token missing.');
                    alert(data.message + ' Failed to retrieve Snap token.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error); 
            });
    });



    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                const productId = cartItem.dataset.productId;
                const cart = JSON.parse(getCookie('cart') || '[]');

                const itemIndex = cart.findIndex(item => item.id.id === productId);


                if (itemIndex !== -1) {
                    cart.splice(itemIndex, 1);
                    setCookie('cart', JSON.stringify(cart), 7);
                } else {
                    console.warn(`Item with productId ${productId} not found in cart.`);
                }
                cartItem.remove();
                updateCartSummary();

                console.log('Updated cart:', cart);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                const productId = cartItem.dataset.productId;
                const quantityInput = cartItem.querySelector('.quantity-input');
                const cart = JSON.parse(getCookie('cart') || '{}');

                let quantity = parseInt(quantityInput.value);
                if (isNaN(quantity) || quantity < 1) quantity = 1;
                const action = this.classList.contains('increase') ? 'increase' : 'decrease';

                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }

                quantityInput.value = quantity;
                const itemIndex = cart.findIndex(item => item.id.id === productId);
                if (itemIndex !== -1) {
                    cart[itemIndex].quantity = quantity;
                    setCookie('cart', JSON.stringify(cart), 7);
                }

                const itemPrice = parseInt(cartItem.querySelector('.cart-item-price p').innerText.replace(/[^\d]/g, ''));
                cartItem.querySelector('.cart-item-total p').innerText = `Rp ${new Intl.NumberFormat('id-ID').format(itemPrice * quantity)}`;

                updateCartSummary();
            });
        });
    });

    function updateCartSummary() {
        let totalItems = 0;
        let totalPrice = 0;

        document.querySelectorAll('.cart-item').forEach(item => {
            const quantity = parseInt(item.querySelector('.quantity-input').value, 10);
            const price = parseInt(item.querySelector('.cart-item-price p').innerText.replace(/[^\d]/g, ''), 10);

            totalItems += quantity;
            totalPrice += price * quantity;
        });

        document.querySelector('.total-items').innerText = totalItems;
        document.querySelector('.total-price').innerText = `Rp ${new Intl.NumberFormat('id-ID').format(totalPrice)}`;
    }

    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
    }

    function getCookie(name) {
        const nameEQ = `${name}=`;
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let c = cookies[i].trim();
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
</script>

<?= $this->endSection() ?>