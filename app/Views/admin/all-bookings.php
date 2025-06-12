<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Esim Bookings</h6>
            <div class="d-flex">
                <!-- Status Filter Dropdown -->
                <div>
                    <label for="statusFilter" class="mr-2 font-weight-bold">Filter by Status:</label>
                    <select id="statusFilter" class="form-control d-inline-block w-auto">
                        <option value="">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Active">Active</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>E-SIM Ref</th>
                    <th>Bundle ID</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>E-SIM Ref</th>
                    <th>Bundle ID</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </tfoot>
            <tbody>
                <?php if (!empty($bookings)) : ?>
                    <?php foreach ($bookings as $booking) : ?>
                        <tr>
                            <td><?= esc($booking['id']) ?></td>
                            <td><?= esc($booking['user_name']) ?></td>
                            <td><a href="mailto:<?= esc($booking['user_email']) ?>"><?= esc($booking['user_email']) ?></a></td>
                            <td><?= esc($booking['esim_reference']) ?></td>
                            <td><?= esc($booking['bundle_id']) ?></td>
                            <td><?= esc($booking['quantity']) ?></td>
                            <td><?= esc($booking['total_price']) ?> <?= esc($booking['currency']) ?></td>
                            <td><?= esc(ucfirst($booking['status'])) ?></td>
                            <td><?= esc($booking['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
<!-- End of Page Content -->