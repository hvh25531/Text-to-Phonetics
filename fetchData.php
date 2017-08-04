<?php

$data = json_decode(file_get_contents('php://input'), true);

$time = date('ymdhis');
$url = "http://www.phonetizer.com/phonetizer/default/call/jsonrpc?nocache=$time";

$ch = curl_init();

$headers = [];
$headers[] = "Host: www.phonetizer.com";
$headers[] = "Origin: https://www.phonetizer.com";
$headers[] = "X-Qooxdoo-Response-Type: application/json";
$headers[] = "Referer: https://www.phonetizer.com/ui";

curl_setopt_array($ch, array(
	CURLOPT_URL => $url,
	CURLOPT_SSL_VERIFYPEER	=> 0,
	CURLOPT_TIMEOUT_MS		=> 0,
	CURLOPT_RETURNTRANSFER	=> 1,
	CURLOPT_HEADER 			=> 1,
	CURLOPT_HTTPHEADER		=> $headers,
	CURLOPT_FOLLOWLOCATION	=> 1,
));

$response = curl_exec($ch);
$err = curl_error($ch);

curl_close($ch);

// Return response & error
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo htmlspecialchars($response);
}