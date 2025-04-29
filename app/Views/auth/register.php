

<!-- <div class="container mt-5">
  <h2 class="text-center mb-4">Register</h2>
  <form action="<?= site_url('register/submit') ?>" method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="text" class="form-control" name="phone" id="phone" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <div class="mb-3">
      <label for="confirm_password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Register</button>
  </form>
</div> -->


<div
      class="container d-flex justify-content-center align-items-center min-vh-100"
    >
      <div class="card p-4 shadow-lg my-4" style="width: 100%; max-width: 500px">
        <h3 class="text-center mb-4">Register</h3>
        <?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
 <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
        <form class="needs-validation" action="<?= site_url('register/submit') ?>" method="post" id="registerForm">
        <!-- <form class="needs-validation" novalidate id="registerForm"> -->
          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="name" value="<?= old('name') ?>" required />
            <div class="invalid-feedback">Please enter your full name.</div>
          </div>

          <div class="mb-3">
            <label for="number" class="form-label">Mobile Number</label>
            <input
              type="tel"
              class="form-control"
              id="number"
              name="phone"
              value="<?= old('phone') ?>"
              required
            />
            <div class="invalid-feedback">
              Please enter a valid 10-digit phone number.
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required />
            <div class="invalid-feedback">Please enter a valid email.</div>
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
              value="<?= old('password') ?>"
            />
            <div class="invalid-feedback">
              Password must be at least 6 characters long.
            </div>
          </div>

          <div class="mb-3">
            <label for="confirmPassword" class="form-label"
              >Confirm Password</label
            >
            <input
              type="password"
              class="form-control"
              id="confirmPassword"
              name="confirm_password" 
              value="<?= old('confirm_password') ?>"
              required
            />
            <div class="invalid-feedback" id="confirmFeedback">
              Please confirm your password.
            </div>
          </div>

          <button
            style="background-color: #001c34"
            type="submit"
            class="btn btn-success w-100"
          >
            Register
          </button>
        </form>

        <!-- Login link below the form -->
        <div class="text-center mt-3">
          <p>
            Already have an account?
            <a href="<?= site_url('login') ?>">Login here</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validation Script -->
    <script>
      (() => {
        "use strict";

        const form = document.getElementById("registerForm");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const confirmFeedback = document.getElementById("confirmFeedback");

        form.addEventListener(
          "submit",
          function (event) {
            if (
              !form.checkValidity() ||
              password.value !== confirmPassword.value
            ) {
              event.preventDefault();
              event.stopPropagation();

              if (password.value !== confirmPassword.value) {
                confirmPassword.classList.add("is-invalid");
                confirmFeedback.textContent = "Passwords do not match.";
              } else {
                confirmPassword.classList.remove("is-invalid");
              }
            } else {
              confirmPassword.classList.remove("is-invalid");
            }

            form.classList.add("was-validated");
          },
          false
        );
      })();
    </script>
