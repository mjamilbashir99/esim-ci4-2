<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('admin/email-templates/update/'.$template['id']) ?>">
                <div class="form-group">
                    <label>Template Name</label>
                    <input type="text" name="name" class="form-control" 
                           value="<?= esc($template['name']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" 
                           value="<?= esc($template['subject']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="10" required><?= 
                        esc($template['content']) 
                    ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Update Template</button>
            </form>
        </div>
    </div>
</div>