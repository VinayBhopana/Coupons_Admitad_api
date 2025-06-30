<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('coupons.db');

function esc($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

$campaignName = urldecode($_GET['name'] ?? '');
$campaignName = trim($campaignName);

if (!$campaignName) {
    echo "No campaign specified.";
    exit;
}

$stmt = $db->prepare("SELECT * FROM coupons WHERE campaign_name = :name ORDER BY end_date");
$stmt->bindValue(':name', $campaignName, SQLITE3_TEXT);
$results = $stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coupons for <?= esc($campaignName) ?></title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fb;
            margin: 0;
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 per row */
            gap: 20px;
            max-width: 1100px;
            margin: 30px auto;
        }
        .coupon {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            padding: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .coupon img {
            max-height: 80px;
            margin-bottom: 10px;
            object-fit: contain;
        }
        .coupon h3 {
            font-size: 16px;
            margin: 0 0 8px;
        }
        .coupon p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
        }
        .coupon a {
            margin-top: 6px;
            color: #1a73e8;
            text-decoration: none;
            font-weight: 500;
        }
        .back {
            text-align: center;
            margin-top: 40px;
            font-size: 16px;
        }
        .back a {
            text-decoration: none;
            color: #444;
            border: 1px solid #ccc;
            padding: 8px 14px;
            border-radius: 6px;
            background: #f0f0f0;
            transition: background 0.2s ease;
        }
        .back a:hover {
            background: #e0e0e0;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
    </style>
</head>
<body>
    <h2>Coupons for "<?= esc($campaignName) ?>"</h2>
    <div class="grid">
        <?php
        $hasResults = false;
        while ($row = $results->fetchArray(SQLITE3_ASSOC)):
            $hasResults = true;
        ?>
            <div class="coupon">
                <?php if (!empty($row['image_url'])): ?>
                    <img src="<?= esc($row['image_url']) ?>" alt="">
                <?php endif; ?>
                <h3><?= esc($row['title'] ?? 'Unnamed Coupon') ?></h3>
		<p><strong>Code:</strong> <?= esc($row['coupon_code'] ?? 'N/A') ?></p>
                <p><strong>Valid From:</strong>
                   <?= esc($row['start_date'] ?? '') ?> <strong>To</strong> <?= esc($row['end_date'] ?? '') ?>
                </p>
                <?php if (!empty($row['affiliate_link'])): ?>
                    <a href="<?= esc($row['affiliate_link']) ?>" target="_blank">Use this coupon</a>
                <?php else: ?>
                    <span style="color: #888;">No link available</span>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>

        <?php if (!$hasResults): ?>
            <p style="text-align:center; color:#888;">No coupons found for this campaign.</p>
        <?php endif; ?>
    </div>
    <div class="back">
        <a href="index.html">&larr; Back to Campaign Gallery</a>
    </div>
</body>
</html>

