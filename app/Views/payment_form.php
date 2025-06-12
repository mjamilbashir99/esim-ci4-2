<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>
    <h2>Buy: <?= esc($description) ?></h2>
    <p>Price: $<?= esc($price) ?></p>

    <!-- Stripe JS integration (for demo) -->
    <form action="<?= site_url('payment/process') ?>" method="post">
        <input type="hidden" name="bundleId" value="<?= esc($bundleId) ?>">
        <input type="hidden" name="price" value="<?= esc($price) ?>">
        <input type="hidden" name="description" value="<?= esc($description) ?>">

        <!-- Simulated card details for now -->
        <p><label>Email: <input type="email" name="email" required></label></p>
        <p><label>Card Number: <input type="text" name="card" required></label></p>

        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
