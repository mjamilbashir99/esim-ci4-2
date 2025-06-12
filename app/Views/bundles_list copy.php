<!DOCTYPE html>
<html>
<head>
    <title>eSIM Bundles</title>
</head>
<body>
    <style>
        .bundle-card {
            border: 1px solid #ddd;
            padding: 16px;
            margin: 12px;
            border-radius: 8px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
        }
        .bundle-card img {
            max-width: 100%;
            height: auto;
        }
        .countries-list {
            margin-top: 8px;
        }
        .country-badge {
            background-color: #f0f0f0;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
            margin: 2px;
            font-size: 0.9em;
        }
         .autocomplete-suggestions {
            position: absolute;
            z-index: 1000;
            background: #fff;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            width: 100%;
        }
        .autocomplete-suggestion {
            padding: 8px;
            cursor: pointer;
        }
        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
    <h1>Available eSIM Bundles</h1>

    <!-- Search Form -->
      <form method="get" action="<?= site_url('bundlesview') ?>" id="search-form">
        <input type="text" id="search-input" name="search" placeholder="Search by country" value="<?= esc($searchQuery ?? '') ?>" autocomplete="off" />
        <button type="submit">Search</button>
    </form>

    <!-- Suggestions List -->
    <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>

    <?php if (!empty($bundles)): ?>
        <?php foreach ($bundles as $bundle): ?>
            <div class="bundle-card">
                <img src="<?= esc($bundle['imageUrl']) ?>" alt="<?= esc($bundle['description']) ?>">
                <h3><?= esc($bundle['description']) ?></h3>

                <div class="countries-list">
                    <strong>Available in:</strong><br>
                    <?php if (!empty($bundle['countries'])): ?>
                        <?php foreach ($bundle['countries'] as $country): ?>
                            <span class="country-badge"><?= esc($country['name']) ?></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="country-badge">N/A</span>
                    <?php endif; ?>
                </div>

                <p><strong>Data:</strong> <?= esc($bundle['dataAmount']) ?> MB</p>
                <p><strong>Duration:</strong> <?= esc($bundle['duration']) ?> Days</p>
                <p><strong>Price:</strong> $<?= esc($bundle['price']) ?></p>
                <a href="<?= site_url('bundles/' . $bundle['name']) ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No bundles available.</p>
    <?php endif; ?>

    <!-- Pagination Logic -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= esc($searchQuery ?? '') ?>"
               style="margin: 0 6px; padding: 6px 12px; background: <?= $i == $currentPage ? '#007bff' : '#eee' ?>; color: <?= $i == $currentPage ? '#fff' : '#000' ?>; text-decoration: none; border-radius: 4px;">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

    <h2>Browse Bundles by Country</h2>
    <div style="margin-bottom: 20px;">
        <a href="<?= site_url('bundlesview') ?>?page=1"
           style="margin-right: 10px; font-weight: <?= empty($selectedCountry) ? 'bold' : 'normal' ?>">All</a>
        <?php foreach ($countries as $country): ?>
            <a href="<?= site_url('bundlesview') ?>?country=<?= urlencode($country) ?>&page=1"
               style="margin-right: 10px; font-weight: <?= $selectedCountry == $country ? 'bold' : 'normal' ?>">
                <?= esc($country) ?>
            </a>
        <?php endforeach; ?>
    </div>



    

      <script>
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value;

            // Clear previous suggestions
            document.getElementById('autocomplete-suggestions').innerHTML = '';

            // Show suggestions after 3 characters
            if (query.length > 2) {
                fetch('/bundlesview/suggestions?query=' + query)
                    .then(response => response.json())
                    .then(data => {
                        const suggestionsContainer = document.getElementById('autocomplete-suggestions');
                        if (data.length > 0) {
                            data.forEach(country => {
                                const suggestionDiv = document.createElement('div');
                                suggestionDiv.classList.add('autocomplete-suggestion');
                                suggestionDiv.textContent = country;
                                suggestionDiv.addEventListener('click', () => {
                                    document.getElementById('search-input').value = country;
                                    document.getElementById('search-form').submit(); // Submit form on suggestion click
                                });
                                suggestionsContainer.appendChild(suggestionDiv);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching suggestions:', error));
            }
        });
    </script>
</body>
</html>
