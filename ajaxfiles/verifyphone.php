<?php
$z=$_REQUEST["x"];
$access_key = 'cc4c6a2405f207454ff83b16e9218e5d';

// set phone number
$phone_number = "+91".$z;

// Initialize CURL:
$ch = curl_init('http://apilayer.net/api/validate?access_key='.$access_key.'&number='.$phone_number.'');  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$validationResult = json_decode($json, true);

// Access and use your preferred validation result objects
echo $validationResult['valid'];


?>