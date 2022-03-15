<?php
// API Connection Details
$whmcsUrl = "";
$username = "";
$password = "";

// Set post values
$postfields = array(
    'username' => $username,
    'password' => $password,
    'action' => 'GetClientGroups',
    'responsetype' => 'json',
    'email' => $line,
);
  
// Call the API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $whmcsUrl . 'includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
$response = curl_exec($ch);
if (curl_error($ch)) {
    die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
}
curl_close($ch);
// Decode response
$jsonData = json_decode($response, true);

var_dump($jsonData);
?>
