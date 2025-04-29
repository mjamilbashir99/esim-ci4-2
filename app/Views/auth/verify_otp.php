<style>
    .otp-inputs input {
      width: 40px;
      height: 50px;
      font-size: 24px;
      margin: 0 5px;
      padding: 2px !important;
    }
    input:focus {
      box-shadow: none !important;
    }
    .was-validated .form-control:valid,
    .was-validated .form-control:invalid,
    .form-control.is-valid,
    .form-control.is-invalid {
      background-image: none !important;
      padding-right: 0 !important;
    }
  </style>
 <div
      class="container d-flex justify-content-center align-items-center min-vh-100"
    >
      <div
        class="card p-4 shadow-lg text-center"
        style="width: 100%; max-width: 400px"
      >
        <h4 class="mb-3">OTP Verification</h4>
        <p class="text-muted mb-4">
          Please enter the 6-digit code sent to your email <b><?= $_GET['email'] ?? '' ?></b>
        </p>

        <!-- <form class="needs-validation" novalidate action="<?= site_url('verify-otp') ?>" method="post"> -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
             <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
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
            <form class="needs-validation" action="<?= site_url('verify-otp/submit') ?>" method="post" novalidate>
                <!-- Include email as hidden input -->
                <input type="hidden" name="email" value="<?=esc($_GET['email'] ?? '') ?>">

                <div class="d-flex justify-content-between mb-4 otp-inputs">
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                    <!-- <input
                        type="text"
                        class="form-control text-center otp-digit"
                        maxlength="1"
                        name="otp[]"
                        required
                    /> -->
                    <input type="text" class="form-control text-center otp-digit" maxlength="1" name="otp[]" required />
                    <?php endfor; ?>
                </div>

                <div class="invalid-feedback mb-2">Please fill all OTP fields.</div>

                <button
                    type="submit"
                    class="btn btn-primary w-100"
                    style="background-color: #001c34"
                >
                    Verify OTP
                </button>
            </form>


           <p class="mt-3 text-muted">
              Didn't receive the code?
              <a href="<?= site_url('resend-otp?email=' . urlencode($_GET['email'] ?? '')) ?>">Resend</a>
            </p>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      const inputs = document.querySelectorAll(".otp-inputs input");

      inputs.forEach((input, index) => {
        input.addEventListener("input", () => {
          if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
          }
        });
      });

      document.querySelector("form").addEventListener("submit", function (e) {
        let valid = true;
        inputs.forEach((input) => {
          if (input.value.trim() === "") {
            valid = false;
          }
        });

        if (!valid) {
          e.preventDefault();
          e.stopPropagation();
          document.querySelector(".invalid-feedback").style.display = "block";
        } else {
          document.querySelector(".invalid-feedback").style.display = "none";
        }

        this.classList.add("was-validated");
      });
    </script>
