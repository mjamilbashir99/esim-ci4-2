<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'My Website' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        />
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        />
        <link
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
        rel="stylesheet"
        />
    <!-- <link href="./style.css" rel="stylesheet" /> -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" />
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
          <div class="d-flex">
            <?php if (session()->get('logged_in')): ?>
              <a href="<?= site_url('logout') ?>" class="bookbtn btn btn-danger mx-3 rounded-0">Sign-Out</a>
            <?php else: ?>
              <a href="<?= site_url('login') ?>" class="bookbtn btn btn-danger mx-3 rounded-0">Sign-In</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
    <section
      class="w-100 position-relative"
      style="
        
        background-image: url('<?= base_url('assets/img/bg.jpg'); ?>');

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

    <div class="content">
        <?= $content ?>
    </div>

    <footer class="w-100 container-fluid" style="background-color: #001c34">
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
   
    <!-- Bootstrap Bundle JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

</body>
</html>
