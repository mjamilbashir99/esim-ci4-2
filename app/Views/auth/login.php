<!-- <div class="container mt-5">
  <h2 class="text-center mb-4">Login</h2>

  <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <form action="<?= site_url('login/submit') ?>" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
</div> -->


<div
      class="container d-flex justify-content-center align-items-center my-4"
    >
    
      <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px">
        <h3 class="text-center mb-4">Login</h3>
        
        <form class="needs-validation" action="<?= site_url('login/submit') ?>" method="POST" novalidate>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
             <?php if (session()->has('errors')): ?>
              <div class="alert alert-danger">
                  <ul class="mb-0">
                      <?php foreach (session('errors') as $error): ?>
                          <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                  </ul>
              </div>
          <?php endif; ?>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" required />
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password" 
              minlength="6"
              required
            />
            <div class="invalid-feedback">
              Password must be at least 6 characters long.
            </div>
          </div>
          <button
            style="background-color: #001c34"
            type="submit"
            class="btn btn-primary w-100 border-none"
          >
            Login
          </button>
        </form>

        <!-- Register link below the form -->
        <div class="text-center mt-3">
          <p>
            Don't have an account?
            <a href="<?= site_url('register') ?>">Register here</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for Validation -->
    <script>
      // Bootstrap validation
      (() => {
        "use strict";
        const forms = document.querySelectorAll(".needs-validation");
        Array.from(forms).forEach((form) => {
          form.addEventListener(
            "submit",
            (event) => {
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add("was-validated");
            },
            false
          );
        });
      })();
    </script>