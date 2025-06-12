<style>
.nav-tabs .nav-link.active {
    background: var(--bg-light) !important;
    color: var(--bg-dark) !important;
}
</style>

<div class="container py-4">
    <div class="row">
        <!-- Left section -->
        <div class="col-lg-6 p-5">
            <small class="text-secondary">Prepaid Travel ✈️</small>
            <h2 class="fw-bold my-2 mb-4"><?= esc($bundle['description']) ?></h2>

            <img src="<?= esc($bundle['imageUrl']) ?>" alt="<?= esc($bundle['imageUrl']) ?>"
                class="img-fluid border-radius border-color-dark" />
        </div>

        <!-- Right section -->
        <div class="col-lg-6 py-5">
            <!-- <h4 class="fw-bold mb-4">
           <?= esc($bundle['countries'][0]['name'] ?? 'N/A') ?>
          </h4> -->

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3 gap-2" id="planTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active border-radius border-color-dark tab-nav-active" id="standard-tab"
                        data-bs-toggle="tab" data-bs-target="#standard" type="button" role="tab"
                        aria-controls="standard" aria-selected="true" style="color: black">
                        Standard Plan
                    </button>
                </li>
                <!-- <li class="nav-item" role="presentation">
              <button
                class="nav-link border-radius border-color-dark tab-nav-active"
                id="unlimited-tab"
                data-bs-toggle="tab"
                data-bs-target="#unlimited"
                type="button"
                role="tab"
                aria-controls="unlimited"
                aria-selected="false"
                style="color: black"
              >
                Unlimited Data
              </button>
            </li> -->
                <li class="ms-auto text-muted d-flex align-items-center px-2">
                    Excellent ⭐⭐⭐⭐⭐
                </li>
            </ul>
            <div id="cartMessage" class="alert alert-success alert-dismissible fade" role="alert"
                style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <span id="cartMessageText"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- Tabs Content -->
            <div class="tab-content" id="planTabsContent">
                <div class="tab-pane fade show active" id="standard" role="tabpanel" aria-labelledby="standard-tab">
                    <div class="row gap-2 p-4">
                        <div class="radio-card position-relative col-md-4 border-radius bg-light p-0 overflow">
                            <!-- Input -->
                            <input type="radio" name="plan" id="plan1" class="position-absolute" checked />
                            <label for="plan1" class="d-block border-radius p-3 h-100 w-100 m-0">
                                <!-- 5G Tag -->
                                <div class="position-absolute top-0 end-0 text-success m-2">
                                    <!-- <small><strong>5G</strong></small> -->
                                    <i class="bi bi-wifi"></i>
                                </div>

                                <!-- Card Content -->
                                <div class="mt-3">
                                    <h5 class="fw-bold mb-1"><?= esc($bundle['dataAmount'] / 1000 ?? 'N/A') ?> GB</h5>
                                    <p class="mb-2 text-muted">
                                        <i class="bi bi-calendar"></i> <?= esc($bundle['duration'] ?? 'N/A') ?> Days
                                    </p>
                                    <h5 class="fw-bold mb-1">
                                        <?= esc($bundle['selling_price'] ?? $bundle['price']) ?> <small
                                            class="text-muted">USD</small>
                                    </h5>
                                    <p class="mb-3 text-muted">
                                        <i class="bi bi-globe"></i>
                                        <?= esc($bundle['countries'][0]['name'] ?? 'N/A') ?>
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quantity and Add to Cart -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

                <!-- Quantity Selector -->
                <div class="input-group input-group-sm" style="width: 120px;">
                    <button class="btn btn-outline-secondary" type="button" id="decreaseQty">
                        <i class="bi bi-dash"></i>
                    </button>
                    <input type="text" class="form-control text-center" id="bundleQty" value="1" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="increaseQty">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>

                <!-- Add to Cart Button -->
                <button type="button" class="btn btn-sm btn-success" id="addToCartBtn"
                    data-bundle="<?= esc($bundle['name']) ?>"
                    data-country="<?= esc($bundle['countries'][0]['name'] ?? 'N/A') ?>"
                    data-price="<?= esc($bundle['selling_price'] ?? $bundle['price']) ?>">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>

            </div>

            <hr />

            <ul class="nav nav-pills mb-3 gap-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active border-radius border-color-dark text-dark" id="pills-home-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                        aria-controls="pills-home" aria-selected="true">
                        Feature
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link border-radius border-color-dark text-dark" id="pills-profile-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                        aria-controls="pills-profile" aria-selected="false">
                        Description
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link border-radius border-color-dark text-dark" id="pills-contact-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                        aria-controls="pills-contact" aria-selected="false">
                        Specification
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <h5 class="fw-bold mt-4 text-dark-green">
                        Our Virtual SIM Specifications
                    </h5>
                    <ul class="pl-4">
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Internet Speed:</strong> 2G,
                            3G, 4G, 5G
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Tethering / Mobile Hotspot:</strong>
                            Yes
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Data Options:</strong>
                            Multiple data options from 1GB to unlimited
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Usage Duration:</strong>
                            According to the data plan you choose
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Phone Number:</strong> No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Subscription Type:</strong>
                            Prepaid mobile eSIM plans (data only)
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Text Messages:</strong> No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Voice Calls:</strong> No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Activation / Start-Up:</strong>
                            Through QR Code and manual
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div>
                        <h5 class="fw-bold mt-4 text-dark-green">
                            Our Virtual SIM Specifications SIM Card's Canada eSIM Stay
                            connected in Canada with eSIM
                        </h5>
                        <p class="text-dark-green">
                            Card eSIM for Canada. Experience the freedom of high-speed
                            data (2G,3G,4G,5G) across Canada with our eSIM, and forget
                            about roaming charges. Enjoy the best coverage in top spots
                            like Immerse yourself in vibrant cities of Toronto and
                            Vancouver to the majestic Rocky Mountains, without ever losing
                            connection, enjoy the best coverage and fast internet wherever
                            your adventures take you
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">
                    <h5 class="fw-bold mt-4 text-dark-green">
                        Our Virtual SIM Specifications
                    </h5>
                    <ul class="pl-4">
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Internet Speed:</strong> 2G,
                            3G, 4G, 5G
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Tethering / Mobile Hotspot:</strong>
                            Yes
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Data Options:</strong>
                            Multiple data options from 1GB to unlimited
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Usage Duration:</strong>
                            According to the data plan you choose
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Phone Number:</strong> No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Subscription Type:</strong>
                            Prepaid mobile eSIM plans (data only)
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Text Messages:</strong> No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Voice Calls:</strong> No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Activation / Start-Up:</strong>
                            Through QR Code and manual
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Service Area:</strong> All
                            over Canada
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Shipping:</strong> Via Email
                            or in the App
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Delivery Time:</strong>
                            Immediately after purchase
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">ID / eKYC Required:</strong>
                            No
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Designed For:</strong>
                            Travelers, Business Professionals, Tech Enthusiasts, and Users
                            in Remote Areas
                        </li>
                        <li class="text-dark-green">
                            <strong class="text-dark-green">Unlimited Bundles:</strong>
                            Unlimited bundles provide a fixed amount of unthrottled 5G
                            data every 24 hours. After that, unlimited data continues at
                            lower speeds. The 24h period resets from the first use of the
                            bundle.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <h5 class="h2 mt-4 text-dark-green py-4">Popular Countries</h5>
        <div class="row gap-2 flex-md-column flex-lg-row">
           <div
                class="col-lg-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                 <a href="<?= base_url()?>esim?country=Canada#bundles-section">
                <div class="d-flex gap-3 align-items-center">
                    <img src="https://flagcdn.com/ca.svg" alt="Canada" style="
                  width: 50px;
                  height: 50px;
                  object-fit: cover;
                  border-radius: 50%;
                " />
                    <div class="text-dark-green">
                        <p class="h6 fw-bold m-0">Canada</p>
                        <p class="h6 fw-normal m-0">
                            Starting from <small>$ 2.45</small>
                        </p>
                    </div>
                </div></a>
                <i class="bi bi-arrow-up-right"></i>
            </div>

            <div
                class="col-lg-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                <a href="<?= base_url()?>esim?country=United+Arab+Emirates#bundles-section">
                <div class="d-flex gap-3 align-items-center">
                    <img src="https://flagcdn.com/ae.svg" alt="Canada" style="
                  width: 50px;
                  height: 50px;
                  object-fit: cover;
                  border-radius: 50%;
                " />
                    <div class="text-dark-green">
                        <p class="h6 fw-bold m-0">United Arab Emirates</p>
                        <p class="h6 fw-normal m-0">
                            Starting from <small>$ 2.45</small>
                        </p>
                    </div>
                </div></a>
                <i class="bi bi-arrow-up-right"></i>
            </div>

            <div
                class="col-lg-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                <a href="<?= base_url()?>esim?country=Australia#bundles-section">
                <div class="d-flex gap-3 align-items-center">
                    <img src="https://flagcdn.com/au.svg" alt="Canada" style="
                  width: 50px;
                  height: 50px;
                  object-fit: cover;
                  border-radius: 50%;
                " />
                    <div class="text-dark-green">
                        <p class="h6 fw-bold m-0">Australia</p>
                        <p class="h6 fw-normal m-0">
                            Starting from <small>$ 2.45</small>
                        </p>
                    </div>
                </div></a>
                <i class="bi bi-arrow-up-right"></i>
            </div>
        </div>
    </div>
    <section class="container mb-5">
        <div class="container mt-5">
            <h2 class="mb-4 display-6 fw-bold text-dark-green text-center">
                FAQs
            </h2>
            <div class="row">
                <div class="col-md-6 mb-md-3">
                    <div class="accordion" id="accordionLeft">
                        <div class="accordion-item mb-3 border-radius border-color-dark overflow-hidden">
                            <h2 class="accordion-header" id="leftOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#leftCollapseOne" aria-expanded="false"
                                    aria-controls="leftCollapseOne">
                                    Question 1: What is an eSim?
                                </button>
                            </h2>
                            <div id="leftCollapseOne" class="accordion-collapse collapse" aria-labelledby="leftOne"
                                data-bs-parent="#accordionLeft">
                                <div class="accordion-body">
                                   eSIM stands for “embedded SIM”, because everything you need is digitally built into your smartphone or tablet. Think of it as the evolution of the SIM card - it’s just like your old SIM, but better! Now there are no tiny holes or bits of plastic to deal with, so you never have to think about swapping out SIM cards again. Wave goodbye to the old and say hello to the future of mobile connectivity!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 border-radius border-color-dark overflow-hidden">
                            <h2 class="accordion-header" id="leftTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#leftCollapseTwo" aria-expanded="false"
                                    aria-controls="leftCollapseTwo">
                                    Question 2: Can All Phones Use eSIM?
                                </button>
                            </h2>
                            <div id="leftCollapseTwo" class="accordion-collapse collapse" aria-labelledby="leftTwo"
                                data-bs-parent="#accordionLeft">
                                <div class="accordion-body">
                                    Ensure your phone is both network unlocked and eSIM compatible before making a purchase. All iPhones made since 2018 and most new Android models are compatible.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="accordion" id="accordionRight">
                        <div class="accordion-item mb-3 border-radius border-color-dark overflow-hidden">
                            <h2 class="accordion-header" id="rightOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#rightCollapseOne" aria-expanded="true"
                                    aria-controls="rightCollapseOne"> 
                                    Is eSIM good for travel?
                                </button>
                            </h2>
                            <div id="rightCollapseOne" class="accordion-collapse collapse" aria-labelledby="rightOne"
                                data-bs-parent="#accordionRight">
                                <div class="accordion-body">
                                   Yes, eSIM is a great option for travelers. It allows you to switch between different carriers and plans without needing to physically swap SIM cards. This means you can easily get local data plans when traveling abroad, avoiding expensive roaming charges.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-radius border-color-dark overflow-hidden">
                            <h2 class="accordion-header" id="rightTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#rightCollapseTwo" aria-expanded="false"
                                    aria-controls="rightCollapseTwo">
                                    Question 4: What country do not support eSIM?
                                </button>
                            </h2>
                            <div id="rightCollapseTwo" class="accordion-collapse collapse" aria-labelledby="rightTwo"
                                data-bs-parent="#accordionRight">
                                <div class="accordion-body">
                                    While eSIM is widely accepted, a few places might still be catching up. Like use of eSIM in India and Russia is not common. It's best to check eSIMCard's country list before you go. But don't worry, most countries are on board with eSIM technology now!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Quantity Increment/Decrement for Product
