<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    <link href="<?= base_url('assets/css/esimstyle.css') ?>" rel="stylesheet" />
    <style>
    .custom-section {
        padding: 60px 20px;
    }

    .custom-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <nav id="navbar-example2" class="navbar px-2 px-lg-5 mb-3 position-relative">
        <div class="d-flex align-items-center justify-content-between mbl-w-100 w-100">
            <!-- Desktop Logo -->
            <a class="navbar-brand d-none d-lg-block w-25" href="#">
                <!-- <img src="./assests/logo.svg" class="w-50" alt="logo" /> -->
                <p class="h4">Logo</p>
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

                <!-- My Account -->
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link d-flex gap-2 fw-bold" href="#scrollspyHeading2">
                        My Account
                        <i class="bi bi-person-gear"></i>
                    </a>
                </li>

                <!-- Language Dropdown -->
                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle fw-bold" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">
                        More
                        <i class="bi bi-chevron-down" style="font-size: 14px"></i>
                    </a>
                    <ul class="dropdown-menu bg-dark-green dropdown-size overflow-auto scroll-colored">
                        <li>
                            <a class="dropdown-item text-wrap" href="#scrollspyHeading3">International Calling</a>
                        </li>
                        <li class="">
                            <a class="dropdown-item" href="#scrollspyHeading4">esim Compatibilty</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#scrollspyHeading5">Fifth</a>
                        </li>
                    </ul>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item">
                    <a class="nav-link" href="#scrollspyHeading5">
                        <i class="bi bi-cart2"></i>
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
                <p class="text-light-green">Home</p>
                <p class="text-light-green">eSim Data Plans</p>
                <p class="text-light-green">Compatibility</p>
                <p class="text-light-green">Support</p>
                <p class="text-light-green">eSim Benafits</p>
            </div>
        </div>
    </nav>

    <main>
        <section class="container-fluid p-0 m-0 position-relative col-md-12 mobile-banner"
            style="height: auto; margin-top: -20px !important; overflow-y: hidden">
            <video class="inline-webm-video video-background d-none d-md-block" playsinline="" autoplay="" muted=""
                loop="">
                <source src="//breezesim.com/cdn/shop/t/108/assets/hero-video.mp4?v=123329851794697263961719408166"
                    type="" />
            </video>
            <!-- overlay video -->
            <div class="overlay-banner">
                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <div class="">
                        <h1 class="text-light h1 fw-bolder py-2">
                            eSIM for Every Journey
                        </h1>
                        <p class="h6 fw-normal text-light text-center py-2">
                            Roam Easy: Data, Calls & Texts in One eSIM.
                        </p>
                        <div class="input-group overflow-hidden border border-light border-radius my-4">
                            <input type="text" style="background-color: transparent !important"
                                class="form-control text-light border-none"
                                aria-label="Dollar amount (with dot and two decimal places)" />

                            <span class="input-group-text" style="
                    background-color: transparent !important;
                    border-top: none;
                    border-bottom: none;
                    border-right: none;
                  "><i class="bi bi-search text-light"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container-fluid p-0 m-0 position-relative my-5">
            <h2 class="display-6 fw-bold my-5 text-dark-green text-center">
                Which Country is Calling you?
            </h2>
            <ul class="nav nav-pills mb-3 container d-flex justify-content-center align-items-center gap-2"
                id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active border-radius tab-nav-active" id="pills-home-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                        aria-controls="pills-home" aria-selected="true" style="color: black">
                        Available Bundles
                    </button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link border-radius tab-nav-active" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false" style="color: black">
                        Data + voice Calls
                    </button>
                </li> -->
            </ul>

            <div class="tab-content container" id="pills-tabContent">
                <div class="tab-pane fade show active shadow border-radius container p-5" id="pills-home"
                    role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="row gap-2 flex-md-column flex-lg-row">
                        <div
                            class="col-lg-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
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
                            </div>
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade shadow border-radius container p-5" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="row gap-2">
                        <div
                            class="col-md-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="https://flagcdn.com/pk.svg" alt="Canada" style="
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
                            </div>
                            <i class="bi bi-arrow-up-right"></i>
                        </div>

                        <div
                            class="col-md-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="https://flagcdn.com/sa.svg" alt="Canada" style="
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
                            </div>
                            <i class="bi bi-arrow-up-right"></i>
                        </div>

                        <div
                            class="col-md-3 p-2 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="https://flagcdn.com/us.svg" alt="Canada" style="
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
                            </div>
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 my-5">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="mb-3">
                            <i class="bi bi-globe2 fs-1 text-success"></i>
                        </div>
                        <h5 class="fw-semibold">Affordable Plans</h5>
                        <p class="mb-0">
                            Enjoy Global Connectivity without<br />
                            Overspending
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="mb-3">
                            <i class="bi bi-phone fs-1 text-success"></i>
                        </div>
                        <h5 class="fw-semibold">Free Roaming</h5>
                        <p class="mb-0">Say Goodbye to Roaming Charges</p>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="mb-3">
                            <i class="bi bi-speedometer2 fs-1 text-success"></i>
                        </div>
                        <h5 class="fw-semibold">Reliable & Fast Internet</h5>
                        <p class="mb-0">Stream, Browse, and Connect Faster</p>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="mb-3">
                            <i class="bi bi-sim fs-1 text-success"></i>
                        </div>
                        <h5 class="fw-bold">Easy Installation</h5>
                        <p class="mb-0">Get Connected in a few Taps</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="custom-section bg-dark-green">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left side: Text + Button -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h2 class="mb-3 text-light h1 fw-bold">Explore Amazing Places</h2>
                        <p class="mb-4 text-light-green display-6">
                            however the wind may drift, it means little to the air in motion
                        </p>
                        <a href="#"
                            class="btn btn-primary text-dark border-radius border-light bg-light-green display-6">Get
                            Started</a>
                    </div>

                    <!-- Right side: Image -->
                    <div class="col-md-6">
                        <img src="https://picsum.photos/seed/picsum/536/354" alt="Travel" class="custom-image" />
                    </div>
                </div>
            </div>
        </section>

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
                                        Question 1: What is Bootstrap?
                                    </button>
                                </h2>
                                <div id="leftCollapseOne" class="accordion-collapse collapse" aria-labelledby="leftOne"
                                    data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        Bootstrap is a popular front-end framework for building
                                        responsive websites.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border-radius border-color-dark overflow-hidden">
                                <h2 class="accordion-header" id="leftTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#leftCollapseTwo" aria-expanded="false"
                                        aria-controls="leftCollapseTwo">
                                        Question 2: How do I use Bootstrap?
                                    </button>
                                </h2>
                                <div id="leftCollapseTwo" class="accordion-collapse collapse" aria-labelledby="leftTwo"
                                    data-bs-parent="#accordionLeft">
                                    <div class="accordion-body">
                                        You can use Bootstrap via CDN or install via npm.
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
                                        Question 3: Is Bootstrap free?
                                    </button>
                                </h2>
                                <div id="rightCollapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="rightOne" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        Yes, Bootstrap is free and open-source under MIT license.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-radius border-color-dark overflow-hidden">
                                <h2 class="accordion-header" id="rightTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#rightCollapseTwo" aria-expanded="false"
                                        aria-controls="rightCollapseTwo">
                                        Question 4: Can I use Bootstrap with React?
                                    </button>
                                </h2>
                                <div id="rightCollapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="rightTwo" data-bs-parent="#accordionRight">
                                    <div class="accordion-body">
                                        Yes, you can use Bootstrap classes in React or use
                                        React-Bootstrap library.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
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
                        <li class="text-dark-green">United States</li>
                        <li class="text-dark-green">Canada</li>
                        <li class="text-dark-green">United Kingdom</li>
                        <li class="text-dark-green">Japan</li>
                        <li class="text-dark-green">Indonesia</li>
                    </ul>
                </div>

                <!-- Links -->
                <div class="col-md-3">
                    <h6 class="mb-3 h4 fw-bold text-dark-green">Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark-green">Home</a></li>
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
</body>

</html>