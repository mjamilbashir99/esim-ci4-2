    <div class="mt-5 px-5">
      <div class="row ">
        <div class="col-md-3">
          <div class="filter-section">
            <div class="header-search-listing">
            <div class="container">
                <h5 class="text-center">
                    <?= !empty($hotels['hotels'][0]['zoneName']) ? esc($hotels['hotels'][0]['zoneName']) : 'Unknown Location' ?>
                </h5>
                <p class="mb-0 text-center" style="font-size: 14px">
                    <?= !empty($hotels['hotels']) ? count($hotels['hotels']) . ' hotels found' : '0 hotels found' ?>
                </p>
            </div>

            </div>
            <h5 class="card-title mb-2">Sort By</h5>
            <select class="form-select sort-dropdown mb-3" id="sortHotels">
                <option selected value="">Select</option>
                <option value="name-asc">Hotel Name (A-Z)</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
            </select>

            <h5 class="mt-4 card-title mb-2">Filters</h5>

            <div id="hotelNameFilters">
                <?php if (!empty($hotels['hotels'])): ?>
                    <?php foreach ($hotels['hotels'] as $index => $hotel): ?>
                        <?php if (!empty($hotel['name'])): ?>
                            <div class="form-check">
                                <input 
                                    class="form-check-input hotel-name-filter" 
                                    type="checkbox" 
                                    id="hotelFilter<?= $index ?>" 
                                    value="<?= esc($hotel['name']) ?>"
                                />
                                <label class="form-check-label" for="hotelFilter<?= $index ?>">
                                    <?= esc($hotel['name']) ?>
                                </label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php
                $prices = [];

                if (!empty($hotels['hotels'])) {
                    foreach ($hotels['hotels'] as $hotel) {
                        if (isset($hotel['rooms'][0]['rates'][0]['net'])) {
                            $prices[] = (float)$hotel['rooms'][0]['rates'][0]['net'];
                        }
                    }
                }

                $maxPrice = !empty($prices) ? max($prices) : 0;
                $rangeStep = 100;
                $nextRangeEnd = ceil($maxPrice / $rangeStep) * $rangeStep;
                ?>

                <div class="container mt-5 p-0">
                    <div class="card" style="border: none !important">
                        <div class="card-body" style="padding: 0px !important">
                            <h5 class="card-title">Price Range</h5>
                            <div class="price-range-options">
                                <div id="priceRangeOptions">
                                    <?php
                                    if ($maxPrice > 0) {
                                        for ($i = 0; $i < $nextRangeEnd; $i += $rangeStep) {
                                            $start = $i;
                                            $end = $i + $rangeStep;
                                            if ($end > $nextRangeEnd) {
                                                $end = $nextRangeEnd;
                                            }
                                            $label = $start == 0 ? "Below $$end" : "\$$start - \$$end";
                                            $value = "$start-$end";
                                            ?>
                                            <div class="price-range-item">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input price-filter"
                                                        type="checkbox"
                                                        id="price<?= $start ?>"
                                                        value="<?= $value ?>"
                                                    />
                                                    <label class="form-check-label" for="price<?= $start ?>">
                                                        <?= $label ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        echo '<p>No prices available</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

          </div>
        </div>
        

        <div class="col-md-9" id="hotelList">
            <?php if (!empty($hotels['hotels'])): ?>
                <?php foreach ($hotels['hotels'] as $hotel): ?>
                    <div>
                    
                    <div class="hotel-card" onclick="viewHotelDetails(<?= esc($hotel['code']) ?>)"
                        data-name="<?= esc($hotel['name'] ?? '') ?>" 
                        data-price="<?= esc($hotel['rooms'][0]['rates'][0]['net'] ?? 0) ?>">
                        <div class="row g-0 hotel-info-wrapper">
                        <div class="col-md-4 col-md-tab">
                            <div
                            class="hotel-image"
                            style="
                                background-image: url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60');
                            "
                            ></div>
                        </div>
                        <div class="col-md-8 col-md-tab">
                            <div class="hotel-info">
                            <div class="d-flex justify-content-between hotel-info-container">
                                <div class="w-50 d-flex flex-column gap-3 hotel-info-child-1">
                                <div>
                                <h4><?= !empty($hotel['name']) ? esc($hotel['name']) : 'Unnamed Hotel' ?></h4>

                                    <div class="d-flex gap-2" style="height: 30px">
                                    <p class="district mb-2"><?= !empty($hotel['destinationCode']) ? esc($hotel['destinationCode']) : '' ?>, <?= !empty($hotel['zoneName']) ? esc($hotel['zoneName']) : '' ?></p>
                                    </div>
                                    <div class="pb-2">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    </div>

                                    <div class="d-flex gap-2">
                                    <div class="share-deal-btn">
                                        <i class="fa-solid fa-share-from-square"></i>
                                        <p class="m-0">Share Deal</p>
                                    </div>
                                    <i class="fa-regular fa-heart" style="color: #007bff"></i>
                                    </div>
                                </div>

                                <?php
                                    $ratingText = 'Unknown';
                                    if (!empty($hotel['categoryName'])) {
                                        if (strpos($hotel['categoryName'], '5') !== false) {
                                            $ratingText = 'Excellent';
                                        } elseif (strpos($hotel['categoryName'], '4') !== false) {
                                            $ratingText = 'Good';
                                        } elseif (strpos($hotel['categoryName'], '1') !== false || strpos($hotel['categoryName'], '2') !== false || strpos($hotel['categoryName'], '3 Stars') !== false) {
                                            $ratingText = 'Average';
                                        }
                                    }
                                ?>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rating-circle"><?= !empty($hotel['categoryName']) ? esc($hotel['categoryName']) : '' ?></div>
                                        <div>
                                            <div class="rating-label"><?= esc($ratingText) ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card w-50 hotel-info-child-2" style="border: none;justify-content:end">
                                    <?php helper('generic_helper'); ?>
                                    <div class="d-flex justify-content-between mt-1">
                                        <span class="price-label">Regular Price</span> 
                                        <?php 
                                            $netPrice = isset($hotel['rooms'][0]['rates'][0]['net']) ? $hotel['rooms'][0]['rates'][0]['net'] : '';

                                            // Calculate profit price
                                            $sellingPrice = $netPrice !== '' ? calculateProfitPrice($netPrice) : '';
                                        ?>
                                        <span class="price-value">$<?= esc($sellingPrice) ?></span>
                                    </div>
                                <hr />
                                <button class="select-room-btn">SELECT ROOM</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="margin-top:20px;">No hotels found.</p>
            <?php endif; ?>
      </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        function viewHotelDetails(code) {
            window.location.href = "<?= site_url('hotel-details') ?>/" + code;
        }
    </script>
    <script>
        document.getElementById('sortHotels').addEventListener('change', function () {
            const sortBy = this.value;
            const hotelList = document.getElementById('hotelList');
            const hotels = Array.from(hotelList.getElementsByClassName('hotel-card'));

            hotels.sort((a, b) => {
                if (sortBy === 'name-asc') {
                    return a.dataset.name.localeCompare(b.dataset.name);
                }
                if (sortBy === 'price-low') {
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                }
                if (sortBy === 'price-high') {
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                }
                return 0;
            });

            hotels.forEach(hotel => hotelList.appendChild(hotel));
        });
    </script>

    <script>
        const hotelNameFilters = document.querySelectorAll('.hotel-name-filter');
        const hotelList = document.getElementById('hotelList');
        const allHotels = Array.from(hotelList.getElementsByClassName('hotel-card'));

        hotelNameFilters.forEach(filter => {
            filter.addEventListener('change', function () {
                applyHotelFilters();
            });
        });

        function applyHotelFilters() {
            const selectedHotels = Array.from(document.querySelectorAll('.hotel-name-filter:checked'))
                .map(input => input.value);

            allHotels.forEach(hotel => {
                const hotelName = hotel.dataset.name;

                if (selectedHotels.length === 0 || selectedHotels.includes(hotelName)) {
                    hotel.style.display = 'block';
                } else {
                    hotel.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        const priceFilters = document.querySelectorAll('.price-filter');
        const hotelListing = document.getElementById('hotelList');
        const noResultsMessage = document.createElement('p');
        noResultsMessage.textContent = 'No results found for the selected price range.';
        noResultsMessage.style.color = 'red';
        noResultsMessage.style.textAlign = 'center';
        noResultsMessage.style.fontWeight = 'bold';
        noResultsMessage.style.marginTop = '30px';

        priceFilters.forEach(filter => {
            filter.addEventListener('change', function () {
                applyPriceFilters();
            });
        });

        function applyPriceFilters() {
            const selectedRanges = Array.from(document.querySelectorAll('.price-filter:checked'))
                .map(input => input.value);

            const hotels = document.querySelectorAll('.hotel-card');
            let resultsFound = false;

            hotels.forEach(hotel => {
                const price = parseFloat(hotel.dataset.price || 0);
                let show = selectedRanges.length === 0;

                selectedRanges.forEach(range => {
                    const [min, max] = range.split('-').map(parseFloat);

                    if (price >= min && price <= max) {
                        show = true;
                    }
                });

                if (show) {
                    hotel.style.display = 'block';
                } else {
                    hotel.style.display = 'none';
                }

                if (show) {
                    resultsFound = true;
                }
            });

            if (!resultsFound) {
                if (!document.body.contains(noResultsMessage)) {
                    hotelListing.appendChild(noResultsMessage);
                }
            } else {
                if (document.body.contains(noResultsMessage)) {
                    noResultsMessage.remove();
                }
            }
        }


    </script>
   





    