document.addEventListener('DOMContentLoaded', function() {
    const incrementBtn = document.getElementById("increment");
    const decrementBtn = document.getElementById("decrement");
    const quantityInput = document.getElementById("quantity");

    if (incrementBtn && decrementBtn && quantityInput) {
        incrementBtn.addEventListener("click", () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        decrementBtn.addEventListener("click", () => {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
    }
});

// Quantity for Bundle Add to Cart
document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const qtyInput = document.getElementById('bundleQty');
    const addToCartBtn = document.getElementById('addToCartBtn');

    if (decreaseBtn && increaseBtn && qtyInput && addToCartBtn) {
        decreaseBtn.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }
        });

        increaseBtn.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
        });

        addToCartBtn.addEventListener('click', () => {
            const bundleName = addToCartBtn.getAttribute('data-bundle');
            const country = addToCartBtn.getAttribute('data-country');
            const price = parseFloat(addToCartBtn.getAttribute('data-price'));
            const quantity = parseInt(qtyInput.value);

            fetch('<?= site_url('cart/add') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        bundleName,
                        country,
                        price,
                        quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showCartMessage('Bundle successfully added to cart!');
                        updateCartCount();

                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong.');
                });
        });
    }
});

// Show success message nicely
function showCartMessage(message) {
    let msgBox = document.getElementById('cartMessage');
    let msgText = document.getElementById('cartMessageText');

    if (!msgBox) {
        msgBox = document.createElement('div');
        msgBox.id = 'cartMessage';
        msgBox.className = 'toast align-items-center text-white bg-success position-fixed top-0 end-0 m-3';
        msgBox.style.zIndex = '9999';
        msgBox.setAttribute('role', 'alert');
        msgBox.setAttribute('aria-live', 'assertive');
        msgBox.setAttribute('aria-atomic', 'true');
        msgBox.innerHTML = `
            <div class="d-flex">
                <div class="toast-body" id="cartMessageText"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        document.body.appendChild(msgBox);
    }

    msgText = document.getElementById('cartMessageText');
    msgText.textContent = message;

    const toast = new bootstrap.Toast(msgBox);
    toast.show();
}

// Update Cart Count Badge
function updateCartCount() {
    fetch('<?= site_url('cart/count') ?>')
        .then(response => response.json())
        .then(data => {
            const countBadge = document.getElementById('cartCountBadge');
            if (data.count > 0) {
                countBadge.textContent = data.count;
                countBadge.style.display = 'inline-block';
            } else {
                countBadge.style.display = 'none';
            }
        });
}

// Load Cart Count on Page Load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
</script>

</body>

</html>