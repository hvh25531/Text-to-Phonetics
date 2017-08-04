<?php

$data = json_decode(file_get_contents('php://input'), true);
$data = json_encode($data); 

$url = "https://www.phonetizer.com/phonetizer/default/call/jsonrpc";

$ch = curl_init();

$headers = [];
$headers[] = "Accept-Encoding: gzip, deflate, br";
$headers[] = "Content-Type: application/json";
$headers[] = "Host: www.phonetizer.com";
$headers[] = "Origin: https://www.phonetizer.com";
$headers[] = "X-Qooxdoo-Response-Type: application/json";
$headers[] = "Referer: https://www.phonetizer.com/ui";
$headers[] = "User-Agent:Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36";
$header[] = "Content-Type: application/json";
$header[] = "Content-Length: " . strlen($data);

curl_setopt_array($ch, array(
	CURLOPT_URL => $url,
	CURLOPT_SSL_VERIFYPEER	=> 0,
	CURLOPT_TIMEOUT_MS		=> 0,
	CURLOPT_RETURNTRANSFER	=> 1,
	CURLOPT_HEADER 			=> 1,
	CURLOPT_HTTPHEADER		=> $headers,
	CURLOPT_FOLLOWLOCATION	=> 1,
	//CURLOPT_CUSTOMREQUEST	=> 'PUT',
	CURLOPT_POST 			=> 1,
	CURLOPT_POSTFIELDS		=> $data,
));

$response = curl_exec($ch);
$err = curl_error($ch);

curl_close($ch);

// Return response & error
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}