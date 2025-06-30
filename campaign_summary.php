<?php
// Connect to SQLite3 database
$db = new SQLite3('coupons.db');

// Query to get campaign counts
$query = "SELECT campaign_name, COUNT(*) as count FROM coupons GROUP BY campaign_name ORDER BY campaign_name";
$results = $db->query($query);

// Query to get total number of distinct campaigns
$totalCampaignsQuery = "SELECT COUNT(DISTINCT campaign_name) as total FROM coupons";
$totalResult = $db->querySingle($totalCampaignsQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coupon Campaign Summary</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px 40px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }
        .summary {
            text-align: center;
            margin-bottom: 25px;
            color: #666;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
        }
        th {
            background-color: #4a90e2;
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f2f6fc;
        }
        tr:hover {
            background-color: #e0ecff;
        }
        footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Coupon Campaign Summary</h2>
        <div class="summary">
            Total Distinct Campaigns: <strong><?= $totalResult ?></strong>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Campaign Name</th>
                    <th>Coupon Count</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['campaign_name']) ?></td>
                        <td><?= $row['count'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <footer>
            &copy; <?= date("Y") ?> Coupon Report. All rights reserved.
        </footer>
    </div>
</body>
</html>
