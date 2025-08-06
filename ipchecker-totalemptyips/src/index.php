<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$output = array(
	"error" => false,
  "items" => "",
	"total_empty_ips" => 0
);

if (empty($_REQUEST['items'])) { // addded the conditonal logic for json output and error message for empty ips, plus the 400 error (same as totalips one)
    http_response_code(400);
    $output['error'] = true;
    $output['message'] = 'No IP addresses provided';
    echo json_encode($output);
    exit();
}

$items = $_REQUEST['items'];
$total_empty_ips=getTotalEmptyIPs($items);

$output['items']=$items;
$output['total_empty_ips']=$total_empty_ips;

echo json_encode($output);
exit();
