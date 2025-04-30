                <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Booking Ref</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Guests</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <!-- <th>Edit</th>
                            <th>Delete</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Booking Ref</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Guests</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <!-- <th>Edit</th>
                            <th>Delete</th> -->
                        </tr>
                    </tfoot>
                     <tbody>
        <?php if (!empty($bookings)) : ?>
            <?php foreach ($bookings as $booking) : ?>
                <tr>
                    <td><?= esc($booking['id']) ?></td>
                    <td><?= esc($booking['user_name']) ?></td>
                    <td><?= esc($booking['booking_reference']) ?></td>
                    <td><?= esc($booking['check_in']) ?></td>
                    <td><?= esc($booking['check_out']) ?></td>
                    <td><?= esc($booking['guests']) ?></td>
                    <td><?= esc($booking['total_price']) ?> <?= esc($booking['currency']) ?></td>
                    <td><?= esc(ucfirst($booking['status'])) ?></td>
                    <td><?= esc($booking['created_at']) ?></td>
                    <!-- <td>
                        <a href="<?= base_url('admin/edit-booking/' . esc($booking['id'])) ?>"
                            class="btn btn-primary">Edit</a></td>
                            <td>
                        <a href="<?= base_url('admin/delete-booking/' . esc($booking['id'])) ?>"
                            class="btn btn-danger">Delete</a></td> -->
                    
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

             