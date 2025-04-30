

    <main class="py-5">
        <div class="container">
            <h3 class="h3 py-5">Search Hotels</h3>
            <form id="searchForm" onsubmit="handleSubmit(event)">
                <div class="search-box p-4">
                    <div class="row g-2 align-items-center">
                        <!-- Destination -->
                        <div class="col-md-12">
                            <div class="search-dropdown mx-auto col-md-12">
                                <input
                                    type="text"
                                    id="searchInput"
                                    name="destination"
                                    class="form-control form-control-lg col-md-12"
                                    placeholder="Destination"
                                    style="font-size: 1rem"
                                />
                                <div id="suggestions" class="list-group mt-2"></div>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <input
                                        type="text"
                                        id="checkin"
                                        name="checkin"
                                        class="form-control"
                                        placeholder="Select check-in date"
                                    />
                                </div>

                                <div class="col-md-6" style="padding-left: 0px !important">
                                    <input
                                        type="text"
                                        id="checkout"
                                        name="checkout"
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
                                name="passenger"
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
                                            type="button"
                                            onclick="updatePassenger('adults', -1)"
                                        >
                                            −
                                        </button>
                                        <span id="adultsCount" class="mx-2">1</span>
                                        <button
                                            class="btn btn-sm btn-outline-secondary"
                                            type="button"
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
                                            type="button"
                                            onclick="updatePassenger('children', -1)"
                                        >
                                            −
                                        </button>
                                        <span id="childrenCount" class="mx-2">0</span>
                                        <button
                                            class="btn btn-sm btn-outline-secondary"
                                            type="button"
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
                                            type="button"
                                            onclick="updatePassenger('infants', -1)"
                                        >
                                            −
                                        </button>
                                        <span id="infantsCount" class="mx-2">0</span>
                                        <button
                                            class="btn btn-sm btn-outline-secondary"
                                            type="button"
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
                                            type="button"
                                            onclick="updatePassenger('rooms', -1)"
                                        >
                                            −
                                        </button>
                                        <span id="roomsCount" class="mx-2">1</span>
                                        <button
                                            class="btn btn-sm btn-outline-secondary"
                                            type="button"
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
                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Set today's date in YYYY-MM-DD
      const today = new Date().toISOString().split("T")[0];

      // Initialize Check-in Datepicker
      flatpickr("#checkin", {
        dateFormat: "d M Y",
        minDate: "today",
        onChange: function (selectedDates, dateStr) {
          // When check-in is selected, restrict checkout to same or later
          const checkout = document.querySelector("#checkout")._flatpickr;
          if (checkout) {
            checkout.set("minDate", dateStr);
          }
        },
      });

      // Initialize Check-out Datepicker
      flatpickr("#checkout", {
        dateFormat: "d M Y",
        minDate: "today",
      });
      let passengers = {
        adults: 1,
        children: 0,
        infants: 0,
        rooms: 1, // Default 1 room
      };

      function updatePassenger(type, delta) {
        passengers[type] = Math.max(0, passengers[type] + delta);

        // Ensure at least 1 room for the case of room decrement
        if (type === "adults" && passengers.adults < 1) passengers.adults = 1;
        if (type === "rooms" && passengers.rooms < 1) passengers.rooms = 1;

        // Update individual counters
        document.getElementById("adultsCount").textContent = passengers.adults;
        document.getElementById("childrenCount").textContent =
          passengers.children;
        document.getElementById("infantsCount").textContent =
          passengers.infants;
        document.getElementById("roomsCount").textContent = passengers.rooms;

        // Build the summary string
        let summary = `${passengers.adults} Adult${
          passengers.adults > 1 ? "s" : ""
        }`;
        if (passengers.children > 0)
          summary += `, ${passengers.children} Child${
            passengers.children > 1 ? "ren" : ""
          }`;
        if (passengers.infants > 0)
          summary += `, ${passengers.infants} Infant${
            passengers.infants > 1 ? "s" : ""
          }`;
        summary += `, ${passengers.rooms} Room${
          passengers.rooms > 1 ? "s" : ""
        }`;

        document.getElementById("passengerInput").value = summary;
      }

      // Initialize the page with the default count displayed
      updatePassenger("rooms", 0); // Ensure rooms start with the default value of 1

      // Toggle dropdown visibility
      document
        .getElementById("passengerInput")
        .addEventListener("click", function () {
          const dropdown = document.getElementById("passengerDropdown");
          dropdown.style.display =
            dropdown.style.display === "none" ? "block" : "none";
        });

      // Close dropdown when clicking outside
      document.addEventListener("click", function (e) {
        const dropdown = document.getElementById("passengerDropdown");
        const input = document.getElementById("passengerInput");
        if (!dropdown.contains(e.target) && e.target !== input) {
          dropdown.style.display = "none";
        }
      });

      const cityOptions = document.querySelectorAll(".dropdown-item-custom");

      cityOptions.forEach((option) => {
        option.addEventListener("click", function () {
          const cityName = this.querySelector(".title").textContent;
          document.getElementById("searchInput").value = cityName;

          // Optional: hide dropdown after selection
          document.getElementById("suggestions").classList.add("d-none");
        });
      });

      function showDropdown() {
        document.getElementById("suggestions").classList.remove("d-none");
      }

      // Optional: Hide dropdown when clicking outside
      document.addEventListener("click", function (e) {
        if (!e.target.closest(".search-dropdown")) {
          document.getElementById("suggestions").classList.add("d-none");
        }
      });
    </script>

    <!-- For Destination suggestion
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            let query = this.value;

            if (query.length >= 2) {
                fetch(`/get-city-suggestions?term=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        const suggestionsBox = document.getElementById('suggestions');
                        suggestionsBox.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(city => {
                                let item = document.createElement('a');
                                item.classList.add('list-group-item', 'list-group-item-action');
                                item.textContent = `${city.city_name}, ${city.state_name}, ${city.country_name}`;
                                
                               
                                item.addEventListener('click', () => {
                                    document.getElementById('searchInput').value = `${city.city_name}, ${city.state_name}, ${city.country_name}`;
                                    suggestionsBox.innerHTML = ''; 
                                });

                                suggestionsBox.appendChild(item);
                            });
                        }
                    });
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        });

    </script> -->


    <!-- For Destination suggestion -->
    <!-- <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            let query = this.value;

            if (query.length >= 2) {
                fetch(`/get-city-suggestions?term=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        const suggestionsBox = document.getElementById('suggestions');
                        suggestionsBox.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(city => {
                                let item = document.createElement('a');
                                item.classList.add('list-group-item', 'list-group-item-action');
                                item.textContent = `${city.city_name}, ${city.state_name}, ${city.country_name}`;
                                
                                item.addEventListener('click', () => {
                                    document.getElementById('searchInput').value = `${city.city_name}, ${city.state_name}, ${city.country_name}`;
                                    suggestionsBox.innerHTML = ''; 
                                });

                                suggestionsBox.appendChild(item);
                            });
                        }
                    });
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        });

        function handleSubmit(event) {
            event.preventDefault();

            const form = event.target;
            const destination = form.destination.value;
            const checkin = form.checkin.value;
            const checkout = form.checkout.value;
            const passenger = form.passenger.value;
            const rooms = document.getElementById('roomsCount').textContent;

            alert(`Destination: ${destination}\nCheck-in: ${checkin}\nCheck-out: ${checkout}\nPassenger: ${passenger}\nRooms: ${rooms}`);
        }

        function updatePassenger(type, delta) {
            const countElement = document.getElementById(type + 'Count');
            let count = parseInt(countElement.textContent);
            count += delta;

            if (count < 0) count = 0;

            countElement.textContent = count;
            
            const passengerInput = document.getElementById('passengerInput');
            const adultsCount = document.getElementById('adultsCount').textContent;
            const childrenCount = document.getElementById('childrenCount').textContent;
            const infantsCount = document.getElementById('infantsCount').textContent;

            passengerInput.value = `${adultsCount} Adults, ${childrenCount} Children, ${infantsCount} Infants`;
        }
    </script> -->


    <script>

        document.getElementById('searchInput').addEventListener('input', function () {
                    let query = this.value;

                    if (query.length >= 2) {
                        fetch(`/get-city-suggestions?term=${query}`)
                            .then(response => response.json())
                            .then(data => {
                                const suggestionsBox = document.getElementById('suggestions');
                                suggestionsBox.innerHTML = '';

                                if (data.length > 0) {
                                    data.forEach(city => {
                                        let item = document.createElement('a');
                                        item.classList.add('list-group-item', 'list-group-item-action');
                                        item.textContent = `${city.city_name}, ${city.state_name}, ${city.country_name}`;
                                        
                                        item.addEventListener('click', () => {
                                            // document.getElementById('searchInput').value = `${city.city_name}, ${city.state_name}, ${city.country_name}`;
                                            document.getElementById('searchInput').value = city.city_name;
                                            suggestionsBox.innerHTML = ''; 
                                        });

                                        suggestionsBox.appendChild(item);
                                    });
                                }
                            });
                    } else {
                        document.getElementById('suggestions').innerHTML = '';
                    }
                });
                function handleSubmit(event) {
                    event.preventDefault();

                    const form = event.target;
                    const destination = form.destination.value;
                    const checkin = form.checkin.value;
                    const checkout = form.checkout.value;
                    const passenger = form.passenger.value;

                    const adults = document.getElementById('adultsCount').textContent;
                    // alert(adults);
                    // const children = document.getElementById('childrenCount').textContent;
                    // alert(children);
                    const children = 0;
                    // alert(children);
                    const infants = document.getElementById('infantsCount').textContent;
                    
                    
                    const rooms = document.getElementById('roomsCount').textContent;

                    fetch('/search-hotels', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            destination: destination,
                            checkin: checkin,
                            checkout: checkout,
                            passenger: passenger,
                            rooms: rooms,
                            adults: adults,
                            children: children,
                            infants: infants,
                        })
                    })
                    .then(response => response.json())
                    // .then(data => {
                    //     if (data.success) {
                    //         // If search successful, redirect to result page
                    //         window.location.href = '/search-result';
                    //     } else {
                    //         alert('Error searching hotels: ' + data.error);
                    //     }
                    // })
                    .then(data => {
                        if (data.success) {
                            window.location.href = '/search-result';
                        } else {
                            alert('Error searching hotels: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }


    </script>