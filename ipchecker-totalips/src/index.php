<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$output = array(
    "error" => false,
    "items" => "",
    "total_ips" => 0
);

if (empty($_REQUEST['items'])) { // checing for empty items in back end, if they are not here then added the 400 error with the error json output 
    http_response_code(400);
    $output['error'] = true;
    $output['message'] = 'No IP addresses provided';
    echo json_encode($output);
    exit();
}

// code remians the same here and down, just hadd the additonlal logic above i believe 

$items = $_REQUEST['items'];
$total_ips = getTotalIPs($items);

$output['items'] = $items;
$output['total_ips'] = $total_ips;

echo json_encode($output);
exit();