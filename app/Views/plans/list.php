<div class="plans-wrapper">
    <?php foreach ($plans as $plan): ?>
        <?php
            $dataAmount = $plan['unlimited'] ? 'Unlimited' : round($plan['dataAmount'] / 1000) . ' GB';
            $duration = $plan['duration'] ?? 'N/A';
            $price = convertCurrency(number_format($plan['price'], 2));
            $flag = $plan['countryIso'] ?? '';
            $image = $plan['imageUrl'] ?? '';
            $country = $plan['countryName'] ?? 'Unknown';
        ?>
        <div class="plan-card">
            <img src="<?= esc($image) ?>" alt="<?= esc($country) ?>" class="main-img">
            <h3>
                <img src="https://flagcdn.com/w40/<?= esc($flag) ?>.png" alt="" class="flag-img">
                <?= esc($country) ?>
            </h3>
            <p><strong>Data:</strong> <?= esc($dataAmount) ?></p>
            <p><strong>Valid For:</strong> <?= esc($duration) ?> Days</p>
            <p><strong>Price:</strong> <?= esc($price) ?></p>
            
            <a href="<?= site_url('bundle/' . $plan['name']) ?>" class="btn-view-details">View Details</a>

        </div>
    <?php endforeach; ?>
</div>

<div>
    <?= $pager ?>
</div>