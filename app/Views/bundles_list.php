
    <style>
    .custom-section {
        padding: 60px 20px;
    }

    .custom-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .autocomplete-suggestions {
            z-index: 1000;
            background: #fff;
            max-height: 150px;
            overflow-y: auto;
            width: 100%;
        }
        .autocomplete-suggestion {
            padding: 8px;
            cursor: pointer;
        }
        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
        }
        #search-input::placeholder {
    color: white !important;
    opacity: 1; /* For Firefox */
}
.flag-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }
        .flag {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease;
        }
        .flag:hover {
                transform: scale(1.3);
            }
        .andorra { background-image: url('https://flagcdn.com/w320/ad.png'); }
        .united-arab-emirates { background-image: url('https://flagcdn.com/w320/ae.png'); }
        .australia { background-image: url('https://flagcdn.com/w320/au.png'); }
        .brazil { background-image: url('https://flagcdn.com/w320/br.png'); }
        .canada { background-image: url('https://flagcdn.com/w320/ca.png'); }
        .chile { background-image: url('https://flagcdn.com/w320/cl.png'); }
        .denmark { background-image: url('https://flagcdn.com/w320/dk.png'); }
    </style>

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
                    <div class="text-center">
                         <?php if ($session->has('user_id')) : ?>
                        <h1 class="text-light h1 py-2">Welcome <b><?= esc($session->get('user_name')) ?></b></h1>
                        <?php endif; ?>
                        <h1 class="text-light h1 fw-bolder py-2">
                            eSIM for Every Journey
                        </h1>
                        <p class="h6 fw-normal text-light text-center py-2">
                            Roam Easy: Data, Calls & Texts in One eSIM.
                        </p>
                        <div class="flag-container">
                            <a href="?country=Andorra#bundles-section"><div class="flag andorra"></div></a>
                            <a href="?country=United+Arab+Emirates#bundles-section"><div class="flag united-arab-emirates"></div></a>
                            <a href="?country=Australia#bundles-section"><div class="flag australia"></div></a>
                            <a href="?country=Brazil#bundles-section"><div class="flag brazil"></div></a>
                            <a href="?country=Canada#bundles-section"><div class="flag canada"></div></a>
                            <a href="?country=Chile#bundles-section"><div class="flag chile"></div></a>
                            <a href="?country=Denmark#bundles-section"><div class="flag denmark"></div></a>
                        </div>
                        <div class="input-group overflow-hidden border border-light border-radius my-4">
                            <form method="get" action="<?= site_url('esim') ?>" id="search-form" class="d-flex w-100">
                                <input type="text" name="search" style="background-color: transparent !important;" class="form-control text-light border-none" id="search-input" placeholder="Search countries..." aria-label="Search countries" value="<?= esc($searchQuery ?? '') ?>" autocomplete="off" />

                                <button type="submit" class="input-group-text border-0" style="background-color: transparent !important;">
                                    <i class="bi bi-search text-light"></i>
                                </button>
                            </form>
                        </div>
                        <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="bundles-section" class="container-fluid p-0 m-0 position-relative my-5">
            <h2 class="display-6 fw-bold my-5 text-dark-green text-center">
                Available Bundles
            </h2>
            <div class="tab-content container" id="pills-tabContent">
                <div class="tab-pane fade show active shadow border-radius container p-5" id="pills-home"
                    role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <div  class="row gap-2 flex-md-column flex-lg-row">
                    <?php if (!empty($bundles)): ?>
                    <?php foreach ($bundles as $bundle): ?>
                        <div
                            class="col-lg-3 p-2 mt-3 bg-light-green border-radius border-color-dark col container-fluid d-flex justify-content-between align-items-center arrow-hover-180">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="<?= esc($bundle['imageUrl']) ?>" alt="Canada" style="
                                    width: 50px;
                                    height: 50px;
                                    object-fit: cover;
                                    border-radius: 50%;
                                  " />
                                <div class="text-dark-green">
                                    <?php if (!empty($bundle['countries'])): ?>
                                    <?php foreach ($bundle['countries'] as $country): ?>
                                    <p class="h6 fw-bold m-0"><?= esc($country['name']) ?></p>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="h6 fw-bold m-0">N/A</p>
                                    <?php endif; ?>
                                    <p class="h6 fw-normal m-0">
                                        <?= esc($bundle['description']) ?>
                                    </p>
                                    <p><strong>Price:</strong> <?= convertCurrency($bundle['selling_price'] ?? $bundle['price']);  ?></p>

                                    <!-- esc($bundle['selling_price'] ?? $bundle['price']) -->
                                    <a href="<?= site_url('bundle/' . $bundle['name']) ?>">View Details</a>
                                </div>
                            </div>
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                 <?php endforeach; ?>
                <?php else: ?>
                    <p>No bundles available.</p>
                <?php endif; ?>

                    </div>
                    

    <!-- Pagination Logic -->
    <div style="margin-top: 20px; text-align: center;">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>&search=<?= esc($searchQuery ?? '') ?>#bundles-section"
           style="margin: 0 6px; padding: 6px 12px; background: <?= $i == $currentPage ? '#007bff' : '#eee' ?>; color: <?= $i == $currentPage ? '#fff' : '#000' ?>; text-decoration: none; border-radius: 4px;">
            <?= $i ?>
        </a>
    <?php endfor; ?>
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
                 <h2 class="mt-5">Browse Bundles by Country</h2>
    <div style="margin-bottom: 20px;">
        <a href="<?= site_url('esim') ?>#bundles-section"
           style="margin-right: 10px; font-weight: <?= empty($selectedCountry) ? 'bold' : 'normal' ?>">All</a>
        <?php foreach ($countries as $country): ?>
            <a href="<?= site_url('esim') ?>?country=<?= urlencode($country) ?>#bundles-section"
               style="margin-right: 10px; font-weight: <?= $selectedCountry == $country ? 'bold' : 'normal' ?>">
                <?= esc($country) ?>
            </a>
        <?php endforeach; ?>
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
    </main>
    