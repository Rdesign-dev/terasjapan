<?php
// get_brand_data.php
header('Content-Type: application/json');

// Include brands.php file
require_once 'brands.php';

// Ternary operator to check if $_GET['brand'] is set, and the default value is 'terasjapan'
$brandId = $_GET['brand'] ?? 'terasjapan';

// Check if the brandId exists in the $brands array
if (isset($brands[$brandId])) {
    echo json_encode($brands[$brandId]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Brand not found']);
}
?>