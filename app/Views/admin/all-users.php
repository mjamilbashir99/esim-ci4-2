                <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= esc($user['id']) ?></td>
                            <td><?= esc($user['name']) ?></td>
                            <td><a href="mailto:<?= esc($user['email']) ?>"><?= esc($user['email']) ?></a></td>
                            <td><?= esc($user['phone']) ?></td>
                            <td><?= esc($user['is_admin']) == 1 ? 'Admin' : 'User' ?></td>
                            <td><?= esc($user['created_at']) ?></td>
                            <td>
                            <a href="javascript:void(0);" 
                                class="btn btn-primary editUserBtn" 
                                data-id="<?= esc($user['id']) ?>" 
                                data-name="<?= esc($user['name']) ?>" 
                                data-email="<?= esc($user['email']) ?>" 
                                data-phone="<?= esc($user['phone']) ?>" 
                                data-type="<?= esc($user['is_admin']) ?>">
                                    Edit
                                </a>
                                <a href="<?= base_url('admin/delete-user/' . esc($user['id'])) ?>"
                                    class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="7">No users found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->

             
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editUserForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
       
        <div class="modal-body">
        <div id="editUserMessage" class="alert d-none w-100 p-2" role="alert"></div>
          <input type="hidden" name="id" id="user_id">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id="user_name" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" id="user_email" required>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" id="user_phone" required>
          </div>
          <div class="form-group">
            <label>User Type</label>
            <select class="form-control" name="is_admin" id="user_type">
              <option value="0">User</option>
              <option value="1">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Use event delegation for dynamically loaded elements
    $(document).on('click', '.editUserBtn', function() {
        $('#user_id').val($(this).data('id'));
        $('#user_name').val($(this).data('name'));
        $('#user_email').val($(this).data('email'));
        $('#user_phone').val($(this).data('phone'));
        $('#user_type').val($(this).data('type'));
        $('#editUserMessage').text('').removeClass('alert-danger alert-success');
        $('#editUserModal').modal('show');
    });

    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('admin/update-user') ?>",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    $('#editUserMessage')
                        .removeClass('alert-danger')
                        .addClass('alert-success')
                        .text('User updated successfully!')
                        .removeClass('d-none');
                    
                    setTimeout(() => {
                        $('#editUserModal').modal('hide');
                        location.reload();
                    }, 1000);
                } else {
                    $('#editUserMessage')
                        .removeClass('alert-success')
                        .addClass('alert-danger')
                        .text(res.message)
                        .removeClass('d-none');
                }
            },
            error: function() {
                $('#editUserMessage')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .text('Something went wrong.')
                    .removeClass('d-none');
            }
        });
    });
});
</script>