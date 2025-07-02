<?php
// === CONFIGURATION ===
$client_id = '';
$client_secret = '';
$scope = 'coupons_for_website';
$website_id = ;

$db_path = __DIR__ . '/coupons.db';

// === STEP 1: Get token ===
$token_url = 'https://api.admitad.com/token/';

$auth_header = base64_encode("$client_id:$client_secret");

$post_data = http_build_query([
	'grant_type' => 'client_credentials',
        'client_id'  => $client_id,
        'scope'      => $scope
]);

$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic $auth_header",
    "Content-Type: application/x-www-form-urlencoded"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

$response = curl_exec($ch);
curl_close($ch);

if (!$response) { die("❌ Token request failed."); }

$token_data = json_decode($response, true);
$access_token = $token_data['access_token'];

echo "✅ Got token: $access_token\n";

// === STEP 2: Get coupons ===

$limit = 100;
$offset = 0;
$all_coupons = [];

do {
    $coupons_url = "https://api.admitad.com/coupons/website/$website_id/?limit=$limit&offset=$offset";

    $ch = curl_init($coupons_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $access_token"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        die("❌ Coupons request failed at offset $offset.");
    }

    $coupons_data = json_decode($response, true);
    $results = $coupons_data['results'] ?? [];

    echo "✅ Got " . count($results) . " coupons at offset $offset\n";

    if (empty($results)) {
        break;
    }

    $all_coupons = array_merge($all_coupons, $results);
    $offset += $limit;

} while (true);

echo "\n🎉 Total coupons fetched: " . count($all_coupons) . "\n";

// === STEP 3: Insert into SQLite ===
$db = new SQLite3($db_path);

// Create table if needed
$db->exec('
    CREATE TABLE IF NOT EXISTS coupons (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        campaign_id INTEGER,
        campaign_name TEXT,
        title TEXT,
        description TEXT,
        coupon_code TEXT,
        affiliate_link TEXT,
        image_url TEXT,
        start_date TEXT,
        end_date TEXT
    )
');

// Optional: clear old
$db->exec('DELETE FROM coupons');

foreach ($all_coupons as $c){
    $stmt = $db->prepare('
        INSERT INTO coupons (campaign_id, campaign_name, title, description, coupon_code,
            affiliate_link, image_url, start_date, end_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');

    $stmt->bindValue(1, $c['campaign']['id']);
    $stmt->bindValue(2, $c['campaign']['name']);
    $stmt->bindValue(3, $c['name']);
    $stmt->bindValue(4, $c['description']);
    $stmt->bindValue(5, $c['promocode']);
    $stmt->bindValue(6, $c['goto_link']);
    $stmt->bindValue(7, $c['image']);
    $stmt->bindValue(8, substr($c['date_start'], 0, 10));
    $stmt->bindValue(9, $c['date_end'] ? substr($c['date_end'], 0, 10) : null);

    $stmt->execute();
}

$db->close();

echo "✅ Coupons inserted into coupons.db\n";
?>

