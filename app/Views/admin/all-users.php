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
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['phone']) ?></td>
                            <td><?= esc($user['is_admin']) == 1 ? 'Admin' : 'User' ?></td>
                            <td><?= esc($user['created_at']) ?></td>
                            <td>
                                <a href="<?= base_url('admin/edit-user/' . esc($user['id'])) ?>"
                                    class="btn btn-primary">Edit</a>
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

             