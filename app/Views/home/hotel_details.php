
<!-- <h2>Hotel Details</h2> -->
<!-- <h2>Hotel Name: <?= esc($hotelDetails['hotel']['name']['content'] ?? 'N/A') ?></h2>
<h2>Hotel Name: <?= esc($hotelDetails['hotel']['description']['content'] ?? 'N/A') ?></h2> -->

<!-- <pre><?php print_r($hotelDetails); ?></pre> -->
<style>
    .image-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
    }
</style>
<div class="container mt-4">
      <div class="card">
        <div
          class="card-body d-flex flex-sm-column flex-md-column flex-lg-row flex-wrap"
        >
          <div class="col-md-12 col-12 mb-3">
            <div class="d-flex justify-content-between mbl-flex-col">
              <div class="">
                <div class="mb-3">
                  <h1 class="card-title h3"><?= esc($hotelDetails['hotel']['name']['content'] ?? 'N/A') ?></h1>
                  <div><?= esc($hotelDetails['hotel']['address']['content'] ?? 'N/A') ?></div>
                 
                </div>

                <div class="d-flex align-items-center gap-3">
                  <div class="rating-circle"><?= esc($hotelDetails['hotel']['category']['description']['content'] ?? 'N/A') ?></div>
                  <div>
                    <?php
                        $ratingText = 'Unknown';
                        if (!empty($hotelDetails['hotel']['category']['description']['content'] ?? 'N/A')) {
                            if (strpos($hotelDetails['hotel']['category']['description']['content'], '5') !== false) {
                                $ratingText = 'Excellent';
                            } elseif (strpos($hotelDetails['hotel']['category']['description']['content'], '4') !== false) {
                                $ratingText = 'Good';
                            } elseif (strpos($hotelDetails['hotel']['category']['description']['content'], '1') !== false || strpos($hotelDetails['hotel']['category']['description']['content'], '2') !== false || strpos($hotelDetails['hotel']['category']['description']['content'], '3 Stars') !== false) {
                                $ratingText = 'Average';
                            }
                        }
                    ?>
                    <div class="rating-label"><?= $ratingText ?></div>
                    
                  </div>
                </div>
              </div>
              <div
                class="d-flex flex-column pt-4 py-sm-0 justify-content-md-between justify-content-sm-start mt-auto"
              >
                <div
                  class="d-flex gap-2 align-items-center justify-content-xs-start justify-content-md-between mobile-flex-sart"
                >
                  <b>Ranking: <?= esc($hotelDetails['hotel']['ranking'] ?? 'N/A') ?></b>
                </div>
                <div class="form-check w-100 pl-0">
                  <label
                    class="form-check-label d-flex justify-content-md-between justify-content-start gap-2"
                    for="rating5"
                  >
                    
                  </label>
                </div>
              </div>
            </div>
            <div class="my-3">
              <div
                class="d-flex flex-wrap gap-3 justify-content-evenly"
                style="background-color: rgb(247, 238, 228)"
              >
                <a
                  href="#photos"
                  class="section-link text-decoration-none text-secondary py-2"
                  >Photos</a
                >
                <a
                  href="#details"
                  class="section-link text-decoration-none text-secondary py-2"
                  >Details</a
                >
                <a
                  href="#rooms"
                  class="section-link text-decoration-none text-secondary py-2"
                  >Rooms</a
                >
                <a
                  href="#amenities"
                  class="section-link text-decoration-none text-secondary py-2"
                  >Amenities</a
                >
              </div>
            </div>
            <?php
                $imageBaseUrl = 'https://photos.hotelbeds.com/giata/';
                $images = $hotelDetails['hotel']['images'] ?? [];
                $totalImages = count($images);
                ?>
                <div id="photos" class="d-flex gap-2">
                <?php if (!empty($images)): ?>
                    <img
                    src="<?= $imageBaseUrl . $images[0]['path'] ?>"
                    alt="Hotel Image"
                    class="property-image w-100 rounded mb-3"
                    data-bs-toggle="modal" data-bs-target="#galleryModal"
                    />
                    <div class="d-flex flex-wrap gap-2 flex-column mbl-flex-row">
                    <?php foreach (array_slice($images, 1, 4) as $img): ?>
                        <img
                        src="<?= $imageBaseUrl . $img['path'] ?>"
                        class="image-thumbnail rounded"
                        alt="<?= $img['type']['description']['content'] ?? 'Hotel Image' ?>"
                        data-bs-toggle="modal" data-bs-target="#galleryModal"
                        />
                    <?php endforeach; ?>

                    <?php if ($totalImages > 5): ?>
                        <div class="position-relative" data-bs-toggle="modal" data-bs-target="#galleryModal" style="cursor: pointer;">
                            <img
                            src="<?= $imageBaseUrl . $images[5]['path'] ?>"
                            class="image-thumbnail rounded"
                            alt="More Photos"
                            style="filter: brightness(50%);"
                            />
                            <div class="position-absolute top-50 start-50 translate-middle text-white fw-bold fs-6">
                            +<?= $totalImages - 5 ?> photos
                            </div>
                        </div>
                    <?php endif; ?>

                    </div>
                <?php endif; ?>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Photo Gallery</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row modal-body d-flex flex-wrap ">
                            <?php foreach ($images as $img): ?>
                                <div class="col-md-6 mb-3">
                                <img
                                    src="<?= $imageBaseUrl . $img['path'] ?>"
                                    class="img-fluid rounded w-100 h-100"
                                    alt="<?= $img['type']['description']['content'] ?? 'Hotel Image' ?>"
                                />
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

          </div>
      </div>
    </div>

    <?php
        $facilityIcons = [
            'room' => 'fa-door-closed',
            'hotel' => 'fa-hotel',
            'wheelchair' => 'fa-wheelchair',
            'car park' => 'fa-parking',
            'valet' => 'fa-parking',
            '24-hour reception' => 'fa-clock',
            'wi-fi' => 'fa-wifi',
            'car hire' => 'fa-car',
            'airport shuttle' => 'fa-shuttle-van',
            'room service' => 'fa-bell',
            'laundry' => 'fa-soap',
            'security' => 'fa-user-shield',
            'bellboy' => 'fa-bell-concierge',
            'safe' => 'fa-lock',
            'currency exchange' => 'fa-money-bill-wave',
            'lift' => 'fa-elevator',
            'concierge' => 'fa-concierge-bell',
            'newspapers' => 'fa-newspaper',
            'luggage' => 'fa-suitcase-rolling',
            'clothes dryer' => 'fa-tshirt',
            'towels' => 'fa-bath',
            'bed linen' => 'fa-bed',
            'café' => 'fa-coffee',
            'bar' => 'fa-glass-martini-alt',
            'restaurant' => 'fa-utensils',
            'smoking area' => 'fa-smoking',
            'banquet' => 'fa-chair',
            'meeting room' => 'fa-handshake',
            'business centre' => 'fa-briefcase',
            'indoor pool' => 'fa-swimming-pool',
            'hairdressing' => 'fa-cut',
            'breakfast' => 'fa-bread-slice',
            'non-smoking' => 'fa-ban-smoking',
            'fitness' => 'fa-dumbbell',
        ];
    ?>

    <!-- Aminities Sections -->
    <div class="container my-4">
        
        <?php if (isset($hotelDetails['hotel']['facilities']) && is_array($hotelDetails['hotel']['facilities'])): ?>
            <h2 style="padding-left: 10px;" id="amenities">Amenities</h2>
            <div class="d-flex overflow-auto gap-3 px-2">
                
                <?php foreach ($hotelDetails['hotel']['facilities'] as $facility): ?>
                    <?php
                        $description = strtolower($facility['description']['content'] ?? '');
                        $iconClass = 'fa-concierge-bell'; // default icon

                        foreach ($facilityIcons as $keyword => $icon) {
                            if (strpos($description, $keyword) !== false) {
                                $iconClass = $icon;
                                break;
                            }
                        }
                    ?>
                    <div class="flex-shrink-0 border rounded p-3 text-center" style="min-width: 150px;">
                        <i class="fas <?= $iconClass ?> fa-2x mb-2"></i>
                        <div><?= $facility['description']['content'] ?? 'Facility Info' ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>



      <div id="details" class="content-section">
        <h2>Details</h2>
        <p>
          <?= esc($hotelDetails['hotel']['description']['content'] ?? 'N/A') ?>
        </p>
      </div>

      

      <div id="rooms" class="content-section">
        <div class="table-responsive">
            <table class="table">
              <thead>
                  <tr>
                      <th>Room Name</th>
                      <th>Room Description</th>
                      <th>Characteristics</th>
                      <th>Guests</th>
                      <th>Board</th>
                      <!-- <th>Rate Key</th> -->
                      <th>Select</th>
                  </tr>
              </thead>
              <tbody>
                  <?php if (!empty($rateData['rooms'])): ?>
                    <?php foreach ($rateData['rooms'] as $index => $room): ?>
                        <?php 
                            $detailsRoom = $hotelDetails['hotel']['rooms'][$index] ?? null;
                        ?>
                        <?php foreach ($room['rates'] as $rate): ?>
                            <tr>
                                <td><?= htmlspecialchars($room['name']) ?></td>
                                <td><?= htmlspecialchars($detailsRoom['description'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($detailsRoom['characteristic']['description']['content'] ?? 'N/A') ?></td>
                                <td>
                                    <?php 
                                        $maxAdults = $detailsRoom['maxAdults'] ?? 0;
                                        $maxChildren = $detailsRoom['maxChildren'] ?? 0;
                                    ?>
                                    <?php for ($i = 0; $i < $maxAdults; $i++): ?>
                                        <i class="fas fa-user" title="Adult"></i>
                                    <?php endfor; ?>
                                    <?php for ($i = 0; $i < $maxChildren; $i++): ?>
                                        <i class="fas fa-child" title="Child"></i>
                                    <?php endfor; ?>
                                </td>
                                <td><?= htmlspecialchars($rate['boardName']) ?></td>
                                <!-- <td><small><?= htmlspecialchars($rate['rateKey']) ?></small></td> -->
                                <td>
                                    <form onsubmit="return checkRate(this);">
                                        <input type="hidden" name="rateKey" value="<?= htmlspecialchars($rate['rateKey']) ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Select Room</button>
                                    </form>
                                    <tr class="rate-info-row" style="display:none;">
                                        <td colspan="7" class="rate-info-cell"></td>
                                    </tr>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="7" class="text-center text-muted">No room information available. Please try another hotel or search again.</td>
                      </tr>
                  <?php endif; ?>

              </tbody>
            </table>

        </div>
    </div>
    </div>
<script>



function checkRate(form) {
    event.preventDefault();

    const rateKey = form.querySelector('input[name="rateKey"]').value;
    const row = form.closest('tr');
    const infoRow = row.nextElementSibling;

    fetch('/check-rate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({ rateKey })
    })
    .then(async res => {
        let data;
        try {
            data = await res.json();
        } catch (e) {
            throw new Error('Invalid JSON response');
        }

        let message = '';

        if (!res.ok) {
            console.log('HTTP error:', res.status, data?.error);
            if (res.status === 403 || (data?.error && data.error.toLowerCase().includes('quota'))) {
                message = '<div class="text-warning">There is a technical issue. Please try again later.</div>';
            } else {
                message = '<div class="text-danger">Allotments not available. Please try another room.</div>';
            }
        } else if (data.error) {
            console.log('API error:', data.error);
            if (data.error.toLowerCase().includes('quota')) {
                message = '<div class="text-danger">There is a technical issue. Please try again later.</div>';
            } else {
                message = '<div class="text-danger">Allotments not available. Please try another room.</div>';
            }
        } else if (!data.hotel || !data.hotel.rooms || !data.hotel.rooms[0] || !data.hotel.rooms[0].rates) {
            message = '<div class="text-danger">Allotments not available. Please try another room.</div>';
        } else {
            const hotelName = data.hotel.name; // get hotel name
            const price = data.hotel.rooms[0].rates[0].net;
            const currency = data.hotel.currency;
            // const price = data.hotel.rooms[0].rates[0].net;
            // const currency = data.hotel.currency;
            const cancellation = data.hotel.rooms[0].rates[0].cancellationPolicies?.map(p =>
                `Cancel before <strong>${p.from}</strong>: ${p.amount}${currency}`).join('<br>') || 'No policy found.';

          message = `
            <div class="bg-light p-3 rounded border">
                <strong>Net Price:</strong> ${price} ${currency} <br>
                <strong>Cancellation Policy:</strong><br>${cancellation}
                <div class="mt-2">
                    <form action="/checkout" method="GET">
                        <input type="hidden" name="rateKey" value="${encodeURIComponent(rateKey)}">
                        <input type="hidden" name="hotelName" value="${encodeURIComponent(hotelName)}">
                        <input type="hidden" name="price" value="${encodeURIComponent(price)}">
                        <input type="hidden" name="currency" value="${encodeURIComponent(currency)}">
                        <button type="submit" class="btn btn-success btn-sm">Book Now</button>
                    </form>
                </div>
            </div>`;

        }

        infoRow.querySelector('.rate-info-cell').innerHTML = message;
        infoRow.style.display = 'table-row';
    })
    .catch(err => {
        console.error('Fetch error:', err);
        infoRow.querySelector('.rate-info-cell').innerHTML = '<div class="text-danger">There is a technical issue. Please try again later.</div>';
        infoRow.style.display = 'table-row';
    });

    return false;
}



</script>

<script>
    // function handleBooking(form) {
    //     event.preventDefault();

    //     fetch('/is-logged-in', {
    //         method: 'GET',
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest'
    //         }
    //     })
    //     .then(res => res.json())
    //     .then(data => {
    //         if (data.logged_in) {
    //             alert('You can now proceed with booking.');
    //             // Optionally, open a modal or proceed with booking logic
    //         } else {
    //             // Save current URL and redirect
    //             const currentUrl = window.location.href;
    //             fetch('/set-redirect-url', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/x-www-form-urlencoded',
    //                     'X-Requested-With': 'XMLHttpRequest'
    //                 },
    //                 body: new URLSearchParams({ url: currentUrl })
    //             }).then(() => {
    //                 window.location.href = '/login';
    //             });
    //         }
    //     });

    //     return false;
    // }

// function handleBooking(form) {
//     event.preventDefault();

//     const rateKey = form.querySelector('input[name="rateKey"]').value;

//     fetch('/book-room', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//             'X-Requested-With': 'XMLHttpRequest'
//         },
//         body: new URLSearchParams({ rateKey })
//     })
//     .then(res => res.json())
//     .then(data => {
//         if (data.success) {
//             alert('Booking successful! Booking reference: ' + data.booking.booking.reference);
//             // Optionally redirect to a booking summary page
//             // window.location.href = '/booking-confirmation/' + data.booking.booking.reference;
//         } else {
//             alert('Booking failed: ' + (typeof data.error === 'object' ? JSON.stringify(data.error) : data.error || 'Unknown error'));

//         }
//     })
//     .catch(err => {
//         console.error('Booking error:', err);
//         alert('Technical error occurred during booking.');
//     });

//     return false;
// }



function handleBooking(form) {
    event.preventDefault();

    const rateKey = form.querySelector('input[name="rateKey"]').value;

    fetch('/book-room', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({ rateKey })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Booking successful! Booking reference: ' + data.booking.booking.reference);
            // Optionally redirect to a booking summary page
            // window.location.href = '/booking-confirmation/' + data.booking.booking.reference;
        } else {
            alert('Booking failed: ' + (typeof data.error === 'object' ? JSON.stringify(data.error) : data.error || 'Unknown error'));

        }
    })
    .catch(err => {
        console.error('Booking error:', err);
        alert('Technical error occurred during booking.');
    });

    return false;
}


function redirectToCheckout(form) {
    event.preventDefault();

    const rateKey = form.querySelector('input[name="rateKey"]').value;

    // Redirect to a new page where user can fill out their details
    window.location.href = '/checkout?rateKey=' + encodeURIComponent(rateKey);
    return false;
}

</script>


