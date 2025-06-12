<div class="container py-4">
    <h2>Your Cart</h2>

    <?php if (empty($cart)): ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Bundle</th>
                    <th>Country</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                foreach ($cart as $item): 
                    $totalPrice = $item['price'] * $item['quantity'];
                    $grandTotal += $totalPrice;
                ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td><?= esc($item['country']) ?></td>
                        <td><?= esc($item['quantity']) ?></td>
                        <td><?= convertCurrency(number_format($item['price'], 2));  ?></td>
                        <td><?= convertCurrency(number_format($totalPrice, 2)); ?></td>
                        <td>
                            <form method="post" action="<?= site_url('cart/remove') ?>" class="d-inline">
                                <input type="hidden" name="bundleName" value="<?= esc($item['name']) ?>">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Grand Total:</th>
                    <th><?= convertCurrency(number_format($grandTotal, 2)); ?> </th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <div class="text-end mt-3">
    <a href="<?= site_url('eSimcheckout') ?>" class="btn btn-primary">
        Proceed to Checkout <i class="bi bi-arrow-right-circle"></i>
    </a>
</div>
    <?php endif; ?>
</div>