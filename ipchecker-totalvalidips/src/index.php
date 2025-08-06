<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

include 'functions.php';

if (isset($_GET['items'])) {
    $items = $_GET['items'];
    $validationResults = validateIPs($items); 

    echo json_encode([
        'error' => false,
        'items' => $items,
        'results' => $validationResults 
    ]);
} else {
    http_response_code(400); // added the ststus error 
    echo json_encode([
        'error' => true,
        'message' => 'No IP addresses provided'
    ]);
}
?>
