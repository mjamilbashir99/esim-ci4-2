<style>
    .plans-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
        margin: 20px 0;
    }

    .plan-card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        padding: 20px;
        width: 280px;
        background-color: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .plan-card img.main-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    .plan-card h3 {
        font-size: 18px;
        margin: 10px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .plan-card p {
        margin: 6px 0;
        font-size: 14px;
    }

    .flag-img {
        width: 24px;
        height: 16px;
        object-fit: contain;
        border-radius: 2px;
    }

    
</style>

<div class="plans-wrapper">
    <?php foreach ($plans as $plan): ?>
        <?php
            $dataAmount = $plan['unlimited'] ? 'Unlimited' : round($plan['dataAmount'] / 1000) . ' GB';
            $duration = $plan['duration'] ?? 'N/A';
            $price = number_format($plan['price'], 2);
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
            <p><strong>Price:</strong> $<?= esc($price) ?></p>
            
            <a href="<?= site_url('bundle/' . $plan['name']) ?>" class="btn-view-details">View Details</a>

        </div>
    <?php endforeach; ?>
</div>

<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin: 30px 0;
}

.pagination {
    list-style: none;
    display: flex;
    gap: 8px;
    padding: 0;
    margin: 0;
}

.pagination li a {
    display: block;
    padding: 8px 14px;
    color: #333;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.2s ease;
}

.pagination li.active a {
    background-color: #007bff;
    color: white;
    pointer-events: none;
}

</style>
<div>
    <?= $pager ?>
</div>