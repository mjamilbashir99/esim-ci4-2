<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Esim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    <link href="<?= base_url('assets/css/esimstyle.css') ?>" rel="stylesheet" />
</head>

<body>
    <nav id="navbar-example2" class="navbar px-2 px-lg-5 mb-3 position-relative">
        <div class="d-flex align-items-center justify-content-between mbl-w-100 w-100">
            <!-- Desktop Logo -->
            <a class="navbar-brand d-none d-lg-block w-25" href="#">
                <p class="h4">eSIM</p>
            </a>

            <ul class="nav nav-pills align-items-center gap- mbl-w-100 justify-content-between">
                <!-- Offcanvas Menu Toggle -->
                <li class="nav-item mbl-nav-menu">
                    <a class="nav-link d-flex align-items-center gap-2 fw-bold" href="#scrollspyHeading1">
                        Menu
                        <i class="bi bi-list icon-size" id="menuToggleIcon" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>
                    </a>
                </li>

                <!-- Mobile Logo -->
                <li class="nav-item d-lg-none logo-mbl">
                    <a class="w-100 d-flex justify-content-center align-items-center" href="#">
                        <img src="./assests/logo.svg" class="logo-mbl" alt="logo" />
                    </a>
                </li>

                <!-- My Account OR Login -->
                <?php if ($session->has('user_id')) : ?>
                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle d-flex gap-2 fw-bold" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                        <i class="bi bi-person-gear"></i>
                    </a>
                    <ul class="dropdown-menu bg-dark">
                        <li>
                            <a class="dropdown-item" href="profile/edit">
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="<?= site_url('logout') ?>">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>

                <?php else : ?>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link d-flex gap-2 fw-bold" href="<?= site_url('login') ?>">
                        Login
                        <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Language Dropdown -->
                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle fw-bold" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">
                        More
                        <i class="bi bi-chevron-down" style="font-size: 14px"></i>
                    </a>
                    <ul class="dropdown-menu bg-dark-green dropdown-size overflow-auto scroll-colored">
                        <li><a class="dropdown-item text-wrap" href="#scrollspyHeading3">International Calling</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading4">esim Compatibilty</a></li>
                        <li><a class="dropdown-item" href="#scrollspyHeading5">Fifth</a></li>
                    </ul>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() == site_url('cart')) ? 'active' : '' ?>"
                        href="<?= site_url('cart') ?>">
                        <i class="bi bi-cart2"></i>
                        <span class="position-absolute badge rounded-pill bg-danger" id="cartCountBadge"
                            style="display:none; font-size: 0.7rem;">
                            0
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Offcanvas Menu -->
        <div class="offcanvas offcanvas-end bg-dark-green" tabindex="-1" id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-light-green" id="offcanvasRightLabel">
                    Quick Links
                </h5>

                <button type="button" class="btn-close text-light-green" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="p-4">
                <a href="/esim">
                    <p class="text-light-green">Home</p>
                </a>
            </div>
        </div>
    </nav>


    <div class="content">
        <?= $content ?>
    </div>


    <footer class="bg-light text-dark pt-5 pb-4 bg-light-green">
        <div class="container text-md-left">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-md-3">
                    <img src="logo.png" alt="eSIM Card" class="mb-3" style="width: 150px" />
                    <h6 class="mb-3 text-dark-green h4 fw-bold">Contact Info</h6>
                    <p class="mb-2">
                        <i class="bi bi-building text-dark-green"></i> eSIM Card LLC
                    </p>
                    <p class="mb-2 text-dark">
                        <i class="bi bi-geo-alt text-dark-green"></i> 250 S. Ronald Reagan
                        Blvd., #106, Longwood, FL 32750
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-telephone text-dark-green"></i> +1 (407) 212-6950
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-envelope text-dark-green"></i> sales@esimcard.com
                    </p>
                </div>

                <!-- Popular Destinations -->
                <div class="col-md-3">
                    <h6 class="mb-3 h4 fw-bold text-dark-green">
                        Popular Destinations
                    </h6>
                    <ul class="list-unstyled">
                        <a href="<?= base_url()?>esim?country=Andorra#bundles-section"><li class="text-dark-green">Andorra</li></a>
                        <a href="<?= base_url()?>esim?country=United+Arab+Emirates#bundles-section"><li class="text-dark-green">United Arab Emirates</li></a>
                        <a href="<?= base_url()?>esim?country=Australia#bundles-section"><li class="text-dark-green">Australia</li></a>
                        <a href="<?= base_url()?>esim?country=Brazil#bundles-section"><li class="text-dark-green">Brazil</li></a>
                        <a href="<?= base_url()?>esim?country=Canada#bundles-section"><li class="text-dark-green">Canada</li></a>
                        <a href="<?= base_url()?>esim?country=Chile#bundles-section"><li class="text-dark-green">Chile</li></a>
                        <a href="<?= base_url()?>esim?country=Denmark#bundles-section"><li class="text-dark-green">Denmark</li></a>
                    </ul>
                </div>

                <!-- Links -->
                <div class="col-md-3">
                    <h6 class="mb-3 h4 fw-bold text-dark-green">Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="/esim" class="text-dark-green">Home</a></li>
                        <li><a href="#" class="text-dark-green">About Us</a></li>
                        <li><a href="#" class="text-dark-green">Buy eSIM</a></li>
                        <li><a href="#" class="text-dark-green">Careers</a></li>
                        <li>
                            <a href="#" class="text-dark-green">Distributions Partner</a>
                        </li>
                        <li><a href="#" class="text-dark-green">Blog</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="col-md-3">
                    <h6 class="mb-3 h4 fw-bold text-dark-green">Support</h6>
                    <ul class="list-unstyled">
                        <li class="text-dark-green">
                            <a href="#" class="text-dark-green">eSIM Compatible Phones</a>
                        </li>
                        <li><a href="#" class="text-dark-green">FAQs</a></li>
                        <li><a href="#" class="text-dark-green">Help Center</a></li>
                        <li><a href="#" class="text-dark-green">Redeem eSIM</a></li>
                        <li><a href="#" class="text-dark-green">What is an eSIM</a></li>
                    </ul>
                </div>
            </div>

            <!-- Social Icons -->
            <div class="row mt-4">
                <div class="col text-center">
                    <a href="#" class="text-dark-green me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-dark-green me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-dark-green me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-dark-green me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-dark-green"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Bottom Links -->
            <hr class="my-4" />
            <div class="row">
                <div class="col text-center">
                    <p class="mb-1 text-dark-green">
                        © 2025 eSIM Card. All Rights Reserved
                    </p>
                    <a href="#" class="text-dark-green me-3">Terms of Service</a>
                    <a href="#" class="text-dark-green me-3">Privacy Policy</a>
                    <a href="#" class="text-dark-green me-3">Refund Policy</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script>
    const offcanvas = document.getElementById("offcanvasRight");
    const icon = document.getElementById("menuToggleIcon");

    // Bootstrap's offcanvas instance
    const bsOffcanvas = new bootstrap.Offcanvas(offcanvas);

    // Change icon on show/hide
    offcanvas.addEventListener("show.bs.offcanvas", () => {
        icon.classList.remove("bi-list");
        icon.classList.add("bi-x");
    });

    offcanvas.addEventListener("hide.bs.offcanvas", () => {
        icon.classList.remove("bi-x");
        icon.classList.add("bi-list");
    });
    </script>

    <script>
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value;
        const suggestionsContainer = document.getElementById('autocomplete-suggestions');
        suggestionsContainer.innerHTML = '';

        if (query.length > 2) {
            fetch('/bundlesview/suggestions?query=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(country => {
                            const suggestionDiv = document.createElement('div');
                            suggestionDiv.classList.add('autocomplete-suggestion');
                            suggestionDiv.textContent = country;
                            suggestionDiv.addEventListener('click', () => {
                                document.getElementById('search-input').value = country;
                                document.getElementById('search-form')
                            .submit(); // Submit form on suggestion click
                            });
                            suggestionsContainer.appendChild(suggestionDiv);
                        });
                    }
                })
                .catch(error => console.error('Error fetching suggestions:', error));
        }
    });

    // ✅ Smooth scroll to bundles section after page reload if searchQuery exists
    document.addEventListener("DOMContentLoaded", function() {
        const hasSearchQuery = '<?= !empty($searchQuery) ? "yes" : "" ?>';
        if (hasSearchQuery) {
            const section = document.getElementById('bundles-section');
            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
    </script>
</body>

</html>