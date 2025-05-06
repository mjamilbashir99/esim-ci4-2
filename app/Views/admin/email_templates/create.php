<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('admin/email-templates/store') ?>">
                <div class="form-group">
                    <label>Template Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="10" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Template</button>
            </form>
        </div>
    </div>
</div>