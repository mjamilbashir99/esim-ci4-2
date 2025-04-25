<section
      class="w-100 position-relative"
      style="
        background-image: url('/images/bg.jpg');
        height: 350px;
        background-size: cover;
      "
    >
      <div
        class="z-3 position-absolute top-0 p-5 w-100 h-100"
        style="background: rgba(0, 0, 0, 0.7)"
      >
        <p
          class="text-white h3 text-center underline"
          style="margin-top: 120px"
        >
          Book Online
        </p>
      </div>
    </section>

    <main class="py-5">
      <div class="container">
        <h3 class="h3 py-5">Serach Flights</h3>
        <div class="search-box p-4">
          <div class="row g-2 align-items-center">
            <!-- From Country -->
            <div class="col-md-12">
              <div class="search-dropdown mx-auto col-md-12">
                <input
                  type="text"
                  id="searchInput"
                  class="form-control form-control-lg col-md-12"
                  placeholder="Destination"
                  onfocus="showDropdown()"
                  style="font-size: 1rem"
                />

                <div class="dropdown-panel mt-1 d-none" id="suggestions">
                  <div class="dropdown-header">Popular destinations nearby</div>

                  <div class="dropdown-item-custom">
                    <i class="fas fa-location-dot"></i>
                    <div class="dropdown-texts">
                      <div class="title">Baltic Sea</div>
                      <div class="subtitle">Germany</div>
                    </div>
                  </div>

                  <div class="dropdown-item-custom">
                    <i class="fas fa-location-dot"></i>
                    <div class="dropdown-texts">
                      <div class="title">North Sea Coast Germany</div>
                      <div class="subtitle">Germany</div>
                    </div>
                  </div>

                  <div class="dropdown-item-custom">
                    <i class="fas fa-location-dot"></i>
                    <div class="dropdown-texts">
                      <div class="title">Sylt</div>
                      <div class="subtitle">Germany</div>
                    </div>
                  </div>

                  <div class="dropdown-item-custom">
                    <i class="fas fa-location-dot"></i>
                    <div class="dropdown-texts">
                      <div class="title">Lake Constance</div>
                      <div class="subtitle">Germany</div>
                    </div>
                  </div>

                  <div class="dropdown-item-custom">
                    <i class="fas fa-location-dot"></i>
                    <div class="dropdown-texts">
                      <div class="title">Hamburg</div>
                      <div class="subtitle">Germany</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Date Range -->
            <div class="col-md-5">
              <div class="row">
                <div class="col-md-6">
                  <input
                    type="text"
                    id="checkin"
                    class="form-control"
                    placeholder="Select check-in date"
                  />
                </div>

                <div class="col-md-6" style="padding-left: 0px !important">
                  <input
                    type="text"
                    id="checkout"
                    class="form-control"
                    placeholder="Select check-out date"
                  />
                </div>
              </div>
            </div>

            <!-- Passengers -->
            <div class="col-md-4 position-relative">
              <input
                type="text"
                class="form-control"
                id="passengerInput"
                readonly
                placeholder="1 Passenger"
              />
              <div
                id="passengerDropdown"
                class="p-3 mt-1 bg-white position-absolute w-100"
                style="display: none; z-index: 999"
              >
                <div
                  class="d-flex justify-content-between align-items-center mb-2"
                >
                  <span>Adults</span>
                  <div>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('adults', -1)"
                    >
                      −
                    </button>
                    <span id="adultsCount" class="mx-2">1</span>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('adults', 1)"
                    >
                      +
                    </button>
                  </div>
                </div>
                <div
                  class="d-flex justify-content-between align-items-center mb-2"
                >
                  <span>Children</span>
                  <div>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('children', -1)"
                    >
                      −
                    </button>
                    <span id="childrenCount" class="mx-2">0</span>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('children', 1)"
                    >
                      +
                    </button>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <span>Infants</span>
                  <div>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('infants', -1)"
                    >
                      −
                    </button>
                    <span id="infantsCount" class="mx-2">0</span>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('infants', 1)"
                    >
                      +
                    </button>
                  </div>
                </div>

                <div
                  class="d-flex justify-content-between align-items-center mt-3 border-top pt-2"
                >
                  <span>Rooms</span>
                  <div>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('rooms', -1)"
                    >
                      −
                    </button>
                    <span id="roomsCount" class="mx-2">1</span>
                    <button
                      class="btn btn-sm btn-outline-secondary"
                      onclick="updatePassenger('rooms', 1)"
                    >
                      +
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Search Button -->
            <div class="col-md-3">
              <button class="btn btn-search">Search</button>
            </div>
          </div>
        </div>
      </div>
    </main>