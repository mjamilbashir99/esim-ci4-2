<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Email Templates</h6>
            <a href="<?= base_url('admin/email-templates/create') ?>" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Add New Template
        </a>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Template Name</th>
                            <th>Subject</th>
                            <th>Slug</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Template Name</th>
                            <th>Subject</th>
                            <th>Slug</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (!empty($templates) && is_array($templates)): ?>
                            <?php foreach ($templates as $template): ?>
                                <tr>
                                    <td><?= esc($template['id']) ?></td>
                                    <td><?= esc($template['name']) ?></td>
                                    <td><?= esc($template['subject']) ?></td>
                                    <td><?= esc($template['slug']) ?></td>
                                    <td><?= date('d M Y H:i', strtotime(esc($template['updated_at']))) ?></td>
                                    <td>
                                            <a href="<?= base_url('admin/email-templates/edit/'.esc($template['id'])) ?>" 
                                            class="btn btn-primary">
                                            Edit
                                            </a>
                                            <a href="<?= base_url('admin/email-templates/delete/'.esc($template['id'])) ?>" 
                                            class="btn btn-danger" 
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                            </a>
                                        <button class="btn btn-info btn-sm preview-btn" 
                                                data-subject="<?= esc($template['subject']) ?>" 
                                                data-content="<?= esc($template['content']) ?>">
                                            <i class="fas fa-eye"></i> Preview
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No templates found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Template Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="preview-subject" class="mb-3"></h4>
                <div id="preview-content" class="border p-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Preview -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview template functionality
    document.querySelectorAll('.preview-btn').forEach(button => {
        button.addEventListener('click', function() {
            const subject = this.getAttribute('data-subject');
            const content = this.getAttribute('data-content');
            
            document.getElementById('preview-subject').textContent = subject;
            document.getElementById('preview-content').innerHTML = content;
            
            // Initialize modal
            const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
            previewModal.show();
        });
    });
});
</script>