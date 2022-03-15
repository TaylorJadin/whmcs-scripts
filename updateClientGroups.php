  
<?php
// API Connection Details
$whmcsUrl = "";
$username = "";
$password = "";
// run getClientGroups.php to find the id
$clientGroupID = 1;

$lines = file('emails.txt');
foreach ($lines as $line_num => $line) {

// Remove any line breaks from $line
$line = preg_replace( "/\r|\n/", "", $line );

print 'Looking up id for: ';
print $line;
print "\r\n";

// First, get the client id
// Set post values
$postfields = array(
    'username' => $username,
    'password' => $password,
    'action' => 'GetClientsDetails',
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

// Parse the response and save the clientid to a variable
$obj = json_decode($response);
$idnum = $obj->{'userid'};
  
// DEBUG
// var_dump($obj);
  
print 'Setting group for ID: ';
print $idnum;
print "\r\n";

// Use the client id we got and assign it to a group

// Set post values
$postfields = array(
    'username' => $username,
    'password' => $password,
    'action' => 'UpdateClient',
    'responsetype' => 'json',
    'clientid' => $idnum,
    'groupid' => $clientGroupID,
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

print "\r\n";
}
?>
