<?php
$url='http://www.uaecontact.com/c/company/';
//$data = file_get_contents('http://www.uaecontact.com/c/company/');
//$data=file($url);
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

// Get URL content
$lines_string=curl_exec($ch);
// close handle to release resources
curl_close($ch);
//output, you can also save it locally on the server
echo $lines_string;


?>