<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    // Connect to SQLite3 database
    $db = new SQLite3('coupons.db');
    
    // Fetch distinct campaigns with their images
    $query = "
        SELECT DISTINCT campaign_name, image_url
        FROM coupons
        WHERE campaign_name IS NOT NULL AND campaign_name != ''
        ORDER BY campaign_name
    ";
    
    $results = $db->query($query);
    $campaigns = [];
    
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $campaigns[] = [
            'campaign_name' => $row['campaign_name'],
            'image_url' => $row['image_url'],
            'description' => 'Explore amazing deals and offers from ' . $row['campaign_name']
        ];
    }
    
    echo json_encode($campaigns);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}
?> 