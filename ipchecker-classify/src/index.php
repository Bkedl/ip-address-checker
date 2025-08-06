<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

include 'functions.php';

if (isset($_GET['items'])) {
    $items = $_GET['items'];
    $classificationResults = classifyIPs($items);

    echo json_encode([
        'error' => false,
        'items' => $items,
        'results' => $classificationResults
    ]);
} else {
    http_response_code(400); // added for the 400 status error (task b reminded me)
    echo json_encode([
        'error' => true,
        'message' => 'No IP addresses provided'
    ]);
}
?>
