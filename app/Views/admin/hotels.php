
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Markups</h6>
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add</a>
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
                            <th>B2B MARKUP</th>
                            <th>FROM DATE</th>
                            <th>TO DATE</th>
                            <th>MODULE ID</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>STATUS</th>
                            <th>B2C MARKUP</th>
                            <th>B2B MARKUP</th>
                            <th>FROM DATE</th>
                            <th>TO DATE</th>
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
                    <td><?= $markup['b2b_markup'] ?> %</td>
                    <td><?= $markup['from_date'] ?></td>
                    <td><?= $markup['to_date'] ?></td>
                    <td><?= $markup['module_id'] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger delete-button" data-id="<?= $markup['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="markupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markupModalLabel">Markup Settings</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <div id="markupMessage"></div>
            <form id="markupForm">
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
                  <label for="b2bMarkup">B2B MARKUP</label>
                  <input type="number" class="form-control" id="b2bMarkup" name="b2bMarkup" value="10" step="0.01" min="0">
              </div>

              <div class="form-group">
                  <label for="fromDate">From Date</label>
                  <input type="date" class="form-control" id="fromDate" name="fromDate">
              </div>

              <div class="form-group">
                  <label for="toDate">To Date</label>
                  <input type="date" class="form-control" id="toDate" name="toDate">
              </div>

              <div class="form-group">
                  <label for="moduleId">Module Id</label>
                  <select class="form-control" id="moduleId" name="moduleId">
                      <option value="hotel" selected disabled>Hotel</option>
                      <option value="beds">Beds</option>
                  </select>
              </div>
          </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Return</button>
                <button class="btn btn-primary" type="button" id="saveMarkup">Save</button>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#saveMarkup').click(function(event) {
        event.preventDefault();

        var formData = {
            status: $('#status').val(),
            b2cMarkup: $('#b2cMarkup').val(),
            b2bMarkup: $('#b2bMarkup').val(),
            fromDate: $('#fromDate').val(),
            toDate: $('#toDate').val(),
            moduleId: $('#moduleId').val()
        };

        // Clear previous message
        $('#markupMessage').html('');

        $.ajax({
            url: 'save-hotel',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    $('#markupMessage').html('<div class="alert alert-success">' + response.message + '</div>');

                    // Auto-close modal after 2 seconds
                    setTimeout(function() {
                        $('#addModal').modal('hide');
                        location.reload(); // Reload page to reflect changes
                    }, 2000);
                } else {
                    $('#markupMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                $('#markupMessage').html('<div class="alert alert-danger">An error occurred while saving the markup.</div>');
            }
        });
    });
});

// Delete Markup

function showMessage(type, message) {
    let messageBox = $('#messageBox');
    messageBox
        .removeClass('alert-success alert-danger')
        .addClass(type === 'success' ? 'alert alert-success' : 'alert alert-danger')
        .text(message)
        .fadeIn();

    setTimeout(() => {
        messageBox.fadeOut();
    }, 3000);
}

$(document).on('click', '.delete-button', function(e) {
    e.preventDefault();
    if (!confirm('Are you sure you want to delete this entry?')) return;

    let id = $(this).data('id');

    $.ajax({
        url: 'delete-hotel',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            if (response.status === 'success') {
                showMessage('success', response.message);
                // Optionally, remove the row dynamically instead of reload
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showMessage('error', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            showMessage('error', 'Error occurred while deleting.');
        }
    });
});


</script>

