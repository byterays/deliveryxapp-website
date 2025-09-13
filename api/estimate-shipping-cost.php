<?php
if(!$_POST){
  header("Location: ../");
  die();
}

require_once '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

$client = new Client();
$api_base_url="https://www.dot2dotz.in"; 

$pickup_pincode = $_POST["pickup_pincode"];
$delivery_pincode = $_POST["delivery_pincode"];

$api_query_location="{$api_base_url}/rate_pincode_data?from={$pickup_pincode}&to={$delivery_pincode}";
$query_location_result = file_get_contents($api_query_location);
$location = json_decode($query_location_result);


$estimated_cost = file_get_contents("estimate.json");
$response["success"]=true;
$response["location"]=$location;
$response["data"]=json_decode($estimated_cost);
echo json_encode($response);
exit;


$pickup_oda=$location[0]->oda;
$delivery_oda=$location[1]->oda;

$api_query_rate="{$api_base_url}/rate_calculate/{$pickup_pincode}/{$delivery_pincode}";
$rate = file_get_contents($api_query_rate);

$weight = $_POST["weight"];
$invoice_value =$_POST["invoice_value"];

$shipment_boxes = $_POST["shipment_boxes"];

$no_of_boxes = array_reduce($shipment_boxes, function ($carry, $item) {
  return $carry + $item['no_of_box'];
}, 0);

$box_details = json_encode($shipment_boxes);
$dimension_unit = $_POST["dimension_unit"];

$api_query_cost="{$api_base_url}/calculate_final_rate?actual_weight={$weight}&pickup_oda={$pickup_oda}&delivery_oda={$delivery_oda}&rate={$rate}&ttl_invoice_value={$invoice_value}&cft_rate=6&pickup_pincode={$pickup_pincode}&drop_pincode={$delivery_pincode}&ttl_box={$no_of_boxes}&ttl_cft_weight_all_box={$weight}&boxes={$box_details}&select_unit={$dimension_unit}&payment_type=paid";
$request = new Request('PUT', $api_query_cost);
$response = $client->send($request);
$estimated_cost = (string)$response->getBody();

header("Content-Type: application/json");
echo $estimated_cost;