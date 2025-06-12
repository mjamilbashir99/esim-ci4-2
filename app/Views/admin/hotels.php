<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Markups</h6>
            <!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add</a> -->
        </div>
        <div id="messageBox" style="display: none;" class="alert" role="alert"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>STATUS</th>
                            <th>B2C MARKUP</th>
                            <!-- <th>B2B MARKUP</th>
                            <th>FROM DATE</th>
                            <th>TO DATE</th> -->
                            <th>MODULE ID</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>STATUS</th>
                            <th>B2C MARKUP</th>
                            <!-- <th>B2B MARKUP</th>
                            <th>FROM DATE</th>
                            <th>TO DATE</th> -->
                            <th>MODULE ID</th>
                            <th>ACTIONS</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($markups as $markup): ?>
                        <tr>
                            <td><?= $markup['id'] ?></td>
                            <td>
                                <label class="switch-tmg">
                                    <input type="checkbox" <?= $markup['status'] === 'enabled' ? 'checked' : '' ?>>
                                    <span class="slider-tmg"></span>
                                </label>
                            </td>
                            <td><?= $markup['b2c_markup'] ?> %</td>
                            <td><?= $markup['module_id'] ?></td>
                            <td>
                                <a href="#" class="btn btn-primary edit-button" data-id="<?= $markup['id'] ?>"
                                    data-status="<?= $markup['status'] ?>" data-b2c="<?= $markup['b2c_markup'] ?>"
                                    data-module="<?= $markup['module_id'] ?>">Edit</a>
                                <!-- <a href="#" class="btn btn-danger delete-button" data-id="<?= $markup['id'] ?>">Delete</a> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="markupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markupModalLabel">Add Markup Settings</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="markupMessage"></div>
                <form id="markupForm">
                    <input type="hidden" name="id" id="markupId" value="">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="b2cMarkup">B2C MARKUP</label>
                        <input type="number" class="form-control" id="b2cMarkup" name="b2cMarkup" value="10" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label for="moduleId">Module Id</label>
                        <select class="form-control" id="moduleId" name="moduleId">
                            <option value="hotel">esim</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="button" id="saveMarkup">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Delete functionality
    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete this markup?')) return;

        let id = $(this).data('id');
        let $row = $(this).closest('tr');
        
        $.ajax({
            url: 'delete-hotel',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    showMessage('success', response.message || 'Markup deleted successfully');
                    // Fade out and remove the row
                    $row.fadeOut(400, function() {
                        $(this).remove();
                    });
                    // Alternatively, reload the page after 1.5 seconds
                    // setTimeout(() => location.reload(), 1500);
                } else {
                    showMessage('error', response.message || 'Failed to delete markup');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                showMessage('error', 'Error occurred while deleting markup');
            }
        });
    });

    // Save/Update Markup
    $('#saveMarkup').click(function(event) {
        event.preventDefault();

        var formData = $('#markupForm').serialize();
        var id = $('#markupId').val();
        var url = id ? 'update-hotel' : 'save-hotel';

        $('#markupMessage').html('');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success' || response.status === 'updated') {
                    showMessage('success', response.message || 'Operation completed successfully');
                    $('#addModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    $('#markupMessage').html('<div class="alert alert-danger">' +
                        (response.message || 'Operation failed') + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                $('#markupMessage').html(
                    '<div class="alert alert-danger">An error occurred while processing your request.</div>'
                );
            }
        });
    });

    // Edit Markup
    $(document).on('click', '.edit-button', function(e) {
        e.preventDefault();

        var $button = $(this);
        $('#markupId').val($button.data('id'));
        $('#status').val($button.data('status'));
        $('#b2cMarkup').val($button.data('b2c'));
        // $('#b2bMarkup').val($button.data('b2b'));
        // $('#fromDate').val($button.data('from'));
        // $('#toDate').val($button.data('to'));
        $('#moduleId').val($button.data('module'));

        $('#markupModalLabel').text('Edit Markup Settings');
        $('#addModal').modal('show');
    });

    // Reset form when modal is closed
    $('#addModal').on('hidden.bs.modal', function() {
        $('#markupForm')[0].reset();
        $('#markupId').val('');
        $('#markupModalLabel').text('Add Markup Settings');
        $('#markupMessage').html('');
    });

    // Show message function
    function showMessage(type, message) {
        var messageBox = $('#messageBox');
        messageBox.removeClass('alert-success alert-danger')
            .addClass('alert-' + type)
            .text(message)
            .fadeIn();

        setTimeout(function() {
            messageBox.fadeOut();
        }, 3000);
    }
});
</script>