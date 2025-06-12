<div class="container my-5">
    <div class="row <?php echo ($session->has('user_id')) ? 'justify-content-center' : ''; ?>">
        <!-- Sign up / Log in Section -->
        <?php if (!$session->has('user_id')) : ?>
        <div class="col-lg-6 mb-4">
            <p class="fw-bold">
                Get 15% Cashback on your first order when you sign up.
            </p>
            <p class="text-muted">
                Your eSIM will be sent to your email. We promise to only send you
                important emails about the service quality.
            </p>

            <h4 class="fw-bold mb-4">Sign up / Log in</h4>

            <form>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Full Name" />
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" />
                </div>

                <button class="btn btn-success w-100 mb-3 border-radius" type="submit">
                    <i class="bi bi-arrow-right"></i> Continue as Guest
                </button>

                <small class="text-muted d-block">
                    By clicking 'Continue as Guest' you agree to our
                    <a href="#" class="text-decoration-underline">Terms of Use</a> and
                    <a href="#" class="text-decoration-underline">Privacy Policy</a>
                    and will be redirected to Stripe for secure payment.
                </small>
            </form>
        </div>
        <?php endif; ?>

        <!-- Order Summary -->
        <div class="col-lg-6">
            <div class="card shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-cart-check me-2"></i>Order Summary
                </h5>

                <!-- Table Headings -->
                <div class="row fw-bold text-muted mb-2">
                    <div class="col-4" style="font-size: 15px">Product</div>
                    <div class="col-4 text-center" style="font-size: 15px">Country</div>
                    <div class="col-2 text-center" style="font-size: 15px">Quantity</div>
                    <div class="col-2 text-end" style="font-size: 15px">Price</div>
                </div>

                <?php 
        $grandTotal = 0;
        foreach ($cart as $item): 
            $totalPrice = $item['price'] * $item['quantity'];
            $grandTotal += $totalPrice;
        ?>
                <div class="row align-items-center mb-3">
                    <div class="col-5 d-flex align-items-center gap-2">
                        <span><?= esc($item['name']) ?></span>
                    </div>
                    <div class="col-3 d-flex align-items-center gap-2">
                        <p><?= esc($item['country']) ?></p>
                    </div>
                    <div class="col-2 text-center">
                        <div class="d-flex justify-content-center align-items-center gap-1">
                            <span><?= esc($item['quantity']) ?></span>
                        </div>
                    </div>
                    <div class="col-2 text-end fw-semibold">$<?= number_format($totalPrice, 2) ?></div>
                </div>
                <!-- ✅ ICCID Input(s) for this item -->
                <div class="mb-3">
                    <label class="form-label">
                        ICCID(s) for <?= esc($item['name']) ?>
                        <span class="text-muted">(<?= $item['quantity'] ?> Required)</span>:
                    </label>

                    <!-- Help text (optional) -->
                    <small class="d-block text-muted mb-2">
                        <i class="bi bi-info-circle"></i> Enter 19-20 digit ICCIDs (e.g.,
                        <code>8988300123456789012</code>)
                    </small>

                    <?php for ($i = 0; $i < $item['quantity']; $i++): ?>
                    <input type="text" class="form-control mb-2 iccid-input" placeholder="Enter ICCID #<?= $i + 1 ?>"
                        data-item="<?= esc($item['name']) ?>" pattern="[0-9]{19,20}"
                        title="19-20 digits, no spaces/dashes" required />
                    <?php endfor; ?>
                </div>
                <?php endforeach; ?>

                <hr />
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span>$<?= number_format($grandTotal, 2) ?></span>
                </div>

                <!-- Card Payment Section -->
                <div class="container my-5 col-md-12 p-0">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card shadow-sm p-4 border-0 rounded-4">
                                <h5 class="mb-4 fw-bold">
                                    <i class="bi bi-credit-card-fill me-2"></i>Card Payment
                                </h5>

                                <form id="payment-form">
                                    <div class="mb-3">
                                        <label for="cardName" class="form-label">Name on Card</label>
                                        <input type="text" class="form-control" id="cardName" placeholder="John Doe"
                                            required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="card-element" class="form-label">Card Details</label>
                                        <div id="card-element" class="form-control"
                                            style="padding: 10px; height: auto;">
                                            <!-- Stripe Card Input -->
                                        </div>
                                    </div>

                                    <div id="card-errors" role="alert" style="color:red; margin-top:10px;"></div>

                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-shield-lock-fill me-2"></i>Pay Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ✅ Export PHP data to JS -->
                <script>
                const cartItems = <?= json_encode($cart) ?>;
                const grandTotal = <?= floatval($grandTotal) ?>;
                </script>
            </div>
        </div>

    </div>

    <!-- Bottom Safe Payment Info -->
    <div class="text-center mt-4 text-muted small">
        <i class="bi bi-shield-lock-fill me-2"></i>Guaranteed safe & secure
        checkout with
        <img src="https://stripe.com/img/v3/newsroom/social.png" alt="Stripe" height="20" />
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const incrementBtn = document.getElementById("incrementBtn");
    const decrementBtn = document.getElementById("decrementBtn");
    const quantityInput = document.getElementById("quantityInput");

    incrementBtn.addEventListener("click", function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    decrementBtn.addEventListener("click", function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
});
</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe(
    'pk_test_51R4GDaKB3BlrOdKGq7JNKqLohP3qrLpVRbEtSB2kn9jGnWENHxS28hDwz9hseX1YgytexaC0yZJeVzuoaN3arzIG00J9mF7hnS');
const elements = stripe.elements();

const card = elements.create('card', {
    style: {
        base: {
            fontSize: '16px',
            color: '#32325d',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a'
        }
    }
});

card.mount('#card-element');

card.on('change', function(event) {
    const displayError = document.getElementById('card-errors');
    displayError.textContent = event.error ? event.error.message : '';
});

document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const cardHolderName = document.getElementById('cardName').value;

    stripe.createPaymentMethod({
        type: 'card',
        card: card,
        billing_details: {
            name: cardHolderName
        }
    }).then(function(result) {
        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
        } else {
            // ✅ Collect ICCIDs
            const iccidInputs = document.querySelectorAll('.iccid-input');
            const iccids = {};

            iccidInputs.forEach(input => {
                const itemName = input.dataset.item;
                if (!iccids[itemName]) iccids[itemName] = [];
                iccids[itemName].push(input.value.trim());
            });

            // ✅ Send to backend with cart & payment method
            fetch('<?= base_url("purchase") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        payment_method: result.paymentMethod.id,
                        cart_items: cartItems,
                        grand_total: grandTotal,
                        iccids: iccids
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Order Booked Successfully');
                        // window.location.href = "<?= base_url('order/success') ?>";
                    } else {
                        document.getElementById('card-errors').textContent = data.error;
                    }
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('card-errors').textContent = 'Payment request failed.';
                });
        }
    });
});
</script>