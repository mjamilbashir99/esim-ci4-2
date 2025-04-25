<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'My Website' ?></title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
      rel="stylesheet"
    />
    <link href="style.css" rel="stylesheet" />
  </head>

  <body>
    <nav class="navbar navbar-expand-lg py-4">
      <div class="container-fluid d-flex justify-content-between p-0">
        <a class="navbar-brand text-white mx-3" href="/index.html">Navbar</a>
        <button
          class="navbar-toggler"
          style="box-shadow: none !important"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav" style="gap: 20px">
            <li class="nav-item">
              <a
                class="nav-link active text-white nav-text-black"
                aria-current="page"
                href="/index.html"
                >About Us</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-white nav-text-black" href="/listing.html"
                >Listing</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-white nav-text-black"
                href="/singlepage.html"
                >Singlepage</a
              >
            </li>
          </ul>
          <!-- Add a button after the list items -->
          <button class="bookbtn btn btn-danger mx-3 rounded-0">
            Book Online
          </button>
        </div>
      </div>
    </nav>

    <div class="content">
        <?= $content ?>
    </div>

    <footer class="w-100" style="background-color: #001c34">
      <ul
        class="navbar-nav d-flex flex-row justify-content-center py-2 fontSize mobile-col"
        style="gap: 20px; list-style: none; padding-left: 0"
      >
        <li class="nav-item">
          <p
            class="nav-link active text-white m-0 fontSize"
            aria-current="page"
          >
            COPYRIGHT © 2025 HOTEL ROOM DISCOUNT&nbsp;
            <span class="slash">|</span>
          </p>
        </li>
        <li class="nav-item">
          <a
            class="nav-link active text-white fontSize"
            aria-current="page"
            href="#"
            >About Us <span class="slash">|</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fontSize" href="#"
            >Why Booking With Us <span class="slash"> |</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link text-white fontSize" href="#">Airport Transfer</a>
        </li>
      </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

</body>
</html>
