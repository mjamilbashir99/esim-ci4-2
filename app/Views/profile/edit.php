<style>
        body {
            background: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 146px auto 40px auto;
            /* top 60px, bottom 40px */
            padding: 30px 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
        }


        .form-header {
            text-align: center;
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: black;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
    </style>
    <div class="form-container">
        <h2 class="form-header">Edit Profile</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors = session()->getFlashdata('errors'))): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    <?php foreach ($errors as $field => $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="<?= esc($user['name']) ?>"
                    required
                    placeholder="Enter your full name" />
            </div>

            

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <div class="input-group">
                

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        value="<?= esc($user['phone']) ?>"
                        required
                        placeholder="3001234567" />
                </div>
            </div>


            


            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="<?= esc($user['email']) ?>"
                    required
                    placeholder="example@mail.com" />
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="••••••••" />
            </div>

            <button type="submit" class="btn btn-search text-white" style="width:100%;background: black;">Update Profile</button>
        </form>
    </div>